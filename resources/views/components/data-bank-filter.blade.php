<div class="px-3 mt-3">
    <div wire:loading.delay.5000ms wire:loading.class="d-flex" wire:loading.class.remove="d-none"
        wire:target="perPage,search,type" class="overlay-spinner d-none justify-content-center align-items-center">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3 mt-2 mt-md-0">
            <select wire:model.live="type" class="form-select">
                <option value="bike">Two-Wheeler</option>
                {{-- <option value="private">Private</option> --}}
                {{-- <option value="tourist">Tourist</option> --}}
                <option value="commercial">Commercial</option>
            </select>
        </div>

        <div class="col-md-3 mt-2 mt-md-0">
            <select wire:model.live="perPage" class="form-select">
                <option value="5">5 per page</option>
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
                <option value="50">50 per page</option>
            </select>
        </div>
        {{--
        <div class="col-md-3 mt-2 mt-md-0">
            <input type="text" wire:model.live.debounce.500ms="search" class="form-control" placeholder="Search">
        </div> --}}
    </div>
</div>

<style>
    .overlay-spinner {
        position: absolute;
        top: 0;
        transition: opacity 5ms ease;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.6);
        z-index: 10;
        display: flex;
    }
</style>
