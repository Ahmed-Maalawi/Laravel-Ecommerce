<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'address_id'
    ];



    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function addresses()
    {
        return $this->belongsTo(Address::class);
    }
}
