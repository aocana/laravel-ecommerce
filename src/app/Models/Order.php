<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = ['user_id', 'status'];

    public function products()
    {
        $this->belongsToMany(Product::class);
    }
}
