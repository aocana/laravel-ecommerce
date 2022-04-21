<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Product extends Model
{
    use HasFactory;

    protected $table = 'order_product';

    protected $fillable = ['order_id', 'product_id', 'quantity'];

    public function orders()
    {
        $this->belongsToMany(Order::class);
    }

    public function products()
    {
        $this->belongsToMany(Order_Product::class);
    }
}
