<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address_id',
        'title',
        'image',
        'intro',
        'tel',
        'web_url',
        'user_id',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
