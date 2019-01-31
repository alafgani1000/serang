<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Incident;
use App\IncidentApproval;
use App\Stage;
class IncidentCreated extends Notification
{
    use Queueable;
    public $incident;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(IncidentApproval $incidentApproval)
    {
        $this->incident = $incidentApproval->incident;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
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
                    ->greeting('Hello')
                    ->line($this->incident->user_id)
                    ->line($this->incident->description)
                    ->action('Notification Action', url('/'))
                    ->line('Thank you');
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
            'stage_id' => $this->incident->stage_id,
            'description' => str_limit($this->incident->description,50),
        ];
    }
}
