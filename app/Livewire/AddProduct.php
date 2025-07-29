<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Helpers\ImageHelper;
use Livewire\WithFileUploads;
use Livewire\Attributes\{
    Title,
    Layout,
};

#[Layout('admin.layouts.app')]
#[Title('Add Product')]

class AddProduct extends Component
{
    use WithFileUploads;
    public string $product_name = '';
    public string $price = '';
    public string $quantity = '';
    public string $description = '';
    public array $images = [];
    public string $status = '';

    protected function rules()
    {
        return (new StoreProductRequest())->rules();
    }

    protected function messages()
    {
        return (new StoreProductRequest())->messages();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storeProduct()
    {
        $this->validate();
        sleep(1);
        $uploadedImagePaths = [];
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $uploadedImagePaths[] = ImageHelper::handleUploadedImage($image, 'uploads/products_images');
            }
        }
        $productService = app(ProductService::class);

        $productService->createProduct([
            'product_name' => $this->product_name,
            'price'        => $this->price,
            'quantity'     => $this->quantity,
            'description'  => $this->description,
            'images'       => $uploadedImagePaths,
            'status'       => $this->status,
        ]);

        $this->resetForm();
        $this->dispatch(
            'data-added',
            title: 'Success',
            message: 'Product Created successfully.',
            redirectUrl: route('products.list')
        );
    }

    public function resetForm()
    {
        $this->product_name = '';
        $this->price = 0;
        $this->description = '';
        $this->images = [];
    }


    public function render()
    {
        try {
            return view('livewire.add-product');
        } catch (\Throwable $e) {
            $this->dispatch(
                'data-error',
                title: 'Error',
                message: $e->getMessage()
            );
        }
    }
}
