<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;
    Protected $guarded = [];


        protected $appends = ['image_path'];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }

}
