<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
            <h5 class="mb-0">Customer List</h5>
        </div>

        <div class="card-body">
            <x-filter-search placeholder="Search By Name Or Email Or Phone" />

            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start">Sr. No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Created At</th>
                            <th>Others</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($customers as $index => $customer)
                            <tr wire:key="{{ $customer->id }}">
                                <td class="text-start">{{ $customers->firstItem() + $index }}.</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address }}</td>
                                {{-- <td>{{ Carbon\Carbon::parse($customer->created_at)->diffForHumans() }}</td> --}}
                                <td>{{ Carbon\Carbon::parse($customer->created_at)->format('M d, Y') }}</td>
                                <td>(Others)</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted fw-semibold">
                                    <i class="bx bx-info-circle me-1"></i> No Customer found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }}
                    entries
                </div>
                <div>
                    {{ $customers->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
