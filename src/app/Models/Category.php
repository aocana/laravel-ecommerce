<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

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

    static function searchFilter($query, $options)
    {
        $searchResults =  self::search($query, function ($meilisearch) use ($query, $options) {
            return $meilisearch->search($query, $options);
        })
            ->paginate(9);

        return $searchResults;
    }

    /* 
    |-------
    |Scout
    |-------
    */
    public function searchableAs(): string
    {
        return 'categories';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
