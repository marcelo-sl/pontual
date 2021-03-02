<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'date_time', 'status_id', 'customer_id', 'provider_id', 'company_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    
    public function customer()
    {
        return $this->belongsTo('App\User');
    }
    
    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
