<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'file_path',
        'description',
        'price',
        'stock',
        'sku',
        'is_visible',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
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
        $search =  self::search($query, function ($meilisearch, $query) use ($options) {
            $meilisearch->search('', $options);
        })
            ->get();
        /* ->paginate(9); */
        return $search;
    }
}
