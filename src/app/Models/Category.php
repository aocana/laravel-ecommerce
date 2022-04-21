<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = ['name', 'slug'];


    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /* Relations */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /* Scout */
    public function searchableAs(): string
    {
        return 'categories';
    }

    public function sortableAttributes(): array
    {
        return ['name'];
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->brands,
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
