<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductDetails::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'key_ar' => $this->faker->word,
            'key_en' => $this->faker->word,
            'value_ar' => $this->faker->word,
            'value_en' => $this->faker->word,
        ];
    }
}
