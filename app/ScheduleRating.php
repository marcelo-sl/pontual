<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleRating extends Model
{
    protected $table = 'schedule_rating';

    protected $fillable = [
        'rate', 'schedule_id'
    ];

    public function schedule()
    {
        return $this->belongsTo('App\Schedule');
    }
}
