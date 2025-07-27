<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\{
    Title,
    Layout,
};
use App\Models\{
    Product,
    Cart,
    Customer
};

#[Layout('admin.layouts.app')]
#[Title('Dashboard Page')]
class Dashboard extends Component
{
    public function render()
    {
        $data = [
            'total_product' => Product::count(),
            'total_cart' => Cart::count(),
            'total_customers' => Customer::count(),
        ];
        return view('livewire.dashboard', $data);
    }
}
