<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shoppingCart extends Model
{
    use HasFactory;


    public function shoppingItems()
    {
        return $this->hasMany(shoppingCartItem::class);
    }
}
