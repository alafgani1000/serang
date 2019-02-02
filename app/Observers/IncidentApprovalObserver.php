<?php

namespace App\Observers;

use App\IncidentApproval;
use App\Notifications\IncidentCreated;
use App\User;
use App\Incident;
use Spatie\Permission\Models\Role;

class IncidentApprovalObserver
{
    /**
     * Handle the incident approval "created" event.
     *
     * @param  \App\IncidentApproval  $incidentApproval
     * @return void
     */
    public function created(IncidentApproval $incidentApproval)
    {
        if($incidentApproval->incident->stage_id == 3)
        {
            $role = Role::findByName('service desk');
            $collection = $role->users;

            $collection->each(function ($item, $key) use ($incidentApproval) {
                $item->notify(new IncidentCreated($incidentApproval));
            });
            
        }
        else if($incidentApproval->incident->stage_id == 6)
        {
            $user = User::find($incidentApproval->incident->user_id);
            $user->notify(new IncidentCreated($incidentApproval));
        }
        else if($incidentApproval->incident->stage_id == 9)
        {
            $role = Role::findByName('service desk');
            $collection = $role->users;

            $collection->each(function ($item, $key) use ($incidentApproval) {
                $item->notify(new IncidentCreated($incidentApproval));
            });
        }
        else if($incidentApproval->incident->stage_id == 4)
        {
            $user = User::find($incidentApproval->incident->user_id);
            $user->notify(new IncidentCreated($incidentApproval));
        }
        
    }

    /**
     * Handle the incident approval "updated" event.
     *
     * @param  \App\IncidentApproval  $incidentApproval
     * @return void
     */
    public function updated(IncidentApproval $incidentApproval)
    {
        //
    }

    /**
     * Handle the incident approval "deleted" event.
     *
     * @param  \App\IncidentApproval  $incidentApproval
     * @return void
     */
    public function deleted(IncidentApproval $incidentApproval)
    {
        //
    }

    /**
     * Handle the incident approval "restored" event.
     *
     * @param  \App\IncidentApproval  $incidentApproval
     * @return void
     */
    public function restored(IncidentApproval $incidentApproval)
    {
        //
    }

    /**
     * Handle the incident approval "force deleted" event.
     *
     * @param  \App\IncidentApproval  $incidentApproval
     * @return void
     */
    public function forceDeleted(IncidentApproval $incidentApproval)
    {
        //
    }
}
