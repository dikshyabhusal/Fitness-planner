<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class NotificationComponent extends Component
{
    public $unreadMessages;

    public function markAsRead($senderId)
    {
        Message::where('receiver_id', Auth::id())
            ->where('sender_id', $senderId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Emit to trigger frontend chat opening
        $this->dispatch('openChatWith', senderId: $senderId);
    }

    public function render()
{
    $this->unreadMessages = [];

    $messages = Message::with('sender')
        ->where('receiver_id', Auth::id())
        ->where('is_read', false)
        ->latest()
        ->take(10)
        ->get();

        $grouped = [];

    foreach ($messages as $msg) {
        $senderId = $msg->sender_id;

        if (!isset($this->unreadMessages[$senderId])) {
            $this->unreadMessages[$senderId] = $msg;
        }
    }

    return view('livewire.notification-component', [
            'unreadMessages' => $grouped,
        ]);
}

}
