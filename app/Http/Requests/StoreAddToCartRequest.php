<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'product_id'   => 'required|integer|exists:products,id',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required'   => 'Product ID is required.',
            'product_id.integer'    => 'Product ID must be an integer.',
            'product_id.exists'     => 'Product not found.',
            'quantity.required'     => 'Quantity is required.',
            'quantity.integer'      => 'Quantity must be an integer.',
            'quantity.min'          => 'Quantity must be at least 1.'
        ];
    }
}
