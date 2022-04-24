<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

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
        return $this->hasMany(OrderProduct::class);
    }

    /* 
    |-------
    |Scout
    |-------
    */
    public function searchableAs(): string
    {
        return 'order';
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
