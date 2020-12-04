<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscribe as Subscribes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class Subscribe extends Controller
{
    protected $role;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            if ($this->role == 4 && $this->role == 3) {
                return $next($request);
            }
            App::abort(404);
        });
    }

    public function created(Request $request)
    {
        $message = [
            'message.required' => 'Vui lòng nhập email',
            'message.email' => 'Xin lỗi email không hợp lệ!'
        ];

        $validator = Validator::make($request->all(), [
            'message' => 'required|email'
        ], $message);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }

        $subscribe = Subscribes::where('email', $request->message)->first();

        if ($subscribe != null) {
            return Response::json(array('error' => 'Email đã tồn tại!'), 200);
        }

        $created = Subscribes::create([
            'email' => $request->message,
        ]);
        return Response::json(array('success' => 'Đã đăng kí thành công!'), 200);
    }

    public function index()
    {
        $subscribes = Subscribes::get();
        return view('admin.subscribes.subscribe', compact('subscribes'));
    }

    public function deletes_checked(Request $request)
    {
        if (json_decode($request->checkeds) != null) {
            $data = json_decode($request->checkeds);

            foreach ($data as $item) {
                Subscribes::where('id', $item)->delete();
            }
            return Response::json(array('success' => 'Đã xóa email đã chọn!'), 200);
        }
        return Response::json(array('error' => 'Không có email được xóa!'), 200);
    }
}