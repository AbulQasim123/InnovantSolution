<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer as CustomerModel;
use Livewire\Attributes\{Layout, Title};

#[Layout('admin.layouts.app')]
#[Title('Product List')]

class Customer extends Component
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
        $customers = CustomerModel::when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('mobile', 'like', "%{$this->search}%");
            });
        })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.customer', ['customers' => $customers]);
    }

    public function delete($id)
    {

        try {
            $customer = CustomerModel::find($id);
            if (! $customer) {
                $this->dispatch(
                    'data-error',
                    title: 'Error',
                    message: 'Customer not found.'
                );
            }
            $customer->delete();

            $this->dispatch(
                'data-deleted',
                title: 'Success',
                message: 'Product Deleted successfully.',
                redirectUrl: route('customer.list')
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
