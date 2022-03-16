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

    public function shouldBeSearchable()
    {
        return $this->is_visible === true;
    }

    static function searchFilter($product)
    {
        return self::search($product)->paginate(12)->withQueryStrings();
    }
}
