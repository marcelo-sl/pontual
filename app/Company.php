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

    public function fieldsActivity()
    {
      return $this->belongsToMany(
        'App\FieldActivity',
        'field_activity_company',
        'field_activity_id',
        'company_id'
      );
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }
}
