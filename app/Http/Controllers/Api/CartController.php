<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    // add to cart
    public function addToCart(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id'   => 'required|exists:products,id',
                'quantity'     => 'required|integer|min:1',
                'customer_id'  => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed.',
                    'errors'  => $validator->errors()
                ], 422);
            }

            if ($request->customer_id != 1) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Unauthorized: Invalid customer ID.'
                ], 403);
            }

            $cart = Cart::create([
                'customer_id'    => $request->customer_id,
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Product added to cart successfully.',
                'data'   => $cart
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => 'An unexpected error occurred while adding to cart.',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }

    // get cart
    public function getCart(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'customer_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed.',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            if ($request->customer_id != 1) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Unauthorized: Invalid customer ID.'
                ], 403);
            }

            $cartItems = Cart::with('product.images')
                ->where('customer_id', $request->customer_id)
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Cart is empty.',
                ], 200);
            }

            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            return response()->json([
                'status' => true,
                'total'  => $total,
                'data'   => CartResource::collection($cartItems),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => 'An unexpected error occurred while fetching cart items.',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }

    // update cart
    public function updateCart(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'cart_id'  => 'required|integer',
                'action'   => 'required|in:plus,minus',
                'quantity' => 'required|integer|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed.',
                    'errors'  => $validator->errors()
                ], 422);
            }

            $cartItem = Cart::with('product')->find($request->cart_id);

            if (!$cartItem) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found. Please check the cart ID.'
                ], 200);
            }

            if ($cartItem->customer_id !== 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized access to cart item.'
                ], 403);
            }

            if ($request->action === 'plus') {
                $newQty = $cartItem->quantity + $request->quantity;
            } else {
                $newQty = $cartItem->quantity - $request->quantity;
                if ($newQty < 1) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Quantity cannot be less than 1.'
                    ], 422);
                }
            }

            $cartItem->update(['quantity' => $newQty]);

            $allCartItems = Cart::with('product')
                ->where('customer_id', 1)
                ->get();

            $total = $allCartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            return response()->json([
                'status'  => true,
                'message' => 'Cart item quantity updated successfully.',
                'total'   => $total,
                'data'    => $cartItem
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => 'An unexpected error occurred while updating cart.',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }

    // delete cart
    public function deleteCart(Request $request)
    {
        try {
            $cartId = $request->cart_id;
            if (!$cartId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart ID is required.'
                ], 422);
            }

            $cartItem = Cart::find($cartId);

            if (!$cartItem) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found. Please check the cart ID.'
                ], 200);
            }

            if ($cartItem->customer_id !== 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized access to cart item.'
                ], 403);
            }

            $cartItem->delete();

            return response()->json([
                'status' => true,
                'message' => 'Cart item deleted successfully.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while deleting cart.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }


    public function checkout(Request $request)
    {
        // Stripe payment integration logic
    }
}
