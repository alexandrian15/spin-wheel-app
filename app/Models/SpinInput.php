<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpinInput extends Model
{
    // Inputan ini dimiliki oleh seorang user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}