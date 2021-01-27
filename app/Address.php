<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    
    protected $fillable = [
      'cep', 'address', 'house_number', 'district', 'address_complement',
      'city_id', 'company_id'
    ];

    public function cities()
    {
      return $this->belongsTo('App\City');
    }

    public function companies()
    {
      return $this->belongsTo('App\Company');
    }
}
