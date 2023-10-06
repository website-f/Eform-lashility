<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class approvalNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($formId)
    {
        $this->formId = $formId;
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
        
        $logoUrl = asset('images/logo.png'); // Generate the logo URL
        $regardsMessage = 'Best regards from our team!';
        $formUrl = url("/submitted-view/{$this->formId}");
        return (new MailMessage)
            ->from('jantzenform@gmail.com', 'Jantzen Form') // Sender details
            ->subject('Waiting for Approval')
            ->line('A form has been submitted and waiting for your approval')
            ->action('View the Form', $formUrl)
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
