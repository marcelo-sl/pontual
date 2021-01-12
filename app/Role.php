<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $fillable = [
        'role_name',
    ];

    public function users()
    {
        return $this->belongsToMany('User', 'role_user', 'user_id', 'role_id');
    }
}
