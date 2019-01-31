<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function stage()
    {
        return $this->belongsTo('App\Stage');
    }

    public function incidentApprovals()
    {
        return $this->hasMany('App\IncidentApproval');
    }
    
   
}
