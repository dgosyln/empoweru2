<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{

    public function edit($id)
    {
        $user = User::leftjoin('roles', 'roles.id', 'users.role_id')->first([
            'users.*', 'roles.name as role'
        ]);

        return view('v1/profile/edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
        ]);

        return back()->with('success', 'Profile updated successfully');
    }
}
