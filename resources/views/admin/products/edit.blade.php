@extends('admin.layouts.app')
@section('title', 'Edit Product')
@section('content')
    <div class="card">
        <h1>Edit Product</h1>

        <div>
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="input-group input-group-static mb-4">
                    <label>Image</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="category_id">Category ID:</label>
                    <input type="number" name="category_id" id="category_id" class="form-control" value="{{ $product->category_id }}">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="size">Size:</label>
                    <input type="text" name="size" id="size" class="form-control" value="{{ $product->size }}">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="color">Color:</label>
                    <input type="text" name="color" id="color" class="form-control" value="{{ $product->color }}">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="price">Price:</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="old_price">Old Price:</label>
                    <input type="number" name="old_price" id="old_price" class="form-control" value="{{ $product->old_price }}">
                </div>

                <button type="submit" class="btn btn-submit btn-primary">Update</button>
            </form>

            <div class="input-group input-group-static mb-4">
                <label>Current Image</label>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Product Image" width="200px" height="200px">
                @else
                    <p>No image uploaded yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
