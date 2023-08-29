@extends('admin.layouts.app')

@section('title', 'Product Details')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Product Details</h1>
        </div>
        <div class="card-body">
            <h2>{{ $product->name }}</h2>
            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="200px" height="200px">
            <p>Description: {{ $product->description }}</p>
            <p>Category ID: {{ $product->category_id }}</p>
            <p>Size: {{ $product->size }}</p>
            <p>Color: {{ $product->color }}</p>
            <p>Price: {{ $product->price }}</p>
            <p>Old Price: {{ $product->old_price }}</p>

            <div>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                <form id="form-delete{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="post">
                    @csrf
                    @method('delete')
                </form>
                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $product->id }}">Delete</button>
            </div>
        </div>
    </div>
@endsection
