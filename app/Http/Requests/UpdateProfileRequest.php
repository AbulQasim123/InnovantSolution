<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        $customerId = $this->user()?->id;

        return [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150|unique:customers,email,' . $customerId,
            'mobile'  => 'required|digits:10|numeric|unique:customers,mobile,' . $customerId,
            'address' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Name is required.',
            'name.string'      => 'Name must be a string.',
            'name.max'         => 'Name must not exceed 100 characters.',
            'email.required'   => 'Email is required.',
            'email.email'      => 'Email must be a valid email address.',
            'email.max'        => 'Email must not exceed 150 characters.',
            'email.unique'     => 'This email is already taken.',
            'mobile.required'  => 'Mobile number is required.',
            'mobile.digits'    => 'Mobile number must be exactly 10 digits.',
            'mobile.numeric'   => 'Mobile number must be numeric.',
            'mobile.unique'    => 'This mobile number is already taken.',
            'address.string'   => 'Address must be a valid string.',
            'address.max'      => 'Address must not exceed 255 characters.',
        ];
    }
}
