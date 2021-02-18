<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  protected $fillable = [ 
    'phone_number', 'user_id', 'company_id'
  ];

  public function company()
  {
    return $this->belongsTo('App\Company');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
