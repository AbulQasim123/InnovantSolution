<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h5 class="mb-0">
                <i class="fas fa-database me-2"></i>Product List
            </h5>
            <a class="{{ config('ui.button.normal') }}" href="{{ route('add.product') }}" wire:navigate>+ Add</a>
        </div>

        <x-filter-search placeholder="Search Product Name" />

        <div class="table-responsive text-nowrap">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-start">Sr. No.</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Images</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($products as $index => $product)
                        <tr wire:key="{{ $product->id }}">
                            <td class="text-start">{{ $products->firstItem() + $index }}.</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td class="d-flex flex-wrap gap-1">
                                @forelse($product->images as $img)
                                <img src="{{ $img->images }}" alt="Product Image" width="40"
                                height="40" class="rounded border">
                                @empty
                                <span class="text-muted">No image</span>
                                @endforelse
                            </td>
                            <td>{{ Str::limit($product->description, 25) }}</td>
                            <td>
                                <span class="badge bg-label-{{ $product->status ? 'success' : 'danger' }}">
                                    {{ $product->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <x-action-dropdown :edit-route="'edit.product'" :edit-id="$product->id" delete-method="delete"
                                    confirm-message="Are you sure you want to delete this Product?" />
                            </td>
                        </tr>
                    @empty
                        <td colspan="7" class="text-center text-muted fw-semibold">
                            <i class="bx bx-info-circle me-1"></i> No Product found
                        </td>
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
