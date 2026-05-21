<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    // Satu area memiliki banyak user
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Satu area memiliki banyak data inputan (Melalui User)
    public function spinInputs()
    {
        return $this->hasManyThrough(SpinInput::class, User::class);
    }
}