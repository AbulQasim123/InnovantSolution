<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ProductService;
use App\Http\Requests\UpdateProductRequest;
use Livewire\WithFileUploads;
use App\Helpers\ImageHelper;
use Livewire\Attributes\{Title, Layout};

#[Layout('admin.layouts.app')]
#[Title('Edit Product')]
class EditProduct extends Component
{
    use WithFileUploads;

    public $product_id;
    public $product_name;
    public $description;
    public $price;
    public $status;
    public $images = [];
    public $existingImages = [];

    public function mount($id)
    {
        $productService = app(ProductService::class);
        $product = $productService->findProduct($id);

        $this->product_id = $product->id;
        $this->product_name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->status = $product->status;
        $this->existingImages = $product->images->pluck('images')->toArray();
    }

    protected function rules()
    {
        return (new UpdateProductRequest())->rules();
    }

    protected function messages()
    {
        return (new UpdateProductRequest())->messages();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateProduct()
    {
        $this->validate();

        $uploadedImagePaths = [];
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $uploadedImagePaths[] = ImageHelper::handleUploadedImage($image, 'uploads/products_images');
            }
        }

        $productService = app(ProductService::class);

        $productService->updateProduct($this->product_id, [
            'product_name' => $this->product_name,
            'price'        => $this->price,
            'description'  => $this->description,
            'images'       => $uploadedImagePaths,
            'status'       => $this->status
        ]);

        $this->dispatch(
            'data-updated',
            title: 'Updated',
            message: 'Product updated successfully.',
            redirectUrl: route('products.list')
        );
    }

    public function render()
    {
        return view('livewire.edit-product');
    }
}
