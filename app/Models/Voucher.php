<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function user_voucher(){
        return $this->hasOne(UserVoucher::class, 'id', 'voucher_id' );
    }
}
