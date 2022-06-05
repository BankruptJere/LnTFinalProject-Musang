@extends('layouts.app')

@section('title', 'Manage Item | PT. Musang')

@section('content')
    {{-- MODAL CREATE --}}
    @include('items.create')

    {{-- MANAGE ITEM --}}
    <div class="container mt-3">
        <div class="col-md-7 bg-light p-4 rounded">
            <h4>Manage Item</h4>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia cumque repudiandae, optio aliquam ipsa alias
            </p>
            <hr>

            @if (Auth::user()->role == 'Admin')
                <button class="btn btn-sm btn-dark my-3" data-bs-toggle="modal" data-bs-target="#createItemModal">
                    <i class="uil uil-plus me-1"></i>Buat Item
                </button>
            @endif

            @if (session('success_msg'))
                <div class="alert alert-success mb-3">{{ session('success_msg') }}</div>
            @endif

            @if ($items->count() != 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Name Item</th>
                            <th>Harga Item</th>
                            <th>Jumlah Item</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <img src="{{ asset('storage/items/' . $item->thumbnail) }}" width="100">
                                </td>
                                <td>
                                    <span class="d-block">{{ $item->item_name }}</span>
                                    <span class="badge bg-primary">{{ $item->category->title }}</span>
                                </td>
                                <td>{{ $item->item_price }}</td>
                                <td>{{ $item->item_amount }}</td>
                                <td>
                                    @if (Auth::user()->role == 'Admin')
                                        <a href="{{ route('editItem', $item->id) }}" class="text-primary"><i
                                                class="uil uil-edit"></i></a>
                                    @endif

                                    <a href="" class="text-danger"
                                        onclick="event.preventDefault(); document.getElementById('delete-form').submit()">
                                        <i class="uil uil-trash-alt"></i>
                                        <form id="delete-form" action="{{ route('deleteItem', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning">Itemnya masih kosong</div>
            @endif
        </div>
    </div>
@endsection
