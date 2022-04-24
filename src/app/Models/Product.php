<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'stripe_product_id',
        'stripe_price_id',
        'price',
        'stock',
        'sku',
        'is_visible',
        'brand_id',
        'category_id'
    ];


    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /* Relations */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function ordersProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    static function searchFilter($query, $options)
    {
        $searchResults =  self::search($query, function ($meilisearch) use ($query, $options) {
            return $meilisearch->search($query, $options);
        })
            ->paginate(9);

        return $searchResults;
    }
}
