<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gejalaRule()
    {
        return $this->hasMany(GejalaRule::class);
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $count = self::count() + 1;
            $model->kode_rule = 'R' . str_pad($count, 2, '0', STR_PAD_LEFT);
        });
    }
}
