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

    protected $fillable = ['user_id', 'status', 'checkout_id'];

    /* Relations */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProduct()
    {
        return $this->hasMany(Order_Product::class);
    }


    /* Scout */
    public function searchableAs(): string
    {
        return 'orders';
    }

    public function sortableAttributes(): array
    {
        return ['status'];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->user->email,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
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
