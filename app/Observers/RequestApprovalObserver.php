<?php

namespace App\Observers;

use App\RequestApproval;
use App\Notifications\RequestCreated;
use App\Notifications\RequestBossApproved;
use App\User;
use App\Status;
use App\ITRequest;
use Illuminate\Support\Facades\Auth;
use App\Stage;
use Spatie\Permission\Models\Role;
use App\Service;

class RequestApprovalObserver
{
    /**
     * Handle the request approval "created" event.
     *
     * @param  \App\RequestApproval  $requestApproval
     * @return void
     */
    public function created(RequestApproval $requestApproval)
    {
        if($requestApproval->request->stage_id == 1)
        {
            $boss = Auth::user()->boss();
            $boss->notify(new RequestCreated($requestApproval));
        }
        else if($requestApproval->request->stage_id == 2)
        {
            $role = Role::findByName('operation sd');
            $collection = $role->users;

            $collection->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
        }
        else if($requestApproval->request->stage_id == 7)
        {
            $role = Role::findByName('operation ict');
            $collection = $role->users;

            $collection->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
        }
        else if($requestApproval->request->stage_id == 3)
        {
            $role = Role::findByName('service desk');
            $collection = $role->users;

            $collection->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
        }
        else if($requestApproval->request->stage_id == 6)
        {
            $user = User::find($requestApproval->request->user_id);
            $user->notify(new RequestCreated($requestApproval));
        }
        else if($requestApproval->request->stage_id == 9)
        {
            $role = Role::findByName('service desk');
            $collection = $role->users;

            $collection->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
        }
        else if($requestApproval->request->stage_id == 8)
        {
            $role = Role::findByName('service desk');
            $collection = $role->users;

            $collection->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
        }
        else if($requestApproval->request->stage_id == 10)
        {
            $sorole = Service::find($requestApproval->request->service_id);
           
            $role = Role::find($sorole->role_id);
            $user = $role->users;
            $user->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
        }

    }

    /**
     * Handle the request approval "updated" event.
     *
     * @param  \App\RequestApproval  $requestApproval
     * @return void
     */
    public function updated(RequestApproval $requestApproval)
    {
        
    }

    /**
     * Handle the request approval "deleted" event.
     *
     * @param  \App\RequestApproval  $requestApproval
     * @return void
     */
    public function deleted(RequestApproval $requestApproval)
    {
        //
    }

    /**
     * Handle the request approval "restored" event.
     *
     * @param  \App\RequestApproval  $requestApproval
     * @return void
     */
    public function restored(RequestApproval $requestApproval)
    {
        //
    }

    /**
     * Handle the request approval "force deleted" event.
     *
     * @param  \App\RequestApproval  $requestApproval
     * @return void
     */
    public function forceDeleted(RequestApproval $requestApproval)
    {
        //
    }
}
