<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Brand;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->longText('description');
            $table->float('price', 6, 2);
            $table->float('sale_price', 6, 2);
            $table->foreignIdFor(Category::class, 'category_id');
            $table->foreignIdFor(SubCategory::class, 'sub_category_id');
            $table->foreignIdFor(Brand::class, 'brand_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
