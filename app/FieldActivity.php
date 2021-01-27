<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldActivity extends Model
{
  protected $fillable = [
    'field',
  ];

  public function companies()
  {
    return $this->belongsToMany(
      'App\Company',
      'field_activity_company', 
      'company_id', 
      'field_activity_id'
    );
  }
}
