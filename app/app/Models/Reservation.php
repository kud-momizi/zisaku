<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function availability()
    {
        return $this->belongsTo(Availability::class);
    }

    public $timestamps = false;
}
