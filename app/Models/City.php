<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'city_id', 'id');
    }

    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    } // end getTitleAttribut

}
