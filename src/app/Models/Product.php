<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;


    protected $fillable = [
        'name',
        'slug',
        'file_path',
        'description',
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
    public function searchableAs()
    {
        return 'products';
    }

    public function sortableAttributes()
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
        ];
    }

    static function searchFilter($query, $options)
    {
        $searchResults =  self::search($query, function ($meilisearch, $query) use ($options) {
            $meilisearch->search($query, $options);
        })
            ->paginate(9);

        return $searchResults;
    }
}
