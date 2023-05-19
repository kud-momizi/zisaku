<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalTag extends Model
{
    protected $table = 'hospital_tags';
    
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    public $timestamps = false;
}
