<?php

namespace App\Livewire;

use Livewire\Component;

class NavbarNotifyAdminList extends Component
{
    public $notifications;
    public $count;

    public function mount($notifications)
    {
        $this->notifications = $notifications;
    }

    public function refreshNotifications()
    {
        $this->notifications = auth()->user()->unreadNotifications;
    }

    public function render()
    {
        return view('livewire.navbar-notify-admin-list', [
            'notifications' => $this->notifications,
        ]);
    }
}
