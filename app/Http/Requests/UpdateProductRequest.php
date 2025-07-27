<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => 'required|string|min:3|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
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
            'description.required' => 'Description is required.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Each image must be of type: jpeg, png, jpg, webp.',
            'images.*.max' => 'Each image size should not be greater than 5MB.',
        ];
    }
}
