<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\News;

class AuthPostsComments extends Controller
{
    protected $role;

    public function __construct()
    {
        // sử dụng middleware đặt biến $this->role = role người dùng đã login vào
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            // Nếu người dùng đăng nhập vào là người dùng có role = 4 thì sẽ trả về trang không tồn  tại abort(404)s
            if ($this->role !=  4) {
                // Hoặc sẽ đi tới trang đã chỉ định
                return $next($request);
            }
            App::abort(404);
        });
    }

    public function index()
    {
        // news lấy bài viết có userid_id = id người dùng đang login
        $posts = News::with('comment')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('admin.comments.auth-posts-comments', compact('posts'));
    }

    public function view_list_comments($id)
    {
        // check tồn tại của $id
        if (isset($id)) {
            // lấy bài viết có user_id =  id người dùng đang login và bài viết có id = $id được chỉ định
            $post_comment = News::with('comment')->with('user')->where('user_id', Auth::user()->id)->where('id', $id)->first();
            // nếu trả về kết quả đúng thì sẽ return đoạn này 
            if ($post_comment == true) {
                return view('admin.comments.view-auth-comment', compact('post_comment'));
            }
            // không thì abort(404)
        }
        App::abort(404);
    }

    public function delete($id)
    {
        // check tồn tại của $id
        if ($id) {
            // xóa comment có id = $Id được chỉ định
            $delete =  Comments::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Đã xóa bình luận này !');
        }

        App::abort(404);
    }
}