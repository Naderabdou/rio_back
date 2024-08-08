<?php

namespace App\Livewire;

use Livewire\Component;

class NavbarNotifyListWeb extends Component
{
    public $notifications;
    public $count;

    public function mount($notifications)
    {

        $this->notifications = $notifications;
    }

    public function refreshWebNotifications()
    {

        $this->notifications = auth()->user()->unreadNotifications;
    }
    public function render()
    {
        return view('livewire.navbar-notify-list-web',
            ['notifications' => $this->notifications]
        );
    }
}
