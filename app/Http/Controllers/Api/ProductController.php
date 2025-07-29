<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    // get All product
    public function getProdct(Request $request)
    {
        try {
            $selected = ['id', 'name', 'slug', 'price', 'description', 'status'];

            if ($request->has('product_id')) {
                $products = Product::with('images:id,product_id,images')
                    ->where('id', $request->product_id)
                    ->where('status', 1)
                    ->get($selected);
            } else {
                $products = Product::with('images:id,product_id,images')
                    ->where('status', 1)
                    ->get($selected);
            }

            if ($products->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No products found.'
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Products fetched successfully.',
                'data' => ProductResource::collection($products)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while fetching products.',
                'error' => $th->getMessage(),
            ]);
        }
    }
}
