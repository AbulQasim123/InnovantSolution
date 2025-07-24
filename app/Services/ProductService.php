<?php

namespace App\Services;

use Throwable;
use App\Models\Product;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository
    ) {}

    public function createProduct(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct(int $id, array $data): Product
    {
        return DB::transaction(function () use ($id, $data) {
            $product = $this->productRepository->find($id);

            if (! $product) {
                throw new \Exception("Product not found");
            }

            $this->productRepository->update($product, [
                'name'        => $data['product_name'],
                'price'       => $data['price'],
                'description' => $data['description'],
                'status'      => $data['status'],
            ]);

            if (!empty($data['images'])) {
                $product->images()->delete();
                foreach ($data['images'] as $img) {
                    $product->images()->create(['images' => $img]);
                }
            }

            return $product;
        });
    }

    public function deleteProduct(int $id): void
    {
        DB::transaction(function () use ($id) {
            $product = $this->productRepository->find($id);
            if (!$product) {
                throw new \Exception("Product not found");
            }

            foreach ($product->images as $image) {
                ImageHelper::handleDeletedImage(
                    ['images' => $image->images],
                    'images',
                    'uploads/products_images/'
                );
                $image->delete();
            }

            $this->productRepository->delete($product);
        });
    }

    public function findProduct(int $id): ?Product
    {
        return $this->productRepository->find($id);
    }
}
