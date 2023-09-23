<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user;
    protected $role;
    public function __construct(User $user, Role $role)
    {
        $this->user=$user;
        $this->role=$role;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=$this->user->latest('id')->paginate(5);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->role->all()->groupBy('group');
        return view('admin.users.create', compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $dataCreate=$request->all();
        $dataCreate['password']= Hash::make($request->password);
        $user = $this->user->create($dataCreate);
        return response()->json(['message' => 'Create success']);
//        return redirect()->route('users.index')->with(['message'=>'Create success']);

    }

    /**
     * Display the specified resource.
     */
    public function showdata()
    {
        $users = User::get();

        return $users;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=$this->user->findOrFail($id)->load('roles');
        $roles = $this->role->all()->groupBy('group');
        return response()->json([
            'user'=>$user,
            'roles'=>$roles
        ]);

//        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $dataUpdate=$request->except('password');
        $user=$this->user->findOrFail($id)->load('roles');
        if ($request->password)
        {
            $dataUpdate['password']=Hash::make($request->password);
        }
        $user ->update($dataUpdate);
        $user->roles()->sync($dataUpdate['role_ids']??[]);

//        return to_route('users.index')->with(['message'=>'Update success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->user->findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Delete success']);
//        return redirect()->route('users.index')->with(['message' => 'Delete success']);

    }
}
