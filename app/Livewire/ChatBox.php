<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatBox extends Component
{
    public User $trainer;
    public string $message = '';
    public bool $isTyping = false;

    protected $rules = [
        'message' => 'required|string|max:500',
    ];

    public function sendMessage()
    {logger('sendMessage called');
        $currentUserId = Auth::id();
        
        // \Log::info("SendMessage triggered", [
        //     'user_id' => $currentUserId,
        //     'trainer_id' => $this->trainer->id,
        // ]);

        $this->validate();

        Message::create([
            'sender_id' => $currentUserId,
            'receiver_id' => $this->trainer->id,
            'content' => $this->message,
            'is_read' => false,
        ]);

        $this->message = '';

        $this->dispatch('messageSent');
    }

    public function updatedMessage($value)
    {
        $this->dispatch('trainerIsTyping');
    }

    public function render()
    {
        $currentUserId = Auth::id();

        // Safety: ensure trainer is not null and not the same user
        if (!$this->trainer || $this->trainer->id === $currentUserId) {
            return view('livewire.chat-box', ['messages' => []]);
        }

        // Mark unread messages from trainer as read
        Message::where('receiver_id', $currentUserId)
            ->where('sender_id', $this->trainer->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Get conversation messages between current user and trainer
        $messages = Message::where(function ($query) use ($currentUserId) {
                $query->where('sender_id', $currentUserId)
                      ->where('receiver_id', $this->trainer->id);
            })
            ->orWhere(function ($query) use ($currentUserId) {
                $query->where('sender_id', $this->trainer->id)
                      ->where('receiver_id', $currentUserId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.chat-box', ['messages' => $messages]);
    }
}
