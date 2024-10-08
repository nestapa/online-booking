<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPoin extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function users() {
        return  $this->belongsTo(User::class, 'user_id');
    }
}
