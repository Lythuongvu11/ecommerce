@extends('admin.layouts.app')
@section('title', 'Create Product')
@section('content')
    <div class="card">
        <h1>Create Product</h1>

        <div>
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="input-group input-group-static mb-4">
                    <label>Image</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                    @error('name')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" >
                    @error('email')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control" ></textarea>
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="category_id">Category ID:</label>
                    <input type="number" name="category_id" id="category_id" class="form-control" >
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="size">Size:</label>
                    <input type="text" name="size" id="size" class="form-control" >
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="color">Color:</label>
                    <input type="text" name="color" id="color" class="form-control" >
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="price">Price:</label>
                    <input type="number" name="price" id="price" class="form-control" >
                </div>
                <div class="input-group input-group-static mb-4">
                    <label for="old_price">Old Price:</label>
                    <input type="number" name="old_price" id="old_price" class="form-control" >
                </div>

                <button type="submit" class="btn btn-submit btn-primary">Create</button>
            </form>

        </div>
    </div>
@endsection


