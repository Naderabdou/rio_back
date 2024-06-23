<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Onboard;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductDetails;
use Database\Seeders\ColorSeed;
use Illuminate\Database\Seeder;
use Database\Seeders\SettingTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
          $this->call(RoleTableSeeder::class);
        $this->call(SettingTableSeeder::class);
         $this->call(ConnectivityToolSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(BrandSeeder::class);
         $this->call(CategorySeeder::class);


        $products = Product::factory(40)->create();

        // لكل منتج، إنشاء تفاصيل وصور
        $products->each(function ($product) {
            ProductDetails::factory(3)->create(['product_id' => $product->id]);
            ProductImages::factory(5)->create(['product_id' => $product->id]);
        });
    }
}
