<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_type extends Model
{
    use HasFactory;

    public function comment()
    {
        return $this->hasOne('App\Models\Comment');
    }
}
