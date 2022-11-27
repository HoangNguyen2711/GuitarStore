<?php

namespace App\Models\Client;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rating as RateableRating;

class Rating extends RateableRating
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
