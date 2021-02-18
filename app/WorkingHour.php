<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkingHour extends Model
{
    use SoftDeletes;

    public $timestamps = true;
    
    protected $fillable = [
      'week_day', 'start_hour', 'end_hour', 'range_hour', 'start_break', 'end_break', 'company_id'
    ];

    public function company()
    {
      return $this->belongsTo('App\Company');
    }

    public function provider()
    {
      return $this->belongsTo('App\Provider');
    }
}
