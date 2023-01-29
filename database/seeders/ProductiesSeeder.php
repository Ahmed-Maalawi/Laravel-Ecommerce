<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = SubCategory::all();

//        foreach ($categories as $category) {
        $categories->each(function ($category) {
            Product::factory()->count(5)->create()->each(function ($product) {

                Color::factory()->count(3)->create([
                    'product_id' => $product['id']
                ]);

                ProductThumbnail::factory()->count(5)->create([
                    'product_id' => $product['id']
                ]);
            });
        });

    }
}
