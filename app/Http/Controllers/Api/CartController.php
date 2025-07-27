<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Cart;
use Razorpay\Api\Api;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreAddToCartRequest;

class CartController extends Controller
{
    // get All product
    public function getProdct(Request $request)
    {
        try {
            $selected = [
                'id',
                'name',
                'slug',
                'price',
                'description',
                'status',
            ];
            $products = Product::with('images:id,product_id,images')->get($selected);
            if ($products->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No products found.'
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Products fetched successfully.',
                'data' => $products
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while fetching products.',
                'error' => $th->getMessage(),
            ]);
        }
    }

    // add to cart
    public function addToCart(StoreAddToCartRequest $request)
    {
        try {
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

    // checkout
    public function checkout(Request $request)
    {
        // Payment integration logic goes here (e.g., Stripe, Razorpay, PhonePe)
        // In real-world projects, I've integrated Razorpay and PhonePe using client credentials
        // Currently, I can't test any payment gateway because my PAN card is not linked with Aadhaar

        try {
            $request->validate([
                'amount' => 'required|numeric|min:1',
            ]);
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            $order = $api->order->create([
                'receipt'         => 'order_rcpt_' . uniqid(),
                'amount'          => $request->amount * 100,
                'currency'        => 'INR',
                'payment_capture' => 1, // auto capture
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'amount' => $order->amount,
                'currency' => $order->currency,
                'receipt' => $order->receipt
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment initiation failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
