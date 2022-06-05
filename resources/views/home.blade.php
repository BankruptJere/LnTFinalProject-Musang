@extends('layouts.app')

@section('title', 'Dashboard | PT. Musang')

@section('content')
@include('carts.create')
<br>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Hello, {{ Auth::user()->username }}</h1>
    <p class="lead">You are currently logged in as a {{ Auth::user()->role }}</p>
  </div>
</div>


@if (session('success_msg'))
                <div class="alert alert-success mb-3">{{ session('success_msg') }}</div>
@endif


<div class="container mt-5">
        <div class="row">
            @foreach ($items as $item)
                <div class="col-md-3">
                    <div class="col-md-12 bg-light rounded p-3 shadow-sm">
                        <h6 class="text-muted">{{ $item->category->title }}</h6>
                        <h3>{{ $item->item_name }}</h3>
                        <img src="{{ asset('storage/items/' . $item->thumbnail) }}" class="w-100">
                        <h5>Rp. {{ $item->item_price }}</h5>
                        <h5>Supplies Left : {{ $item->item_amount }}</h5>

                        <button class="btn btn-sm btn-primary my-3" 
                        data-bs-toggle="modal" data-bs-target="#createCartModal">
                        Add To Cart
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
