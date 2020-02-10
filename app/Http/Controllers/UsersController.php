<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Model\Role;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::where('role_id', '<>', Role::_APPLICANT)->latest()->get();
        return view('v1/users/index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('v1/users/create', compact('roles'));
    }

    public function store(UserRequest $request)
    {

        User::create([
            'role_id' => $request->role_id,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'contact_no' => $request->contact_no
        ]);

        return back()->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('v1/users/edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id)->update([
            'role_id' => $request->role_id,
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'contact_no' => $request->contact_no
        ]);

        return back()->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->is_active ? $status = 0 : $status = 1;
        $user->update(['is_active' => $status]);
        return back()->with('success', 'User deactivated successfully');
    }
}
