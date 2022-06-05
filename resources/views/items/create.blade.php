<div class="modal fade" id="createItemModal" tabindex="-1" aria-labelledby="createItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createItemModalLabel"><i class="uil uil-plus me-1"></i>Buat Item
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeItem') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Photo Item</label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                            placeholder="Photo Item..." name="thumbnail" value="{{ old('thumbnail') }}">
                        @error('thumbnail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Name Item</label>
                        <input type="text" class="form-control @error('item_name') is-invalid @enderror"
                            placeholder="Nama Item..." name="item_name" value="{{ old('item_name') }}">
                        @error('item_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Harga Item</label>
                        <input type="number" class="form-control @error('item_price') is-invalid @enderror"
                            placeholder="0" name="item_price" value="{{ old('item_price') }}">
                        @error('item_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Jumlah Item</label>
                        <input type="number" class="form-control @error('item_amount') is-invalid @enderror"
                            placeholder="0" name="item_amount" value="{{ old('item_amount') }}">
                        @error('item_amount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Kategori Item</label>
                        <select class="form-control @error('category') is-invalid @enderror" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
