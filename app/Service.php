<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;


class Service extends Model
{
    use HasRoles;

    protected $fillable = ['name'];

    public function requests()
    {
        return $this->hasMany('App\ITRequest');
    }
    
}
