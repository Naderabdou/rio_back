<?php

namespace App\Notifications;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrdersNotifiction extends Notification
{
    use Queueable , Firebase;
    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(object $order)
    {
        $this->order = $order;
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

       // $this->sendFcmNotification($notifiable->firebase_tokens->first()->token_firebase, $this->order);
        return [
            'title' => transWord('New Order') . ' #' . $this->order->order_number,
            'body' => transWord('You have a new order') .''. $this->order->order_number,
            'order_id' => $this->order->id,
            'type' => 'order',
            'order_number' => $this->order->order_number,
            'type_order' => $this->order->type_order,
        ];
    }
}
