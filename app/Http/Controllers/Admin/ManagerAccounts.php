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
        // sử dụng middleware đặt biến $this->role = role người dùng đã login vào
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            // Nếu người dùng đăng nhập vào không phải admin = 1 thì sẽ trả về trang không tồn  tại abort(404)
            if ($this->role != 1) {
                App::abort(404);
            }
            return $next($request);
        });
    }

    public function index()
    {
        // lấy toàn bộ users
        $users = User::with('roles')->get();

        // lấy toàn bộ quyền
        $roles = Roles::get();

        return view('admin.managers.accounts', compact('users', 'roles'));
    }

    // created account
    public function createAccount(Request $request)
    {
        // phần hiển thị thông báo lỗi được custom lại = tiếng việt
        $messages = [
            'username.required' => 'Vui lòng nhập tài khoản',
            'email.required' => 'Vui lòng nhập email ',
            'password.required' => 'Vui lòng nhập mật khẩu ',
            'role.required' => 'Phân quyền không hợp lệ'
        ];

        // check validator xem kiều kiện nhập vào có đúng với định dạng hay không
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'email' => 'required|max:255|email',
            'password' => 'required|min:8',
            'role'  => 'required'
        ], $messages);

        // check email
        $user = User::where('email', $request->email)->first();

        // nếu = false thì tiếp tục đoạn này
        if ($user == false) {
            // nếu validator ko thoả mãn điều kiện nào đó thì sẽ check ở đoạn này
            if ($validator->fails()) {
                // in lỗi ở dạng json
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ));
            }

            // thêm tài khoản vào bảng
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
        // check empty $id
        if ($id) {
            // select user where id = $id
            $user = User::with('roles')->where('id', $id)->first();
            // select all role
            $all_roles = Roles::orderBy('id', 'desc')->get();
            return view('admin.managers.editer', compact('user', 'all_roles'));
        }

        App::abort(404);
    }

    public function update(Request $request)
    {
        // check validator xem kiều kiện nhập vào có đúng với định dạng hay không
        $validator = Validator::make($request->all(), [
            'id'    => 'required',
            'username' => 'required|max:255',
            'email' => 'required|max:255|email',
            'password' => 'required|min:8',
            'role'  => 'required'
        ]);

        // nếu validator ko thoả mãn điều kiện nào đó thì sẽ check ở đoạn này
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
            // update dữ liệu mới vào dữ liệu cũ
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
        //check empty of $id
        if (!empty($id)) {
            // remove user where id = $id
            User::where('id', $id)->delete();
            // remove News where id = $id
            News::where('user_id', $id)->delete();
            // remove Approval where id = $id
            Approval::where('user_id', $id)->delete();
            // remove Comments where id = $id
            Comments::where('user_id', $id)->delete();

            return redirect()->back()->with('remove_success', 'Xóa thành công!');
        }

        App::abort(404);
    }

    public function deletes_checked(Request $request)
    {
        // check json_decode($request->checkeds not null
        if (json_decode($request->checkeds) != null) {
            // json_decode đoạn request->checkeds đó
            $data = json_decode($request->checkeds);
            // foreach data take value 
            foreach ($data as $value) {
                // remove user where id = $id
                User::where('id', $value)->delete();
                // remove News where id = $id
                News::where('user_id', $value)->delete();
                // remove Comments where id = $id
                Comments::where('user_id', $value)->delete();
                // remove Approval where id = $id
                Approval::where('user_id', $value)->delete();
            }
            return Response::json(array('success' => 'Đã xóa tài khoản được chọn!'), 200);
        }

        return Response::json(array('error' => 'Không có tài khoản được xóa!'), 200);
    }
}