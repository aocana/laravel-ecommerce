<?php

namespace App\Rules;

use App\Models\Product;
use App\Http\Controllers\CartController;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class InStock implements Rule, DataAwareRule
{
    protected $data = [];

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $validation = false;
        $key = explode('.', $attribute)[1];
        $product = Product::where('stripe_price_id', $this->data['ids'][$key])->first();
        if ($product) {
            $canBuyProduct = $product->stock > $value;
            if ($canBuyProduct) {
                $validation = true;
            } else {
                CartController::deleteFromCart($product);
            }
        }
        return $validation;
    }


    public function message()
    {
        return 'No stock';
    }


    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
