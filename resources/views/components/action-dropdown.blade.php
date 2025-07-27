<div class="dropdown" wire:ignore>
    <button class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="bx bx-dots-vertical-rounded"></i>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route($editRoute, ['id' => $editId]) }}" wire:navigate>
            <i class="bx bx-edit-alt me-1"></i> Edit
        </a>
        <a class="dropdown-item" href="javascript:void(0);"
            onclick="if(confirm('{{ $confirmMessage }}')) { @this.call('{{ $deleteMethod }}', {{ $editId }}) }">
            <i class="bx bx-trash me-1"></i> Delete
        </a>
    </div>
</div>
