<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestApproval extends Model
{
    //
   

    protected $fillable = ['id','request_id','user_id','status_id'];

    public function request()
    {
        return $this->belongsTo('App\ITRequest');
    }
}
