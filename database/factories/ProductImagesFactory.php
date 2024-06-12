<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductImages::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'image' => $this->faker->imageUrl,
        ];
    }
}
