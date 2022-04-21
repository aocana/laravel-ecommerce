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

    /* Relations */
    public function category()
    {
        $this->belongsTo(Category::class);
    }

    public function brand()
    {
        $this->belongsTo(Brand::class);
    }

    public function orders()
    {
        return $this->hasMany(Order_Product::class);
    }


    /* Scout */
    public function searchableAs(): string
    {
        return 'products';
    }

    public function sortableAttributes(): array
    {
        return ['price'];
    }

    public function shouldBeSearchable(): bool
    {
        return $this->is_visible === true;
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'category' => $this->category_id->name,
            'brand' => $this->brand_id->name,
        ];
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
