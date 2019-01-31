<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidentApproval extends Model
{
    public function incident()
    {
        return $this->belongsTo('App\Incident');
    }
}
