<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name' => fake()->name(),
            'description' => fake()->text(200),
            'price' => fake()->numberBetween(100, 1000),
            'sale_price' => fake()->numberBetween(100, 1000),
            'category_id' => fake()->numberBetween(1, 2),
            'sub_category_id' => fake()->numberBetween(1,4),
            'brand_id' => fake()->numberBetween(1, 10),
        ];
    }
}
