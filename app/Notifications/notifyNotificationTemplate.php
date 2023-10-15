<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class notifyNotificationTemplate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($formId, $formTitle)
    {
        $this->formId = $formId;
        $this->formTitle = $formTitle;
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
        $uniqueSubject = 'Form with form title ' . $this->formTitle . ' have been submitted ' . now()->format('d-m-Y');
        $formUrl = url("/submission/{$this->formId}");
        return (new MailMessage)
            ->from('jantzenform@gmail.com', 'Jantzen Form') // Sender details
            ->subject($uniqueSubject)
            ->line('Theres a form that have submitted by the user. You can view the submission by clicking the button below.')
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
