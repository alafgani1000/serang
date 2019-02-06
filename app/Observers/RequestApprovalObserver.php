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
        // waiting boss approve stage 1
        if($requestApproval->request->stage_id == Stage::waitingBossApproval()->first()->id)
        {
            $boss = Auth::user()->boss();
            $boss->notify(new RequestCreated($requestApproval));
        }
        // waiting operation desc stage 2
        else if($requestApproval->request->stage_id == Stage::waitingForOperationDesk()->first()->id)
        {
            // notifikasi operation sd
            $role = Role::findByName('operation sd');
            $collection = $role->users;
            $collection->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
            // notifikasi operation sptict
            $role = Role::findByName('operation ict');
            $collection = $role->users;
            $collection->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
            // notifikasi manager
            $role1 = Role::findByName('manager beict');
            $collection1 = $role1->users;
            $collection1->each(function ($item, $key) use ($requestApproval) {
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
        // waiting operation desc stage 3
        else if($requestApproval->request->stage_id == Stage::waitingForServiceDesk()->first()->id)
        {
            // notifikasi to service desk
            $role = Role::findByName('service desk');
            $collection = $role->users;
            $collection->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
            // notifikasi to user request
            $user = User::find($requestApproval->request->user_id);
            $user->notify(new RequestCreated($requestApproval));
        }
        // stage waiting user confirmation
        else if($requestApproval->request->stage_id == Stage::waitingUserConf()->first()->id)
        {
            $user = User::find($requestApproval->request->user_id);
            $boss = $user->boss();
            $boss->notify(new RequestCreated($requestApproval));

            $user1 = User::find($requestApproval->request->user_id);
            $user1->notify(new RequestCreated($requestApproval));
        }
        else if($requestApproval->request->stage_id == 9)
        {
            $role = Role::findByName('service desk');
            $collection = $role->users;

            $collection->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
        }
        // stage request rejected 11
        else if($requestApproval->request->stage_id == Stage::requestRejected()->first()->id)
        {
            // notifikasi to service desk
            $role = Role::findByName('service desk');
            $collection = $role->users;
            $collection->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
            // notifikasi to manager beict
            $role1 = Role::findByName('manager beict');
            $collection1 = $role1->users;
            $collection1->each(function ($item, $key) use ($requestApproval) {
                $item->notify(new RequestCreated($requestApproval));
            });
            // notifikasi to user request
            $user = User::find($requestApproval->request->user_id);
            $user->notify(new RequestCreated($requestApproval));
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
        // stage ticket created 4
        else if($requestApproval->request->stage_id == Stage::ticketCreated()->first()->id)
        {
            // notifikasi to user request
            $user = User::find($requestApproval->request->user_id);
            $user->notify(new RequestCreated($requestApproval));
            // notifiksi to service desk
            $user = User::find($requestApproval->user_id);
            $user->notify(new RequestCreated($requestApproval));
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
