<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestReasonfile extends Model
{
    //

    public function request()
    {
        return $this->belongsTo('App\ITRequest');
    }
}
