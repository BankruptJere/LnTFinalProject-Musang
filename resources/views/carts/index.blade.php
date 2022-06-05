@extends('layouts.app')

@section('title', 'Show Cart| PT. Musang')

@section('content')

    {{-- MANAGE Cart --}}
    <div class="container mt-3">
        <div class="col-md-7 bg-light p-4 rounded">
            <h4>Manage Cart</h4>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia cumque repudiandae, optio aliquam ipsa alias
            </p>
            <hr>

            @if (session('success_msg'))
                <div class="alert alert-success mb-3">{{ session('success_msg') }}</div>
            @endif


            @if ($carts->count() != 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name Item</th>
                            <th>Quantity</th>
                            <th>Harga Item</th>
                            <th>Alamat</th>
                            <th>Kode Pos</th>
                            <th>Harga Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <span class="d-block">{{ $cart->name }}</span>
                                    <span class="badge bg-primary">{{ $cart->category->title }}</span>
                                </td>
                                <td>{{ $cart->quantity }} </td>
                                <td>Rp.{{ $cart->price }}</td>
                                <td>{{ $cart->alamat }}</td>
                                <td>{{ $cart->kodepos }}</td>
                                <td>Rp.{{ $cart->quantity * $cart->price}}</td>
                                <td>
                                    <!-- @if (Auth::user()->role == 'Admin')
                                        <a href="{{ route('editItem', $item->id) }}" class="text-primary"><i
                                                class="uil uil-edit"></i></a>
                                    @endif -->

                                    <a href="" class="text-danger"
                                        onclick="event.preventDefault(); document.getElementById('delete-form').submit()">
                                        <i class="uil uil-trash-alt"></i>
                                        <form id="delete-form" action="{{ route('deleteCart', $cart->id) }}"
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

                <h5>Total : Rp.{{ $cart->quantity * $cart->price}}</h5>
                
                @else
                <div class="alert alert-warning">Cartnya masih kosong</div>
            @endif
        </div>
    </div>
@endsection
