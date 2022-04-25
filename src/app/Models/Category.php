<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Searchable;

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
