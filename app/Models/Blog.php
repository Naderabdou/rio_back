<?php

namespace App\Models;

use App\Observers\BlogsSubscribe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// #[ObservedBy([BlogsSubscribe::class])]
class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['image_path'];

    // get title translation
    public function getTitleAttribute()
    {
        return $this->attributes['title_' . app()->getLocale()];
    } // end getNameAttribute

    public function getDescAttribute()
        {
            return $this->attributes['desc_' . app()->getLocale()];
        } // end getNameAttribute
    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);

    }

    public function getCreatedAtAttribute($value)
    {
        \Carbon\Carbon::setLocale(app()->getLocale());
        return \Carbon\Carbon::parse($value)->translatedFormat('j F Y');
    }
    // get icon url

}
