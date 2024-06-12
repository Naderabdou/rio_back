<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getKeyAttribute()
    {
        return $this->attributes['key_' . app()->getLocale()];
    } // end getTitleAttribut

    public function getValueAttribute()
    {
        return $this->attributes['value_' . app()->getLocale()];
    } // end getTitleAttribut


   


}
