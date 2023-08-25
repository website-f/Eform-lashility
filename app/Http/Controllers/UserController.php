<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function users() {
        $user = User::all();
        return view('user.user', ['user'=>$user]);
    }

    public function addUser() {
        $role = Role::all();
        return view('user.add-user', ['role'=> $role]);
    }

    public function profile($id) {
        $user = User::findOrFail($id);
        $role = Role::all();
        return view('user.view-user', ['user'=>$user, 'role'=>$role]);
    }

    public function createUser(Request $request) {
        $request->password = bcrypt($request->password);
        $user = User::create($request->all());
        return redirect("/users");
    }

    public function editUser(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        $user->save();
        if ($user) {
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully Edit Profile');
        }
        return redirect('/profile/'. $id);
    }

    public function changePasswordUser(Request $request, $id) {
        $user = User::findOrFail($id);
        $currentPassword = $request->currentPassword;

        if (Hash::check($currentPassword, $user->password)) {
            $user->password = $request->password;
            $user->save();
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully changed password');
            return redirect('/profile/'. $id);
        } else {
            Session::flash('status', 'danger');
            Session::flash('message', 'old password not match with current password');
            return redirect('/profile/'. $id);
        }
    }

    public function deleteUser($id) {
        $user = User::findOrFail($id);
        $user->delete();
        if ($user) {
            Session::flash('status', 'success');
            Session::flash('message', 'Successfully removed user');
        }
        return redirect('/users');
    }
}
