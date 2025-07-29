<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:25',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|unique:customers,mobile|regex:/^[6-9]\d{9,9}$/',
            'address' => 'required|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must not exceed 25 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'Email already exists.',
            'mobile.required' => 'Mobile number is required.',
            'mobile.numeric' => 'Mobile number must be numeric.',
            'mobile.unique' => 'Mobile number already exists.',
            'mobile.digits' => 'Mobile number must be 10 digits.',
            'mobile.regex' => 'Enter a valid mobile number (10 digits, starting with 6–9).',
            'address.required' => 'Address is required.',
            'address.min' => 'Address must be at least 3 characters.',
            'address.max' => 'Address must not exceed 255 characters.'
        ];
    }
}
