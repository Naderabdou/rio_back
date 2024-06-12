<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $fillable = ['icon', 'title_ar', 'title_en', 'desc_ar', 'desc_en', 'type'];

    protected $appends = ['icon_path'];



    public function getDescAttribute()
    {
        return $this->attributes['desc_' . app()->getLocale()];
    } // end getNameAttribute

    public function getTitleAttribute()
    {
        return $this->attributes['title_' . app()->getLocale()];
    } // end getNameAttribute

    public function getIconPathAttribute()
    {
        return asset('storage/' . $this->icon);
    } // end getNameAttribute

}
