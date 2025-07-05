<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatBox extends Component
{
    use WithFileUploads;

    public User $trainer;
    public string $message = '';
    public $file;
    public bool $isTyping = false;

    protected $rules = [
        'message' => 'nullable|string|max:500',
        'file' => 'nullable|file|max:10240', // max 10MB
    ];

    public function sendMessage()
    {
        $this->validate();

        $data = [
            'sender_id' => Auth::id(),
            'receiver_id' => $this->trainer->id,
            'content' => $this->message ?? '',
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
        $msg = Message::find($id);
        if ($msg && $msg->sender_id == Auth::id()) {
            $msg->update(['deleted_by_sender' => true]);
        }
    }

    public function updatedMessage($value)
    {
        $this->dispatch('trainerIsTyping');
    }

    public function render()
    {
        $currentUserId = Auth::id();

        if (!$this->trainer || $this->trainer->id === $currentUserId) {
            return view('livewire.chat-box', ['messages' => []]);
        }

        Message::where('receiver_id', $currentUserId)
            ->where('sender_id', $this->trainer->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::where(function ($q) use ($currentUserId) {
                $q->where('sender_id', $currentUserId)->where('deleted_by_sender', false)
                  ->where('receiver_id', $this->trainer->id);
            })
            ->orWhere(function ($q) use ($currentUserId) {
                $q->where('receiver_id', $currentUserId)->where('deleted_by_receiver', false)
                  ->where('sender_id', $this->trainer->id);
            })
            ->orderBy('created_at')
            ->get();

        return view('livewire.chat-box', compact('messages'));
    }
}
