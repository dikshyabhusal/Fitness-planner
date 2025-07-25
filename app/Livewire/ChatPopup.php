<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class ChatPopup extends Component
{
    public bool $show = false;
    public ?int $selectedUserId = null;

    protected $listeners = ['openChatWith'];

    public function openChatWith($senderId)
    {
        $this->selectedUserId = $senderId;
        $this->show = true;
    }

    public function getSelectedUserProperty()
    {
        $user = User::where('id', $this->selectedUserId)->first();
        return $user instanceof User ? $user : null;
    }

    public function closeChat()
    {
        $this->show = false;
        $this->selectedUserId = null;
    }

    public function render()
    {
        // dd($this->selectedUser);
        return view('livewire.chat-popup', [
            'selectedUser' => $this->selectedUser,
        ]);
    }
}
