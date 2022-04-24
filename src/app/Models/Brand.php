<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = ['name', 'image', 'slug'];

    /* Relations */
    public function products()
    {
        return $this->hasMany(Product::class);
    }


    /* Scout */
    public function searchableAs(): string
    {
        return 'brands';
    }

    public function sortableAttributes(): array
    {
        return ['name'];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
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
