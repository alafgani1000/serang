<?php

namespace App\Observers;

use App\Incident;
use App\Status;
use App\IncidentApproval;
use Illuminate\Support\Facades\Auth;

class IncidentObserver
{
    /**
     * Handle the incident "created" event.
     *
     * @param  \App\Incident  $incident
     * @return void
     */
    public function created(Incident $incident)
    {
        if($incident->stage_id == 3)
        {
            $ia = new IncidentApproval();
            $ia->incident_id = $incident->id;
            $ia->user_id = 3;
            $ia->status_id = Status::waitingForApproval()->first()->id;
            $ia->save();
        }
    }

    /**
     * Handle the incident "updated" event.
     *
     * @param  \App\Incident  $incident
     * @return void
     */
    public function updated(Incident $incident)
    {
        if($incident->stage_id == 6)
        {
            $ia = new IncidentApproval();
            $ia->incident_id = $incident->id;
            $ia->user_id = 3;
            $ia->status_id = Status::waitingForApproval()->first()->id;
            $ia->save();
        }
        else if($incident->stage_id == 9)
        {
            $ia = new IncidentApproval();
            $ia->incident_id = $incident->id;
            $ia->user_id = 3;
            $ia->status_id = Status::approved()->first()->id;
            $ia->save();
        }
        else if($incident->stage_id == 4)
        {
            // inser data ke table incident_approval
            $ia = new IncidentApproval();
            $ia->incident_id = $incident->id;
            $ia->user_id = 3;
            $ia->status_id = Status::approved()->first()->id;
            $ia->save();
            // baca notifikasi berdasarkan user id dan stage
            $notification = Auth::user()->notifications->filter(function($item, $key) use($incident){
                return $item->data['id'] == $incident->id and  $item->data['stage_id'] == 3;
            })->first();
            $notification->markAsRead();
        }
    }

    /**
     * Handle the incident "deleted" event.
     *
     * @param  \App\Incident  $incident
     * @return void
     */
    public function deleted(Incident $incident)
    {
        //
    }

    /**
     * Handle the incident "restored" event.
     *
     * @param  \App\Incident  $incident
     * @return void
     */
    public function restored(Incident $incident)
    {
        //
    }

    /**
     * Handle the incident "force deleted" event.
     *
     * @param  \App\Incident  $incident
     * @return void
     */
    public function forceDeleted(Incident $incident)
    {
        //
    }
}
