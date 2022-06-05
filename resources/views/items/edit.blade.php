@extends('layouts.app')

@section('title', 'Edit Item | PT. Musang')

@section('content')
    {{-- EDIT ITEM --}}
    <div class="container mt-3">
        <div class="col-md-7 bg-light p-4 rounded">
            <h4>Edit Item</h4>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia cumque repudiandae, optio aliquam ipsa alias
            </p>
            <hr>

            <form action="{{ route('updateItem', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Photo Item</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                        placeholder="Photo Item..." name="thumbnail" value="{{ old('thumbnail') ? old('thumbnail') : $item->thumbnail }}">
                    @error('thumbnail')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nama Item</label>
                    <input type="text" class="form-control @error('item_name') is-invalid @enderror" placeholder="Name Item..."
                        name="item_name" value="{{ old('item_name') ? old('item_name') : $item->item_name }}">
                    @error('item_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                        <label>Harga Item</label>
                        <input type="number" class="form-control @error('item_price') is-invalid @enderror"
                            placeholder="0" name="item_price" value="{{ old('item_price') ? old('item_price') : $item->item_price }}">
                        @error('item_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Jumlah Item</label>
                        <input type="number" class="form-control @error('item_amount') is-invalid @enderror"
                            placeholder="0" name="item_amount" value="{{ old('item_amount') ? old('item_amount') : $item->item_amount }}">
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
@endsection
