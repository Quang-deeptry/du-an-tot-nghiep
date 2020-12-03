<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\News;
use Illuminate\Support\Facades\Response;


class ListComments extends Controller
{
    protected $role;

    public function __construct()
    {
        // sử dụng middleware đặt biến $this->role = role người dùng đã login vào
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            // Nếu người dùng đăng nhập vào là admin = 1 hoặc kiểm duyệt = 2 thì sẽ trả về trang không tồn  tại abort(404)
            if ($this->role != 1 || $this->role != 2) {
                App::abort(404);
            }
            return $next($request);
        });
    }

    public function index()
    {
        // lấy toàn bộ bài viết đã duyệt 
        $posts = News::with('comment')->get();
        return view('admin.comments.list-comments', compact('posts'));
    }

    public function delete($id)
    {
        // check tồn tại của $id
        if ($id) {
            // xóa comment có id = $id được chỉ định
            $delete =  Comments::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Đã xóa bình luận này !');
        }
    }

    public function view_list_comments($id)
    {
        // check tồn tại của $id
        if (isset($id)) {
            //  lấy  bài viết đã duyệt có id = $id đc chỉ định
            $post_comment = News::with('comment')->with('user')->where('id', $id)->first();
            // nếu đúng thì tiếp tục đoạn này
            if ($post_comment == true) {
                return view('admin.comments.view-list-comments', compact('post_comment'));
            }
            // false thì abort(404)
        }
        App::abort(404);
    }

    public function deletes_checked(Request $request)
    {
        // check $request->checkeds có == null không
        if (json_decode($request->checkeds) != null) {
            // json_decode đoạn request->checkeds đó
            $data = json_decode($request->checkeds);
            // foreach item $data
            foreach ($data as $value) {
                // delete comment have id = $value 
                Comments::where('id', $value)->delete();
            }
            return Response::json(array('success' => 'Đã xóa bình luận được chọn!'), 200);
        }

        return Response::json(array('error' => 'Không có bình luận được xóa!'), 200);
    }
}