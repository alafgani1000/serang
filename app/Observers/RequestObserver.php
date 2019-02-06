<?php

namespace App\Observers;

use App\ITRequest;
use App\RequestApproval;
use App\Status;
use App\User;
use App\Stage;
use Illuminate\Support\Facades\Auth;

class RequestObserver
{
    /**
     * Handle the request "created" event.
     *
     * @param  \App\ITRequest  $request
     * @return void
     */
    public function created(ITRequest $request)
    {
        $ra = new RequestApproval();
        $ra->request_id = $request->id;
        $ra->user_id = Auth::user()->id;
        $ra->status_id = Status::waitingForApproval()->first()->id;
        $ra->stage_id = Stage::waitingBossApproval()->first()->id;
        $ra->save();

    }

    /**
     * Handle the request "updated" event.
     *
     * @param  \App\ITRequest  $request
     * @return void
     */
    public function updated(ITRequest $request)
    {

    }

    /**
     * Handle the request "deleted" event.
     *
     * @param  \App\ITRequest  $request
     * @return void
     */
    public function deleted(ITRequest $request)
    {
        //
    }

    /**
     * Handle the request "restored" event.
     *
     * @param  \App\ITRequest  $request
     * @return void
     */
    public function restored(ITRequest $request)
    {
        //
    }

    /**
     * Handle the request "force deleted" event.
     *
     * @param  \App\ITRequest  $request
     * @return void
     */
    public function forceDeleted(ITRequest $request)
    {
        //
    }
}
