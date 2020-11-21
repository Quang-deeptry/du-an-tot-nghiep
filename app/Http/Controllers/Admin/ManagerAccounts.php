<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Roles;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ManagerAccounts extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        // return $users;
        return view('admin.managers.accounts', compact('users'));
    }


    // editer account
    public function editer($id, $username)
    {
        $user = User::with('roles')->where('id', $id)->first();
        $all_roles = Roles::orderBy('id', 'desc')->get();
        return view('admin.managers.editer', compact('user', 'all_roles'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'    => 'required',
            'username' => 'required|max:255',
            'email' => 'required|max:255|email',
            'password' => 'required|min:8',
            'role'  => 'required'
        ]);

        if ($validator->fails()) {
            $message = [
                'mess' => 'Cập nhật thất bại!',
                'alert' => 'danger'
            ];
        } else {
            $message = [
                'mess' => 'Cập nhật thành công!',
                'alert' => 'success'
            ];

            User::where('id', $request->id)->update([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
        }

        return response()->json($message);
    }
    // delete account
    public function delete($id)
    {
        if (!empty($id)) {
            $user = User::where('id', '=', Auth::user()->id)->first();

            if ($user == null) {
                App::abort(404);
            } else if ($user->role != 1) {
                App::abort(404);
            } else {
                User::where('id', $id)->delete();
                News::where('user_id', $id)->delete();

                return redirect()->back()->with('remove_success', 'Xóa thành công!');
            }
        }

        App::abort(404);
    }
}