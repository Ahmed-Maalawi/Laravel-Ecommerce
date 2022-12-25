<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'phone'
    ];


    public function userIDs()
    {
        return $this->hasMany(UserAddress::class, 'address_id', 'id');
    }
}
