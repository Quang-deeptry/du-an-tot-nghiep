<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Roles;
use App\User;
use App\Models\Approval;
use App\Models\Comments;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class ManagerAccounts extends Controller
{
    protected $role;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            if ($this->role != 1) {
                App::abort(404);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::with('roles')->get();

        $roles = Roles::get();

        return view('admin.managers.accounts', compact('users', 'roles'));
    }

    // created account
    public function createAccount(Request $request)
    {
        $messages = [
            'username.required' => 'Vui lòng nhập tài khoản',
            'email.required' => 'Vui lòng nhập email ',
            'password.required' => 'Vui lòng nhập mật khẩu ',
            'role.required' => 'Phân quyền không hợp lệ'
        ];

        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'email' => 'required|max:255|email',
            'password' => 'required|min:8',
            'role'  => 'required'
        ], $messages);

        $user = User::where('email', $request->email)->first();

        if ($user != true) {
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ));
            }

            $created_user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role'  => $request->role,
            ]);

            return Response::json(array('success' => 'Tạo tài khoản thành công!'), 200);
        }

        return Response::json(array('error' => 'Email đã tồn tại!'), 200);
    }

    // editer account
    public function editer($id, $username)
    {
        if ($id) {

            $user = User::with('roles')->where('id', $id)->first();
            $all_roles = Roles::orderBy('id', 'desc')->get();
            return view('admin.managers.editer', compact('user', 'all_roles'));
        }

        App::abort(404);
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

            User::where('id', $id)->delete();
            News::where('user_id', $id)->delete();
            Approval::where('user_id', $id)->delete();
            Comments::where('user_id', $id)->delete();

            return redirect()->back()->with('remove_success', 'Xóa thành công!');
        }

        App::abort(404);
    }

    public function deletes_checked(Request $request)
    {
        if (json_decode($request->checkeds) != null) {
            $data = json_decode($request->checkeds);
            foreach ($data as $value) {
                User::where('id', $value)->delete();
                News::where('user_id', $value)->delete();
                Comments::where('user_id', $value)->delete();
                Approval::where('user_id', $value)->delete();
            }
            return Response::json(array('success' => 'Đã xóa tài khoản được chọn!'), 200);
        }

        return Response::json(array('error' => 'Không có tài khoản được xóa!'), 200);
    }
}