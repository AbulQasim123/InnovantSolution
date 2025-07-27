<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <hr class="my-0" />
                <div class="card-body">
                    <form wire:submit.prevent="updateProfile">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" wire:model.live="name" placeholder="John" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">E-mail</label>
                                <input class="form-control" type="email" wire:model.live="email"
                                    placeholder="john@example.com" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" wire:model.live="password"
                                    placeholder="********" />
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="{{ config('ui.button.primary') }}" wire:loading.attr="disabled"
                                wire:target="updateProfile">
                                <span wire:loading.remove wire:target="updateProfile">Save changes</span>
                                <span wire:loading wire:target="updateProfile">
                                    <span class="spinner-border spinner-border-sm" role="status"></span>
                                    Saving...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
