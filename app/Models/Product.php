<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\OrderItems;
use App\Models\ProductImages;
use App\Models\ProductDetails;
use App\Models\ProductReviews;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory , Sluggable;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReviews::class, 'product_id', 'id');
    }

//    public function scopeWhenSearch($query, $search)
//     {
//         return $query->when($search, function ($q) use ($search) {
//             return $q->where('name_en', 'like', "%$search%")
//                 ->orWhere('name_ar', 'like', "%$search%");
//             });
//         }




    public function details()
    {
        return $this->hasMany(ProductDetails::class, 'product_id', 'id');
    }

    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    } // end getTitleAttribut

    public function getSubTitleAttribute()
    {
        return $this->attributes['sub_title_' . app()->getLocale()];
    } // end getNameAttribute

    public function getDescAttribute()
    {
        return $this->attributes['desc_' . app()->getLocale()];
    } // end getDescAttribute

    public function getLabelAttribute()
    {
        return $this->attributes['label_' . app()->getLocale()];
    } // end getDescAttribute


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

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('name_en', 'like', "%$search%")
                ->orWhere('name_ar', 'like', "%$search%");
        });
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

}
