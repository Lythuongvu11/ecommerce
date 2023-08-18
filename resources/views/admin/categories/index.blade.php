@extends('admin.dashboard.index')
@section('title','Category')
@section('content')
    <div class="card">
        @if (session('message'))
            <h1 class="text-primary">{{ session('message') }}</h1>
        @endif
        <h1>
            Category list
        </h1>
        <div>
            <a href="{{route('categories.create')}}" class="btn btn-link">Create</a>
        </div>
        <div>
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
{{--                    <th>Parent ID</th>--}}
                    <th>Action</th>
                </tr>
                @foreach($categories as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
{{--                        <td>{{$item->parent_id}}</td>--}}
                        <td>
                            <a href="{{route('categories.edit', $item->id)}}" class="btn btn-warning">Edit</a>
                            <form id="form-delete{{$item->id}}" action="{{ route('categories.destroy', $item->id) }}"
                                  method="post">
                                @csrf
                                @method('delete')

                            </form>
                            <button class="btn btn-delete btn-danger" data-id={{ $item->id }}>Delete</button>


                        </td>
                    </tr>
                @endforeach
            </table>
            {{$categories->links()}}
        </div>

    </div>
@endsection
@section('script')
@endsection
