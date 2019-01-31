<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\RequestObserver;
use App\Observers\IncidentObserver;
use App\Observers\RequestApprovalObserver;
use App\Observers\IncidentApprovalObserver;
use Illuminate\support\Facades\Schema;
use App\ITRequest;
use App\RequestApproval;
use App\Incident;
use App\IncidentApproval;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        ITRequest::observe(RequestObserver::class);
        Incident::observe(IncidentObserver::class);
        RequestApproval::observe(RequestApprovalObserver::class);
        IncidentApproval::observe(IncidentApprovalObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
