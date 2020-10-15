<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Bitfumes\KarixNotificationChannel\KarixChannel;
use Bitfumes\KarixNotificationChannel\KarixMessage;
use Illuminate\Notifications\Notification;

class OTPNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($OTP)
    {
        $this->OTP=$OTP;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [KarixChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toKarix($notifiable)
    {
        return KarixMessage::create()
                ->to('+2348128955882')
                ->from('+2349068647442')
                ->content("Use OTP {$this->OTP} to verify your phone number");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray()
    {
        return [
            //
        ];
    }
}
