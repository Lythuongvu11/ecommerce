<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class, 'cart_id')->with('product');
    }



}
