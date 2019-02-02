<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = ['name'];

    public function requests()
    {
        return $this->hasMany('App\ITRequest');
    }

    public function incidents()
    {
        return $this->hasMany('App\Incident');
    }

    public function scopeWaitingBossApproval($query)
    {
        $query->where('id', 1);
    }

    public function scopeWaitingForOperationDesk($query)
    {
        $query->where('id', 2);
    }

    public function scopeWaitingForServiceDesk($query)
    {
        $query->where('id', 3);
    }

    public function scopeTicketCreated($query)
    {
        $query->where('id', 4);
    }

    public function scopeResolve($query)
    {
        $query->where('id', 5);
    }

    public function scopeWaitingUserConf($query)
    {
        $query->where('id', 6);
    }

    public function scopeWaitingForOperationIct($query)
    {
        $query->where('id', 7);
    }

    public function scopeRequestDenied($query)
    {
        $query->where('id', 8);
    }

    public function scopeClosed($query)
    {
        $query->where('id', 9);
    }

    public function scopeWaitingForSoApproval($query)
    {
        $query->where('id', 10);
    }

    public function scopeRequestRejected($query)
    {
        $query->where('id', 11);
    }
}
