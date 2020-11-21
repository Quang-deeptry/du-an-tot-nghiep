<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChangesRole extends Controller
{
    public function changeRole()
    {
        $roles = Roles::get();
        return view('admin.managers.change-roles', compact('roles'));
    }

    public function editer($id, $name)
    {
        $role = Roles::where('id', $id)->first();
        return view('admin.managers.editer-role', compact('role'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'    => 'required',
            'name' => 'required|max:50|min:3',
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

            Roles::where('id', $request->id)->update([
                'name' => $request->name,
            ]);
        }

        return response()->json($message);
    }
}