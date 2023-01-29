<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['samsung', 'oppo', 'apple', 'nokia'];

        foreach ($brands as $brand) {
            Brand::factory()->create([
                'name' => $brand,
            ]);
        }
    }
}
