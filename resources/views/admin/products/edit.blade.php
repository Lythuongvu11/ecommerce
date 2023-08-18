@extends('admin.layouts.app')
@section('title', 'Edit User',$user->name)
@section('content')
    <div class="card">
        <h1>Edit User</h1>

        <div>
            <form action="{{ route('users.update',$user->id )}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-group input-group-static mb-4">
                    <label>Name</label>
                    <input type="text" value="{{ old('name') ?? $user->name }}" name="name" class="form-control">
                    @error('name')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Email</label>
                    <input type="text" value="{{ old('email') ?? $user->email }}" name="email" class="form-control">
                    @error('email')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Phone</label>
                    <input type="text" value="{{ old('phone') ?? $user->phone }}" name="phone" class="form-control">
                    @error('phone')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group input-group-static mb-4">
                    <label name="group" class="ms-0">Gender</label>
                    <select name="gender" class="form-control" value="{{$user->gender}}">
                        <option value="male">Male</option>
                        <option value="fe-male">FeMale</option>

                    </select>

                    @error('gender')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label>Address</label>
                    <textarea name="address" class="form-control">{{ old('address')?? $user->address }} </textarea>
                    @error('address')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>


                <div class="input-group input-group-static mb-4">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Roles</label>
                    <div class="row">
                        @foreach ($roles as $groupName => $role)
                            <div class="col-5">
                                <h4>{{ $groupName }}</h4>

                                <div>
                                    @foreach ($role as $item)
                                        <div class="form-check">
                                            <input class="form-check-input" name="role_ids[]" type="checkbox"
                                                   {{ $user->roles->contains('id', $item->id) ? 'checked' : '' }}
                                                   type="checkbox" value="{{ $item->id }}">
                                            <label
                                                for="customCheck1">{{ $item->display_name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-submit btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
