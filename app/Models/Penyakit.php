<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rule()
    {
        return $this->hasOne(Rule::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $count = self::count() + 1;
            $model->kode_penyakit = 'P' . str_pad($count, 2, '0', STR_PAD_LEFT);
        });
    }
}
