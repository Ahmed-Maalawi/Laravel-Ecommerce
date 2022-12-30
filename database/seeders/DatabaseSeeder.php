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

        Admin::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $users = User::factory(10)->create();

        $brands = Brand::factory()->count(10)->create();

        $categories = Category::factory()
            ->has(SubCategory::factory()->count(2))
            ->count(2)->create();

        $products = Product::factory(20)->create();

        $favourites = FavouriteItem::factory(20)->create();
    }
}
