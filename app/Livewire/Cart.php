<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cart as CartModel;
use Livewire\Attributes\{Layout, Title};

#[Layout('admin.layouts.app')]
#[Title('Cart List')]

class Cart extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 10;
    protected $listeners = ['deleteMake' => 'delete'];
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
        $carts = CartModel::with(['product.images'])
            ->when($this->search, function ($query) {
                $query->whereHas('product', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.cart', ['carts' => $carts]);
    }

    public function delete($id)
    {
        try {
            $cart = CartModel::find($id);
            if ($cart) {
                $cart->delete();
                $this->dispatch(
                    'data-deleted',
                    title: 'Success',
                    message: 'Product Deleted successfully.',
                    redirectUrl: route('cart.list')
                );
            } else {
                session()->flash('error', 'Cart item not found.');
            }
        } catch (\Throwable $th) {
            $this->dispatch(
                'data-error',
                title: 'Error',
                message: $th->getMessage()
            );
        }
    }
}
