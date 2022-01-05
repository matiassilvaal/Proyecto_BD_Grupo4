<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function game()
    {
        return $this->hasMany('App\Models\Game');
    }
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
}
