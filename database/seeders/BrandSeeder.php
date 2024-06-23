<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Brand::insert([[
        'name_ar' => 'أدوات المطبخ',
        'name_en' => 'Kitchen Tools',
       ] ,
        [
        'name_ar' => 'أدوات منزلية',
        'name_en' => 'Home Tools',
        ],

        [
            'name_ar' => 'اطفال و مدارس',
            'name_en' => 'Kids & Schools',
        ] ,

        [
            'name_ar' => 'زجاجات وادوات شرب ',
            'name_en' => 'Bottles & Drinking Tools',
        ] ,

        [
            'name_ar' => 'أدوات تخزين وتنظيم ',
            'name_en' => 'Storage & Organization Tools',
        ] ,

        [
            'name_ar' => 'سلات مهملات ',
            'name_en' => 'Trash Baskets',
        ] ,

        [
            'name_ar' => 'منتجات اخري بضمان ريو',
            'name_en' => 'Other Products with Rio Warranty',
        ]

        ]


    );
    }
}
