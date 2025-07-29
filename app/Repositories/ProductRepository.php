<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function create(array $data): Product
    {
        DB::beginTransaction();

        try {
            $product = Product::create([
                'name'        => $data['product_name'],
                'slug'        => Str::slug($data['product_name']),
                'price'       => $data['price'],
                'quantity'    => $data['quantity'],
                'description' => $data['description'],
                'status'      => $data['status'],
            ]);

            if (!empty($data['images'])) {
                foreach ($data['images'] as $imagePath) {
                    $product->images()->create([
                        'images' => $imagePath,
                    ]);
                }
            }

            DB::commit();
            return $product;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Product $product, array $data): Product
    {
        $product->update([
            'name'        => $data['name'],
            'slug'        => Str::slug($data['name']),
            'price'       => $data['price'],
            'quantity'    => $data['quantity'],
            'description' => $data['description'],
            'status'      => $data['status'],
        ]);

        return $product;
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }

    public function find(int $id): ?Product
    {
        return Product::find($id);
    }
}
