<?php

namespace Database\Factories;

use App\Models\Brand;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $name_ar = $this->faker->words(3, true);
        $name_en = $this->faker->words(3, true);
        $price = $this->faker->randomFloat(2, 10, 100);
        $discount = $this->faker->randomFloat(2, 1, 10);
        $price_after_discount = $price - $discount;

        return [
            'name_ar' => $name_ar,
            'name_en' => $name_en,
            'sub_title_ar' => $this->faker->sentence,
            'sub_title_en' => $this->faker->sentence,
            'slug' => Str::slug($name_en),
            'desc_ar' => $this->faker->paragraph,
            'desc_en' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
            'price' => $price,
            'discount' => $discount,
            'is_active' => $this->faker->boolean,
            'label_ar' => $this->faker->word,
            'label_en' => $this->faker->word,
            'label_color' => $this->faker->hexColor,
            'price_after_discount' => $price_after_discount,
            'stock' => $this->faker->numberBetween(0, 100),
            'has_offer' => $this->faker->boolean,
            //get brand random from bd
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }


}
