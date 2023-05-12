<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $fillable = [
        'hospital_id',
        'day_of_week',
        'am_start_time',
        'am_end_time',
        'am_limit',
        'pm_start_time',
        'pm_end_time',
        'pm_limit',
        'note',
    ];

    public $timestamps = false;
}
