<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\AuthResource;

class AuthController extends Controller
{
    public function RegisterCustomer(StoreCustomerRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
            ];
            $customer = Customer::create($data);
            return response()->json([
                'status' => true,
                'message' => 'Customer added successfully.',
                'data' => new AuthResource($customer)
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while Adding customer .',
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_no' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        try {
            // Find or create customer
            $customer = Customer::where('mobile', $request->mobile_no)->first();
            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Customer not found',
                ]);
            }

            // Generate and save OTP
            $otp = $this->generateOtp();

            $customer->update([
                'otp' => $otp,
                'expired_at' => Carbon::now()->addMinutes(10),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'We’ve sent an OTP to your mobile number.',
                'otp' => $otp,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while sending OTP.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    protected function generateOtp()
    {
        return rand(1000, 9999);
    }

    // Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_no' => 'required|digits:10',
            'otp' => 'required|digits:4',
            'fcm_token' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        try {
            $customer = Customer::where('mobile', $request->mobile_no)
                ->where('otp', $request->otp)
                ->where('expired_at', '>', now())
                ->first();

            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP or mobile'
                ], 401);
            }

            $customer->update(['otp' => null, 'expired_at' => null, 'fcm_token' => $request->fcm_token]);

            $token = $customer->createToken('CustomerToken')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'token_type' => 'Bearer',
                'token' => $token,
                'data' => new AuthResource($customer)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while logging in.',
                'error' => $th->getMessage(),
            ]);
        }
    }

    // Profile
    public function profile(Request $request)
    {
        try {
            $customer = $request->user();

            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Customer not found.'
                ], 401);
            }

            return response()->json([
                'status' => true,
                'message' => 'Profile fetched successfully',
                'data' => new AuthResource($customer)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while fetching profile.',
                'error' => $th->getMessage(),
            ]);
        }
    }


    // Update profile
    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            $customer = $request->user();

            $customer->update([
                'name'    => $request->name,
                'email'   => $request->email,
                'mobile'  => $request->mobile,
                'address' => $request->address,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Profile updated successfully.',
                'data'    => new AuthResource($customer)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => 'An unexpected error occurred while updating profile.',
                'error'   => $th->getMessage()
            ], 500);
        }
    }

    // Logout
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            // $request->user()->tokens()->delete(); All device logout

            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while logging out.',
                'error' => $th->getMessage(),
            ]);
        }
    }

    // Delete account
    public function deleteAccount(Request $request)
    {
        try {
            $customer = $request->user();
            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            $customer->delete();

            return response()->json([
                'status' => true,
                'message' => 'Account Deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while deleting account.',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
