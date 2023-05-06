<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Get the hospital record associated with the user.
     */
    public function hospital()
    {
        return $this->hasOne(Hospital::class);
    }

    // 他のコード
}