<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4">
        <!-- Agents -->
        <div class="col-md-4">
            <a href="javascript:void()" wire:navigate class="text-decoration-none text-dark">
                <div class="card text-center shadow-sm hover-card">
                    <div class="card-body">
                        <h6 class="card-title text-bold">Agents</h6>
                        {{-- <h3 class="fw-bold">{{ $total_agent }}</h3> --}}
                    </div>
                </div>
            </a>
        </div>

        <!-- Owner Clients -->
        <div class="col-md-4">
            <a href="javascript:void()" wire:navigate class="text-decoration-none text-dark">
                <div class="card text-center shadow-sm hover-card">
                    <div class="card-body">
                        <h6 class="card-title text-bold">Owners</h6>
                        {{-- <h3 class="fw-bold">{{ $total_owner_clients }}</h3> --}}
                    </div>
                </div>
            </a>
        </div>

        <!-- Tenant Clients -->
        <div class="col-md-4">
            <a href="javascript:void()" wire:navigate class="text-decoration-none text-dark">
                <div class="card text-center shadow-sm hover-card">
                    <div class="card-body">
                        <h6 class="card-title text-bold">Tenants</h6>
                        {{-- <h3 class="fw-bold">{{ $total_tenant_clients }}</h3> --}}
                    </div>
                </div>
            </a>
        </div>

        <!-- Associates -->
        <div class="col-md-4">
            <a href="javascript:void()" wire:navigate class="text-decoration-none text-dark">
                <div class="card text-center shadow-sm hover-card">
                    <div class="card-body">
                        <h6 class="card-title text-bold">Associates</h6>
                        {{-- <h3 class="fw-bold">{{ $total_associate }}</h3> --}}
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
