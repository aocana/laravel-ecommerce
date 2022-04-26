<?php

namespace App\Rules;

use App\Models\Product;
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
        $key = explode('.', $attribute)[1];
        $product = Product::where('stripe_price_id', $this->data['ids'][$key])->first();
        if ($product) {
            return $product->stock >= $value;
        } else {
            return false;
        }
    }


    public function message()
    {
        return 'The validation error message.';
    }


    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
