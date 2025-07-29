<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreAddToCartRequest;

class CartController extends Controller
{
    // add to cart
    public function addToCart(StoreAddToCartRequest $request)
    {
        try {
            $customer = $request->user();
            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not authenticated.'
                ], 401);
            }

            $product = Product::find($request->product_id);

            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found.'
                ], 404);
            }

            if ($request->quantity > $product->quantity) {
                return response()->json([
                    'status' => false,
                    'message' => 'Requested quantity exceeds available stock.'
                ], 422);
            }

            $existingCartItem = Cart::where('customer_id', $customer->id)
                ->where('product_id', $request->product_id)
                ->first();

            if ($existingCartItem) {
                $newQty = $existingCartItem->quantity + $request->quantity;

                if ($newQty > $product->quantity) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Updated quantity exceeds available stock.'
                    ], 422);
                }

                $existingCartItem->update(['quantity' => $newQty]);

                return response()->json([
                    'status' => true,
                    'message' => 'Cart item quantity updated successfully.',
                    'data' => $existingCartItem
                ], 200);
            }

            $cart = Cart::create([
                'customer_id' => $customer->id,
                'product_id'  => $product->id,
                'quantity'    => $request->quantity
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Product added to cart successfully.',
                'data' => $cart
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while adding to cart.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    // get cart
    public function getCart(Request $request)
    {
        try {
            $customer = $request->user();
            if (!$customer) {
                return response()->json([
                    'status'  => false,
                    'message' => 'User not authenticated.',
                ], 401);
            }

            $cartItems = Cart::with('product.images')
                ->where('customer_id', $customer->id)
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Cart is empty.',
                ], 200);
            }

            $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

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

            $customer = $request->user();

            $cartItem = Cart::with('product')->find($request->cart_id);

            if (!$cartItem) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found. Please check the cart ID.'
                ], 404);
            }

            if ($cartItem->customer_id !== $customer->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized access to cart item.'
                ], 403);
            }

            $product = $cartItem->product;

            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Associated product not found.'
                ], 404);
            }

            if ($request->action === 'plus') {
                $newQty = $cartItem->quantity + $request->quantity;

                if ($newQty > $product->quantity) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Requested quantity exceeds available stock.'
                    ], 422);
                }
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
                ->where('customer_id', $customer->id)
                ->get();

            $total = $allCartItems->sum(fn($item) => $item->product->price * $item->quantity);

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
            $customer = $request->user();

            $cartItem = Cart::find($request->cart_id);

            if (!$cartItem) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart item not found. Please check the cart ID.'
                ], 404);
            }

            if ($cartItem->customer_id !== $customer->id) {
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
        try {
            $customer = $request->user();
            if (!$customer) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not authenticated.'
                ], 401);
            }

            $cartItems = Cart::with('product')
                ->where('customer_id', $customer->id)
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart is empty.'
                ], 422);
            }

            // Check stock
            foreach ($cartItems as $item) {
                if ($item->quantity > $item->product->quantity) {
                    return response()->json([
                        'status' => false,
                        'message' => "Insufficient stock for '{$item->product->name}'.",
                        'productMessage' => "Only {$item->product->quantity} item(s) available in stock. You requested {$item->quantity}."
                    ], 422);
                }
            }

            $order = Order::create([
                'customer_id'      => $customer->id,
                'order_number'     => 'ORD-' . strtoupper(uniqid()),
                'total_amount'     => $cartItems->sum(fn($item) => $item->quantity * $item->product->price),
                'status'           => 'pending',
                // Collecting shipping details
                'shipping_name'    => $customer->name,
                'shipping_phone'   => $customer->mobile,
                'shipping_address' => $customer->address,
            ]);


            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);
                $item->product->decrement('quantity', $item->quantity);
            }

            Cart::where('customer_id', $customer->id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Order placed successfully.',
                'data' => new OrderResource($order->load('items.product'))
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred during checkout.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    // pay now
    public function payNow(Request $request)
    {
        try {
            $orderId = $request->order_id;
            if (!$orderId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Order ID is required.'
                ], 422);
            }

            $order = Order::where('id', $request->order_id)
                ->where('customer_id', $request->user()->id)
                ->where('status', 'pending')
                ->first();

            if (!$order) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid or already paid order.'
                ], 404);
            }

            $paymentService = new PaymentService();
            $razorData = $paymentService->createRazorpayOrder($order);

            $order->update([
                'razorpay_order_id' => $razorData['razorpay_order_id']
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Razorpay order created.',
                'data' => [
                    'order_id' => $order->id,
                    'razorpay_order_id' => $razorData['razorpay_order_id'],
                    'razorpay_key' => $razorData['key'],
                    'amount' => $razorData['amount'],
                    'currency' => $razorData['currency'],
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                    'mobile' => $request->user()->mobile
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred during checkout.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        $request->validate([
            'order_id'             => 'required|exists:orders,id',
            'razorpay_payment_id'  => 'nullable|string',
            'razorpay_order_id'    => 'required|string',
            'razorpay_signature'   => 'nullable|string'
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('customer_id', $request->user()->id)
            ->where('razorpay_order_id', $request->razorpay_order_id)
            ->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid order.'
            ], 404);
        }

        // --------------We need to verify the signature from the frontend side----------------

        // $paymentService = new PaymentService();

        // $isValid = $paymentService->verifySignature(
        //     $request->razorpay_order_id,
        //     $request->razorpay_payment_id,
        //     $request->razorpay_signature
        // );

        // if (!$isValid) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Payment verification failed.'
        //     ], 403);
        // }

        // Mark order paid
        $order->update([
            'status' => 'paid',
            'payment_method' => 'razorpay',
            'payment_reference' => $request->razorpay_payment_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Payment verified and order marked as paid.'
        ]);
    }
}
