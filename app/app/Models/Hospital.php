<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}

