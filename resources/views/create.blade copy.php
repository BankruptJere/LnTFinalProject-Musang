<div class="modal fade" id="createCartModal" tabindex="-1" aria-labelledby="createCartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCartModalLabel"><i class="uil uil-plus me-1"></i>Buat Item
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{ route('storeCart') }" method="POST" enctype="multipart/form-data">
            @csrf
                    <div class="form-group">
                        <label>Name Item</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Nama Item..." name="name" value="{{ old('name') ? old('name') : $item->item_name }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                            placeholder="0" name="quantity" value="{{ old('quantity') }}">
                        @error('quantity')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Harga Item</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                            placeholder="0" name="price" value="{{ old('price') ? old('price') : $item->item_price }}">
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="alamat..." name="name" value="{{ old('alamat') }}">
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" class="form-control @error('kodepos') is-invalid @enderror"
                            placeholder="00000" name="kodepos" value="{{ old('kodepos') }}">
                        @error('kodepos')
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
