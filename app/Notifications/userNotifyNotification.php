<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class userNotifyNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($pdfContent)
    {
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $regardsMessage = 'Best regards from our team!';
        return (new MailMessage)
            ->from('jantzenform@gmail.com', 'Jantzen Form') // Sender details
            ->subject('Your form have been submitted [no reply]')
            ->line('your form have been successfully submitted, thank you for your time')
            ->attachData($this->pdfContent, 'submitted_form.pdf', [
                'mime' => 'application/pdf',
            ])
            ->line($regardsMessage);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
