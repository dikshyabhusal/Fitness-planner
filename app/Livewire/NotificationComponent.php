<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationComponent extends Component
{
    public $unreadMessages = [];
    public $allSenders = [];

    public function markAsRead($senderId)
    {
        Message::where('receiver_id', Auth::id())
            ->where('sender_id', $senderId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $this->dispatch('openChatWith', senderId: $senderId);
    }

    public function render()
    {
        // ✅ 1. Get unread messages grouped by sender
        $unread = Message::with('sender')
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->latest()
            ->get()
            ->groupBy('sender_id');

        $this->unreadMessages = $unread;

        // ✅ 2. Get all users who have ever sent or received a message with this user
        $this->allSenders = Message::with('sender')
            ->where('receiver_id', Auth::id())
            ->orWhere('sender_id', Auth::id())
            ->latest()
            ->get()
            ->map(function ($msg) {
                return $msg->sender_id == Auth::id() ? $msg->receiver : $msg->sender;
            })
            ->unique('id')
            ->values();

        return view('livewire.notification-component', [
            'unreadMessages' => $this->unreadMessages,
            'allSenders' => $this->allSenders,
        ]);
    }
}
