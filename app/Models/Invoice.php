<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function method()
    {
        return $this->hasOne('App\Models\Method');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function purchase()
    {
        return $this->hasMany('App\Models\Purchase');
    }
}
