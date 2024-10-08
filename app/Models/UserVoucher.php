<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVoucher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function users() {
        return  $this->belongsTo(User::class, 'user_id');
    }

    function voucher() {
        return  $this->belongsTo(Voucher::class, 'voucher_id');
    }
}
