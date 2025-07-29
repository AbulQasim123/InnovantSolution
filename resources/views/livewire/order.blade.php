<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
            <h5 class="mb-0">Orders List</h5>
        </div>

        <div class="card-body">
            <x-filter-search placeholder="Search By Customer Name / Email / Mobile" />

            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start">Sr. No.</th>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Items</th>
                            <th>Images</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Transaction ID</th>
                            <th>Payment Method</th>
                            <th>Created At</th>
                        </tr>
                    </thead>

                    <tbody class="table-border-bottom-0">
                        @forelse($orders as $index => $order)
                            <tr wire:key="{{ $order->id }}">
                                <td class="text-start">{{ $orders->firstItem() + $index }}.</td>

                                <td>{{ $order->order_number ?? '-' }}</td>
                                <td>{{ $order->customer?->name ?? '-' }}</td>
                                <td>{{ $order->customer?->email ?? '-' }}</td>
                                <td>{{ $order->customer?->mobile ?? '-' }}</td>
                                <td>{{ $order->customer?->address ?? '-' }}</td>

                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($order->items as $item)
                                            <li>{{ $item->product->name ?? '-' }} (x{{ $item->quantity }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach ($order->items as $item)
                                            @if ($item->product->images->isNotEmpty())
                                                <img src="{{ $item->product->images->first()->images }}"
                                                    alt="Image" width="40" height="40" class="rounded">
                                            @endif
                                        @endforeach
                                    </div>
                                </td>

                                <td>₹{{ $order->total_amount }}</td>
                                <td>
                                    <span
                                        class="badge bg-label-{{ $order->status === 'paid' ? 'success' : 'warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->razorpay_order_id ?? '-' }}</td>
                                <td>{{ ucfirst($order->payment_method ?? 'N/A') }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center text-muted fw-semibold">
                                    <i class="bx bx-info-circle me-1"></i> No Orders Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries
                </div>
                <div>
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
