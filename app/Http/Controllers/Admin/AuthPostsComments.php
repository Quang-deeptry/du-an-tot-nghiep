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
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            if ($this->role == 4) {
                App::abort(404);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $posts = News::with('comment')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('admin.comments.auth-posts-comments', compact('posts'));
    }

    public function view_list_comments($id)
    {
        if (isset($id)) {

            $post_comment = News::with('comment')->with('user')->where('user_id', Auth::user()->id)->where('id', $id)->first();
            if ($post_comment == true) {
                return view('admin.comments.view-auth-comment', compact('post_comment'));
            }
        }
        App::abort(404);
    }

    public function delete($id)
    {
        if ($id) {
            $delete =  Comments::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Đã xóa bình luận này !');
        }

        App::abort(404);
    }
}