<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name', 'image', 'slug'];

    /* Relations */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function searchableAs(): string
    {
        return 'brands';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    /* cache */
    protected static function booted()
    {
        static::saving(function () {
            Cache::forget('brands');
        });

        static::deleted(function () {
            Cache::forget('brands');
        });
    }
}
