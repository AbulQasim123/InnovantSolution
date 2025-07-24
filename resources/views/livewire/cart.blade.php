<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h5 class="mb-0">
                <i class="fas fa-shopping-cart me-2"></i>Cart List
            </h5>
        </div>

        <x-filter-search placeholder="Search Product Name"/>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-start">Sr. No.</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Images</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($carts as $index => $cart)
                        <tr wire:key="{{ $cart->id }}">
                            <td class="text-start">{{ $carts->firstItem() + $index }}.</td>
                            <td>{{ $cart->product->name ?? 'N/A' }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{ $cart->product->price ?? '0.00' }}</td>
                            <td>{{ number_format(($cart->product->price ?? 0) * $cart->quantity, 2) }}</td>
                            <td class="d-flex flex-wrap gap-1">
                                @forelse($cart->product->images as $img)
                                    <img src="{{ $img->images }}" alt="Product Image" width="40" height="40"
                                        class="rounded border">
                                @empty
                                    <span class="text-muted">No image</span>
                                @endforelse
                            </td>
                        </tr>
                    @empty
                        <td colspan="6" class="text-center text-muted fw-semibold">
                            <i class="bx bx-info-circle me-1"></i> No Cart item found
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-between align-items-center flex-wrap">
            <div>
                Showing {{ $carts->firstItem() }} to {{ $carts->lastItem() }} of {{ $carts->total() }} entries
            </div>
            <div>
                {{ $carts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
