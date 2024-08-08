<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChengeStatusNotifiction extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     */

    public function __construct($data)
    {
        $this->data = $data;
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




    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->getTitle($this->data, app()->getLocale()),
            'body' =>   $this->data['order_number'] . ' ' . $this->getBody($this->data, app()->getLocale()),
            'order_id' => $this->data['order_id'],
            'order_number' => $this->data['order_number'],
        ];
    }

    public function getTitle(array $data, $local = 'ar')
    {
        return $data['title_' . $local];
    }

    public function getBody(array $data, $local = 'ar')
    {
        return  $data['body_' . $local];
    }
}
