<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ITRequest extends Model
{
    protected $table = 'requests';

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function stage()
    {
        return $this->belongsTo('App\Stage');
    }

    public function requestApprovals()
    {
        return $this->hasMany('App\RequestApproval', 'request_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }
}
