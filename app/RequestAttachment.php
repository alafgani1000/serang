<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestAttachment extends Model
{
    protected $fillable = ['attachment'];

    public function request()
    {
        return $this->belongsTo('App\ITRequest');
    }
}
