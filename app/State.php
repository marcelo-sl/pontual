<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'uf', 'state'
    ];

    public function cities()
    {
        return $this->hasMany('App\City');
    }
}
