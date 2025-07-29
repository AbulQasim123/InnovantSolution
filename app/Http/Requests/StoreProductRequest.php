<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => 'required|string|min:3|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'description' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'status' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.required' => 'Product name is required.',
            'product_name.string' => 'Product name must be a string.',
            'product_name.min' => 'Product name must be at least 3 characters long.',
            'product_name.max' => 'Product name must not exceed 255 characters.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'price.min' => 'Price cannot be negative.',
            'quantity.required' => 'Quantity is required.',
            'quantity.numeric' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity cannot be negative.',
            'description.required' => 'Description is required.',
            'images.required' => 'At least one image is required.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Each image must be of type: jpeg, png, jpg, webp.',
            'images.*.max' => 'Each image size should not be greater than 5MB.',
            'status.required' => 'Status is required.',
        ];
    }
}
