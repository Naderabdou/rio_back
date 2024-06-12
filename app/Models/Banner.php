<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'color' => 'json'
    ];

    public function getTitleAttribute()
    {
        return $this->attributes['title_' . app()->getLocale()];
    } // end getTitleAttribut

    public function getSubTitleAttribute()
    {
        return $this->attributes['sub_title_' . app()->getLocale()];
    } // end getSubTitleAttribute

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }



}
