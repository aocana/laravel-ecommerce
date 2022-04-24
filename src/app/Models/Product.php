<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Searchable, SoftDeletes;

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


    /* 
    |-------
    |Scout
    |-------
    */
    public function searchableAs(): string
    {
        return 'products';
    }

    public function toSearchableArray(): array
    {
        $attributtes = [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
        ];

        if ($this->category) {
            $attributtes['category'] = $this->category->name;
        }

        if ($this->brand) {
            $attributtes['brand'] = $this->brand->name;
        }

        return $attributtes;
    }

    public function shouldBeSearchable(): bool
    {
        return $this->is_visible == true;
    }


    /* 
    |-----------
    |Relations
    |-----------
    */
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

    /* static function searchFilter(string $query, array $options)
    {
        return MeilisearchService::search('products', $query, $options);
    } */
}
