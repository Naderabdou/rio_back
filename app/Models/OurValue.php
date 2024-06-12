<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurValue extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['icon_path'];


    //get translation title
    public function getTitleAttribute()
    {
        return $this->attributes['title_' . app()->getLocale()];
    } // end getTitleAttribut

    public function getDescAttribute()
    {
        return $this->attributes['desc_' . app()->getLocale()];
    } // end getNameAttribute


    public function getIconPathAttribute()
    {
        return asset('storage/' . $this->icon);
    }


}
