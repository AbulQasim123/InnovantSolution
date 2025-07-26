<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4">
        <!-- Customers Total -->
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

        <!-- Products Total -->
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

        <!-- Carts Total -->
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
    </div>
</div>
