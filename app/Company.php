<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    public $timestamps = true;
    
    protected $fillable = [
      'trade_name', 'company_name', 'cnpj', 'logo_url', 'description', 'user_id', 'inactive'
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function fieldsActivities()
    {
      return $this->belongsToMany(
        'App\FieldActivity',
        'field_activity_company',
        'company_id',
        'field_activity_id'
      );
    }

    public function address()
    {
      return $this->hasOne('App\Address');
    }

    public function workingHours()
    {
      return $this->hasMany('App\WorkingHour');
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
