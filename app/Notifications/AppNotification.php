<?php

namespace App\Notifications;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppNotification extends Notification
{
    use Queueable , Firebase;

    protected $data;
    protected $type;


    /**
     * Create a new notification instance.
     */
    public function __construct($data,$type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }



    public function toArray(object $notifiable)
    {

             $this->sendFcmNotification($notifiable->firebase_tokens()->pluck('token_firebase'), $this->data, app()->getLocale(), $this->type);
             return $this->data;
            }
}
