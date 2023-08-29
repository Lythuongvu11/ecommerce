<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'size',
        'color',
        'price',
        'old_price',
        'image',

    ];
    public function details()
    {
        return $this->hasMany(ProductDetail::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}

