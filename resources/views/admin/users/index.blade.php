@extends('admin.dashboard.index')
@section('title','Users')
@section('content')
    <div class="card">
        @if (session('message'))
            <h1 class="text-primary">{{ session('message') }}</h1>
        @endif
        <h1>
            User list
        </h1>
        <div>
            <a href="{{route('users.create')}}" class="btn btn-link">Create</a>
        </div>
        <div>
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                @foreach($users as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>
                            <a href="{{route('users.edit', $item->id)}}" class="btn btn-warning">Edit</a>
                            <form id="form-delete{{$item->id}}" action="{{ route('users.destroy', $item->id) }}"
                                  method="post">
                                @csrf
                                @method('delete')

                            </form>
                            <button type="submit" class="btn btn-delete btn-danger" data-id={{ $item->id }}>Delete</button>



                        </td>
                    </tr>
                @endforeach
            </table>
            {{$users->links()}}
        </div>

    </div>
@endsection
@section('script')
@endsection
