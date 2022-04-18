<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Searchable;

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

    /* Meilisearch conf */
    public function getScoutKey(): int
    {
        return $this->id;
    }

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
            'id'   => $this->id,
            'name' => $this->name,
            'price' => $this->price,
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
