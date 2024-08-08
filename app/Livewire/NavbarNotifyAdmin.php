<?php

namespace App\Livewire;

use Livewire\Component;

class NavbarNotifyAdmin extends Component
{

    public $notifications;
    public $count;

    public function mount()
    {
        $this->notifications = auth()->user()->unreadNotifications;
        $this->count = count(auth()->user()->unreadNotifications);
        $this->updateCount();
    }
    public function updateCount()
    {
        $this->count = auth()->user()->unreadNotifications->count();
    }
    public function render()
    {
        return view('livewire.navbar-notify-admin', [
            'notifications' => $this->notifications,
            'count'         => $this->count,
        ]);
    }
}
