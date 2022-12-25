<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
