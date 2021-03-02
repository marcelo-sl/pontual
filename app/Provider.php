<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'providers';

    public $timestamps = true;

    protected $fillable = [
      'cpf', 'nickname', 'description'
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function address()
    {
      return $this->hasOne('App\Address');
    }

    public function workingHours()
    {
      return $this->hasMany('App\WorkingHour');
    }

    public function fieldsActivities()
    {
        return $this->belongsToMany(
          'App\FieldActivity',
          'provider_activity',
          'provider_id',
          'field_activity_id'
        );
    }
}
