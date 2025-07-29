<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order as OrderModel;
use Livewire\Attributes\{Layout, Title};

#[Layout('admin.layouts.app')]
#[Title('Orders List')]
class Order extends Component
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
        $orders = OrderModel::with(['customer', 'items.product.images'])
            ->when($this->search, function ($query) {
                $query->whereHas('customer', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('mobile', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.order', ['orders' => $orders]);
    }

    public function delete($id)
    {

        try {
            $orders = OrderModel::find($id);
            if (! $orders) {
                $this->dispatch(
                    'data-error',
                    title: 'Error',
                    message: 'Order not found.'
                );
            }
            $orders->delete();

            $this->dispatch(
                'data-deleted',
                title: 'Success',
                message: 'Order Deleted successfully.',
                redirectUrl: route('order.list')
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
