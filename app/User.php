<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Role;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'avatar_url', 
        'gender',
        'cpf',
        'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function hasRole($request_role)
    {
        foreach ($this->roles as $role) {
            if ($role->role_name === $request_role) return true;
        }
        return false;
    }

    public function token()
    {
        return $this->hasOne('App\Token');
    }

    public function company()
    {
      return $this->hasOne('App\Company');
    }

    public function provider()
    {
        return $this->hasOne('App\Provider');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule', 'customer_id');
    }

    
}
