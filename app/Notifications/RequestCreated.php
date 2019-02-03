<?php

namespace App\Notifications;

use App\RequestApproval;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestCreated extends Notification
{
    use Queueable;
    public $request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(RequestApproval $requestApproval)
    {
        $this->request = $requestApproval->request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->request->stage->id == 1) {
            $url = route('requests.approveshow', $this->request->id);
        } elseif ($this->request->stage->id == 2) {
            $url = route('requests.approveshow', $this->request->id);
        } elseif ($this->request->stage->id == 7) {
            $url = route('requests.approveshow', $this->request->id);
        } elseif ($this->request->stage->id == 10) {
            $url = route('requests.approveshow', $this->request->id);
        } elseif ($this->request->stage->id == 6) {
            $url = route('requests.approveshow', $this->request->id);
        } elseif ($this->request->stage->id == 3) {
            $url = route('requests.editticket', $this->request->id);
        } elseif ($this->request->stage->id == 4) {
            $url = route('requests.editdetail', $this->request->id);
        } else{
            $url = '';
        }
        return (new MailMessage)
            ->greeting('Dengan Hormat')
            ->subject($this->request->title)
            ->line('Nama :' . $this->request->user_id . "(" . $this->request->user->name . ")")
            ->line('id :' . $this->request->id)
            ->line('Kebutuhan Bisnis: ' . $this->request->business_need)
            ->line('Manfaat Bisnis: ' . $this->request->business_benefit)
            ->line($this->request->stage->name)
            ->action('Notification Action', $url)
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
            'stage_id' => $this->request->stage_id,
            'id' => $this->request->id,
            'business_benefit' => str_limit($this->request->business_need, 50),
        ];
    }
}
