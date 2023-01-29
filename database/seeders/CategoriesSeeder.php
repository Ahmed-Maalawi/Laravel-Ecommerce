<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\product\ProductImage;
use App\Models\ProductThumbnail;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['super market', 'electronics', 'home & kitchen', 'baby'];

        $subcategory_1 = ['oil, ghee & vinegar', 'rice, pasta & grains', 'home care & cleaning', 'canned food', 'beverages', 'haircare', 'feminine care', 'shavers', 'bath & body', 'skincare'];

        $subcategory_2 = ['networking', 'wearables', 'mobiles', 'gaming', 'tablets', 'headphones', 'data storage', 'cameras', 'tvs', 'laptops'];

        $subcategory_3 = ['cooking', 'cleaning', 'home decor', 'bedding', 'appliances', 'lighting', 'serving', 'home improvement'];

        $subcategory_4 = ['baby transport', 'toys', 'baby bottles & bibs', 'bathing & baby care', 'diapers & wipes', 'rockers & bouncers'];

        foreach ($categories as $category) {
            Category::factory()->create([
                'name' => $category
            ]);
        }

        foreach ($subcategory_1 as $item) {
            SubCategory::factory()->create([
                'name' => $item,
                'category_id' => 1,
            ]);
        }

        foreach ($subcategory_2 as $item) {
            SubCategory::factory()->create([
                'name' => $item,
                'category_id' => 2,
            ]);
        }

        foreach ($subcategory_3 as $item) {
            SubCategory::factory()->create([
                'name' => $item,
                'category_id' => 3,
            ]);
        }

        foreach ($subcategory_4 as $item) {
            SubCategory::factory()->create([
                'name' => $item,
                'category_id' => 4,
            ]);
        }
    }
}
