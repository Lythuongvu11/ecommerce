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
            <form id="delete-selected-form" action="{{ route('products.delete-selected') }}" method="POST">
                @csrf
                <button type="submit" id="delete-selected" class="btn btn-delete-selected btn-danger">Delete Selected</button>
            </form>

        </div>

        <div>
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category ID</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>OldPrice</th>
                    <th>Action</th>
                </tr>
                @foreach($products as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td><input type="checkbox" class="select-checkbox" value="{{ $item->id }}"></td>
                        <td><a href="{{ route('products.show', $item->id) }}"><img src="{{ asset('storage/' . $item->image) }}" width="200px" height="200px" alt="Product Image"></a></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->category_id}}</td>
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
                    <option value="50" {{ !request()->has('per_page') || request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>
            {{$products->links()}}
        </div>


    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#delete-selected').on('click', function() {
            let selectedProducts = [];

            $('.select-checkbox:checked').each(function() {
                selectedProducts.push($(this).val());
            });

            if (selectedProducts.length === 0) {
                alert('Vui lòng chọn ít nhất 1 sản phẩm');
                return;
            }

            if (confirm('Bạn có chắc chắn sẽ xoá sản phẩm này chứ?')) {
                $.ajax({
                    url: "{{ route('products.delete-selected') }}",
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "products": selectedProducts
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(err) {
                        alert('Có lỗi khi xoá. Vui lòng thử lại');
                    }
                });
            }
        });
    </script>



@endsection

