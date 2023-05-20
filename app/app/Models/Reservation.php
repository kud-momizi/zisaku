<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function availability()
    {
        return $this->belongsTo(Availability::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $timestamps = false;
}
