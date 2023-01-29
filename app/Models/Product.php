<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product\ProductImage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'product_name',
      'description',
      'price',
      'sale_price',
      'category_id',
      'sub_category_id',
      'brand_id'
    ];

    public function humbnails()
    {
        return $this->hasMany(ProductThumbnail::class);
    }

    public function colors()
    {
        return $this->hasMany(Color::class, 'product_id', 'id');
    }
}
