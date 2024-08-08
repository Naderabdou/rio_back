<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory,Sluggable;

    protected $guarded = [];
    protected $appends = ['image_path'];

    //get translation name
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    } // end getTitleAttribut
    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }
}
