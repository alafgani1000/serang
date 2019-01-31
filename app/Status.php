<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
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

    public function scopeWaitingForApproval($query)
    {
        $query->where('id', 1);
    }

    public function scopeApproved($query)
    {
        $query->where('id', 2);
    }

    public function scopeRejected($query)
    {
        $query->where('id', 3);
    }
}
