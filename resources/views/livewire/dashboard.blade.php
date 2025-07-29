<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('customer.list') }}" wire:navigate class="text-decoration-none text-dark">
                <div class="card text-center shadow-sm hover-card">
                    <div class="card-body">
                        <h6 class="card-title text-bold">Customers</h6>
                        <h3 class="fw-bold">{{ $total_customers }}</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('products.list') }}" wire:navigate class="text-decoration-none text-dark">
                <div class="card text-center shadow-sm hover-card">
                    <div class="card-body">
                        <h6 class="card-title text-bold">Products</h6>
                        <h3 class="fw-bold">{{ $total_product }}</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('cart.list') }}" wire:navigate class="text-decoration-none text-dark">
                <div class="card text-center shadow-sm hover-card">
                    <div class="card-body">
                        <h6 class="card-title text-bold">Carts</h6>
                        <h3 class="fw-bold">{{ $total_cart }}</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('order.list') }}" wire:navigate class="text-decoration-none text-dark">
                <div class="card text-center shadow-sm hover-card">
                    <div class="card-body">
                        <h6 class="card-title text-bold">Total Orders</h6>
                        <h3 class="fw-bold">{{ $total_orders }}</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm hover-card">
                <div class="card-body">
                    <h6 class="card-title text-bold">Total Revenue</h6>
                    <h3 class="fw-bold">₹{{ number_format($total_revenue, 2) }}</h3>
                </div>
            </div>
        </div>

        @foreach ($status_breakdown as $status => $count)
            <div class="col-md-4">
                <div class="card text-center shadow-sm hover-card">
                    <div class="card-body">
                        <h6 class="card-title text-bold text-capitalize">{{ ucfirst($status) }} Orders</h6>
                        <h3 class="fw-bold">{{ $count }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
