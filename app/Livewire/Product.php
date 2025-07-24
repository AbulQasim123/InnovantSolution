<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ProductService;
use App\Models\Product as ProductModel;
use Livewire\Attributes\{Layout, Title};
#[Layout('admin.layouts.app')]
#[Title('Product List')]

class Product extends Component
{
    use WithPagination;
    protected $listeners = ['deleteMake' => 'delete'];
    public $search = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10]
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = ProductModel::with('images')
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.product', ['products' => $products]);
    }

    public function delete($id)
    {
        $productService = app(ProductService::class);
        try {
            $productService->deleteProduct($id);
            $this->dispatch(
                'data-deleted',
                title: 'Success',
                message: 'Product Deleted successfully.',
                redirectUrl: route('products.list')
            );
        } catch (\Exception $e) {
            $this->dispatch(
                'data-error',
                title: 'Error',
                message: $e->getMessage()
            );
        }
    }
}
