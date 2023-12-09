<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $fillable = ["product_name", "product_description", "product_price", "product_stock", "seller_id"];

    public function categories() {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
}
