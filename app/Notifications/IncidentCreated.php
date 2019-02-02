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
        if($this->incident->stage_id == 3)
        {
            $url = route('incidents.ticketshow',$this->incident->id);
        }else if($this->incident->stage_id == 4)
        {
            $url = route('incidents.detailshow',$this->incident->id);
        }
        return (new MailMessage)
                    ->greeting('Dengan Hormat')
                    ->line($this->incident->user_id .":".$this->incident->user->name)
                    ->line("incident: " . $this->incident->description)
                    ->line("impact: " . $this->incident->impact)
                    ->line($this->incident->stage->name)
                    ->action('Notification Action', route('incidents.index'))
                    ->action('Notification Action Link', $url)
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
            'id' => $this->incident->id,
            'description' => str_limit($this->incident->description,50),
        ];
    }
}
