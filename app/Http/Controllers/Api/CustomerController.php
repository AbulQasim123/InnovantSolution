<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // Add Customer
    public function AddCustomer(StoreCustomerRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ];
            $customer = Customer::create($data);
            return response()->json([
                'status' => true,
                'message' => 'Customer added successfully.',
                'data' => $customer
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while Adding customer .',
                'error' => $th->getMessage(),
            ]);
        }
    }

    // Get Customer
    public function getCustomer(Request $request)
    {
        try {
            $selected = ['id', 'name', 'email', 'phone', 'address'];
            $customer = Customer::get($selected);
            if ($customer->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No customer found.'
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Customer fetched successfully.',
                'data' => $customer
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while fetching customer.',
                'error' => $th->getMessage(),
            ]);
        }
    }
}
