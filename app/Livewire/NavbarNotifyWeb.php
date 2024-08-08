<?php

namespace App\Livewire;

use Livewire\Component;

class NavbarNotifyWeb extends Component
{
    public $notifications;
    public $count;
    public function mount()
    {
        $this->notifications = auth()->user()->unreadNotifications;
        $this->count = count(auth()->user()->unreadNotifications);
        $this->updateWebCount();
    }
    public function updateWebCount()
    {
        $this->count = auth()->user()->unreadNotifications->count();
    }
    public function render()
    {
        return view('livewire.navbar-notify-web', [
            'notifications' => $this->notifications,
            'count'         => $this->count,
        ]);
    }
}
