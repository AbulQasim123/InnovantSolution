@props([
    'placeholder' => 'Search...',
])
<div class="">
    <div wire:loading.delay.2000ms wire:loading.class="d-flex" wire:loading.class.remove="d-none"
        wire:target="perPage,search" class="overlay-spinner d-none justify-content-center align-items-center">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-3 mt-2 mt-md-0">
            <select wire:model.live="perPage" class="form-select">
                <option value="5">5 per page</option>
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
                <option value="50">50 per page</option>
            </select>
        </div>

        <div class="col-md-3 mt-2 mt-md-0">
            <input type="text" wire:model.live.debounce.500ms="search" class="form-control"
                placeholder="{{ $placeholder }}">
        </div>
    </div>
</div>
<style>
    .overlay-spinner {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.6);
        z-index: 10;
        display: flex;
    }
</style>
