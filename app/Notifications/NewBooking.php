<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBooking extends Notification
{
    use Queueable;

    public $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->cc(env('MAIL_FROM_ADDRESS'))
            ->line('Please find your booking below:')
            ->line('Contact: '.$this->order['email'])
            ->line('Pickup: '.$this->order['pickup'])
            ->line('Pickup Time: '.$this->order['time'])
            ->line('Pickup Date: '.$this->order['date'])
            ->line('Drop Off: '.$this->order['drop_off'])
            ->line('Drop Off Time: '.$this->order['drop_time'])
            ->line('Drop Off Date: '.$this->order['drop_date'])
            ->line('package: '.$this->order['package'])
            ->line('Mileage: '.$this->order['mileage'])
            ->line('Cost : £'.$this->order['cost']/100)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
