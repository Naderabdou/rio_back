<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([[
            'name_ar' => 'بلاستيك',
            'name_en' => 'Plastic',
            'slug' => 'plastic',
            'image' => 'site/images/c2.png',
        ],
        [
            'name_ar' => 'ألومنيوم',
            'name_en' => 'Aluminum',
            'slug' => 'aluminum',
            'image' => 'site/images/c2.png',
        ] ,
        [
            'name_ar' => 'سليكون',
            'name_en' => 'Silicone',
            'slug' => 'silicone',
            'image' => 'site/images/c2.png',
        ] ,
        [
            'name_ar' => 'زجاج',
            'name_en' => 'Glass',
            'slug' => 'glass',
            'image' => 'site/images/c2.png',
        ] ,

        [
            'name_ar' => 'أكليريك',
            'name_en' => 'Acrylic',
            'slug' => 'acrylic',
            'image' => 'site/images/c2.png',
        ]
     ]
 );
    }
}
