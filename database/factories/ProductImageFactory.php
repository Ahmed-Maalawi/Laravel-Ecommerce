<?php

namespace Database\Factories;

use App\Models\product\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**true
 * @extends Factory<ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'image_path' => fake()->imageUrl(),
        ];
    }
}
