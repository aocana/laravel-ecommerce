<?php

namespace App\Models;

use App\Models\User;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['user_id', 'status', 'checkout_id', 'total'];

    /* Relations */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /* 
    |-------
    |Scout
    |-------
    */
    public function searchableAs(): string
    {
        return 'orders';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'customer' => $this->user->email,
            'status' => $this->status,
            'created_at' => $this->created_at
        ];
    }
}
