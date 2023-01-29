<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FavouriteItem;
use App\Models\product\ProductImage;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Color;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            CategoriesSeeder::class,
            ProductiesSeeder::class,
            PaymentTypeSeeder::class,
        ]);

    }
}
