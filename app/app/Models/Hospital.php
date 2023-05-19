<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function availability()
    {
        return $this->belongsTo(Availability::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'hospital_tags', 'hospital_id', 'tag_id');
    }

    
}

