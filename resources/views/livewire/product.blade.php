<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h5 class="mb-0">Product List</h5>
            <a class="{{ config('ui.button.normal') }}" href="{{ route('add.product') }}" wire:navigate><i
                    class="bx bx-plus me-1"></i> Add</a>
        </div>

        <div class="card-body">
            <x-filter-search placeholder="Search Product Name" />

            <div class="table-responsive text-nowrap mt-3">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start">Sr. No.</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Images</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($products as $index => $product)
                            <tr wire:key="{{ $product->id }}">
                                <td class="text-start">{{ $products->firstItem() + $index }}.</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->quantity ?? 0 }}</td>
                                <td class="d-flex flex-wrap gap-1">
                                    @forelse($product->images as $img)
                                        <img src="{{ $img->images }}" alt="Product Image" width="30" height="30"
                                            class="rounded border" />
                                    @empty
                                        <span class="text-muted">No image</span>
                                    @endforelse
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($product->description, 25) }}</td>
                                <td>
                                    <span class="badge bg-label-{{ $product->status ? 'success' : 'danger' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}</td>
                                <td>
                                    <x-action-dropdown :edit-route="'edit.product'" :edit-id="$product->id" delete-method="delete"
                                        confirm-message="Are you sure you want to delete this Product?" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted fw-semibold">
                                    <i class="bx bx-info-circle me-1"></i> No Product found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
                    entries
                </div>
                <div>
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
