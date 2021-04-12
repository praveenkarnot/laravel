<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class,'uuid','product_sku');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
