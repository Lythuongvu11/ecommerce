@extends('admin.layouts.app')
@section('title','Product')
@section('content')
    <div class="card">
        @if (session('message'))
            <h1 class="text-primary">{{ session('message') }}</h1>
        @endif
        <h1>
            Product list
        </h1>
            <form action="{{ route('products.index') }}" method="GET">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search products">
                <button type="submit">Search</button>
            </form>
        <div>
            <a href="{{route('products.create')}}" class="btn btn-link">Create</a>
        </div>
        <div>
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>OldPrice</th>
                    <th>Action</th>
                </tr>
                @foreach($products as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td><img src="{{ asset('storage/' . $item->image) }}" width="200px" height="200px" alt="Product Image"></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->size}}</td>
                        <td>{{$item->color}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->old_price}}</td>
                        <td>
                            <a href="{{route('products.edit', $item->id)}}" class="btn btn-warning">Edit</a>
                            <form id="form-delete{{$item->id}}" action="{{ route('products.destroy', $item->id) }}"
                                  method="post">
                                @csrf
                                @method('delete')

                            </form>
                            <button type="submit" class="btn btn-delete btn-danger" data-id={{ $item->id }}>Delete</button>



                        </td>
                    </tr>
                @endforeach
            </table>
            <form action="/products" method="GET">
                <select name="per_page" id="per_page_select" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" selected {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>
            {{$products->links()}}
        </div>

    </div>
@endsection
@section('script')
@endsection
