<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Add Product</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="storeProduct">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                    wire:model.live="product_name" placeholder="Enter Product Name">
                                @error('product_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    wire:model.live="price" placeholder="Enter Price">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                    wire:model.live="quantity" placeholder="Enter Quantity">
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Images</label>
                                <input type="file" multiple
                                    class="form-control @error('images') is-invalid @enderror" wire:model="images"
                                    accept="image/*">
                                @error('images')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-medium" for="status">Status</label>
                                <select id="status" class="form-select @error('status') is-invalid @enderror"
                                    wire:model.live="status">
                                    <option value="" disabled selected>-- Select Status --</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Enter Description" wire:model.live="description"></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="{{ config('ui.button.primary') }}" wire:loading.attr="disabled"
                            wire:target="storeProduct">
                            <span wire:loading.remove wire:target="storeProduct">Save</span>
                            <span wire:loading wire:target="storeProduct">
                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                Saving...
                            </span>
                        </button>
                        <a href="{{ route('products.list') }}" class="{{ config('ui.button.secondary') }}"
                            wire:navigate>Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
