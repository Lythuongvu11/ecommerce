@extends('admin.layouts.app')
@section('title', 'Edit Category',$category->name)
@section('content')
    <div class="card">
        <h1>Edit Category</h1>

        <div>
            <form action="{{ route('categories.update',$category->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="input-group input-group-static mb-4">
                    <label>Name</label>
                    <input type="text" value="{{ old('name') ?? $category->name}}" name="name" class="form-control">
                    @error('name')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-submit btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('script')

    <script></script>
@endsection


