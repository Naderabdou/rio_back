<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'video',
        'type',
        'image_video'
    ];

    protected $appends = ['image_path', 'video_path'];


    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function getVideoPathAttribute()
    {
        return asset('storage/' . $this->video);
    }

    public function getImageVideoPathAttribute()
    {
        return asset('storage/' . $this->image_video);
    }
}
