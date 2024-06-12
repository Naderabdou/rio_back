<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Notifications\AppNotification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class SendMobileNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $users;
    protected $data;
    public function __construct($users ,$data)
    {
            $this->users = $users;
            $this->data = $data;


    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
             Notification::send($this->users , new AppNotification($this->data));

    }
}
