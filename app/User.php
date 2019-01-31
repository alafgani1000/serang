<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function requests()
    {
        return $this->hasMany('App\ITRequest');
    }

    public function incidents()
    {
        return $this->hasMany('App\Incident');
    }

    public function getIdWithNameAttribute()
    {
        return $this->id .' '. $this->name;
    }

    public function boss()
    {
        $json = file_get_contents(
            "http://eos.krakatausteel.com/api/structdisp/"
            . $this->id 
            . "/minManagerBoss"
        );
        $data = json_decode($json,true);
        return User::find($data['personnel_no']);
    }
}
