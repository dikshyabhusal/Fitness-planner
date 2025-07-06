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
    $userId = Auth::id();

    // ✅ Convert unread messages to plain array if needed
    $unread = Message::with('sender')
        ->where('receiver_id', $userId)
        ->where('is_read', false)
        ->latest()
        ->get()
        ->groupBy('sender_id');

    $this->unreadMessages = $unread->map(function ($msgs) {
        return $msgs->map(function ($msg) {
            return [
                'id' => $msg->id,
                'sender_id' => $msg->sender_id,
                'content' => $msg->content,
                'created_at' => $msg->created_at->toDateTimeString(),
                'sender_name' => $msg->sender->name ?? '',
            ];
        })->toArray();
    })->toArray();

    // ✅ Safely flatten and convert all senders
    $this->allSenders = Message::with(['sender', 'receiver'])
        ->where(function ($q) use ($userId) {
            $q->where('sender_id', $userId)
              ->orWhere('receiver_id', $userId);
        })
        ->latest()
        ->get()
        ->map(function ($msg) use ($userId) {
            $user = $msg->sender_id == $userId ? $msg->receiver : $msg->sender;
            return $user ? ['id' => $user->id, 'name' => $user->name] : null;
        })
        ->filter()
        ->unique('id')
        ->values()
        ->toArray();

    return view('livewire.notification-component', [
        'unreadMessages' => $this->unreadMessages,
        'allSenders' => $this->allSenders,
    ]);
}


}

