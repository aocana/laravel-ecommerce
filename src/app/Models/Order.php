<?php

namespace App\Models;

use App\Models\User;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = ['user_id', 'status', 'checkout_id', 'total'];

    /* Relations */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProduct()
    {
        return $this->hasMany(Order_Product::class);
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
