<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ChatBox extends Component
{
    use WithFileUploads;

    public ?User $chatUser = null;  // ✅ Prevents uninitialized error
    public string $message = '';
    public $file;
    public bool $isTyping = false;

    protected $rules = [
        'message' => 'nullable|string|max:500',
        'file' => 'nullable|file|max:10240',
    ];

    public function sendMessage()
    {
        $this->validate();

        if (!$this->chatUser) {
            return; // Don't proceed if no user selected
        }

        $data = [
            'sender_id' => Auth::id(),
            'receiver_id' => $this->chatUser->id,
            'content' => $this->message,
            'is_read' => false,
        ];

        if ($this->file) {
            $data['file_path'] = $this->file->store('messages', 'public');
        }

        Message::create($data);

        $this->reset(['message', 'file']);

        $this->dispatch('messageSent');
    }

    public function deleteMessage($id)
    {
        $message = Message::find($id);

        if ($message && $message->sender_id === Auth::id()) {
            $message->update(['deleted_by_sender' => true]);
        }
    }

    public function updatedMessage()
    {
        $this->dispatch('trainerIsTyping');
    }

    public function render()
    {
        $currentUserId = Auth::id();

        if (!isset($this->chatUser) || !$this->chatUser instanceof User || $this->chatUser->id === $currentUserId) {
            return view('livewire.chat-box', ['messages' => []]);
        }

        // Mark received messages as read
        Message::where('receiver_id', $currentUserId)
            ->where('sender_id', $this->chatUser->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Load messages
        $messages = Message::where(function ($q) use ($currentUserId) {
                $q->where('sender_id', $currentUserId)
                  ->where('receiver_id', $this->chatUser->id)
                  ->where('deleted_by_sender', false);
            })
            ->orWhere(function ($q) use ($currentUserId) {
                $q->where('receiver_id', $currentUserId)
                  ->where('sender_id', $this->chatUser->id)
                  ->where('deleted_by_receiver', false);
            })
            ->orderBy('created_at')
            ->get();

        return view('livewire.chat-box', ['messages' => $messages]);
    }
}
