<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartAddItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'products'=>'required|array',
            'products.*.product_variation_id'=>'required|exists:product_variations,id',
            'products.*.quantity'=>'required|numeric|min:1',
            //'products.*.price'=>'required',

        ];
    }
}
