<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldActivity extends Model
{
  protected $table = 'fields_activity';
  
  protected $fillable = [
    'field',
  ];

  public function companies()
  {
    return $this->belongsToMany(
      'App\Company',
      'field_activity_company', 
      'field_activity_id',
      'company_id'
    );
  }

  public function providers()
  {
    return $this->belongsToMany(
      'App\Provider',
      'provider_activity', 
      'field_activity_id',
      'provider_id'
    );
  }
}
