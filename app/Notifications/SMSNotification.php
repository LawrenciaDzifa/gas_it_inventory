<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SMSNotification extends Notification
{
    private $message;
    private $recipient;

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $message, string $recipient)
    {
        //
        {
            $this->message = $message;
            $this->recipient = $recipient;
        }
    }
    public function toSms($notifiable)
    {
        $twilio = new Client(env('AC09b2414d6c60a617f8c71c07998c15d3'), env('533ff47897e3d98fbdbb2fcc4127201e'));
        $twilio->messages->create($this->recipient, [
            "from" => env('TWILIO_PHONE_NUMBER'),
            "body" => $this->message
        ]);
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
