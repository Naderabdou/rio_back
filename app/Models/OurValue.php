<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OurValue extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['icon_path'];
    protected $casts = [
        'product_id' => 'array',
    ];


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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
