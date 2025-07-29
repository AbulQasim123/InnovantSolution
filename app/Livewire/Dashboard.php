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
    Customer,
    Order
};

#[Layout('admin.layouts.app')]
#[Title('Dashboard Page')]
class Dashboard extends Component
{
    public function render()
    {
        $orderStats = Order::selectRaw('COUNT(*) as total_orders, SUM(total_amount) as total_revenue')->first();
        $orderStatusBreakdown = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('livewire.dashboard', [
            'total_product' => Product::count(),
            'total_cart' => Cart::count(),
            'total_customers' => Customer::count(),
            'total_orders' => $orderStats->total_orders ?? 0,
            'total_revenue' => $orderStats->total_revenue ?? 0,
            'status_breakdown' => $orderStatusBreakdown,
        ]);
    }
}
