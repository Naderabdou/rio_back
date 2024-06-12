<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory , Sluggable;
    protected $guarded = [];

    protected $appends = ['image_path'];


    //get translation title
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    } // end getTitleAttribut



    // public function getImagePathAttribute()
    // {
    //     return asset('storage/' . $this->image);
    // }
   public function getImagePathAttribute()
    {
        return asset( $this->image); //test
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
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
