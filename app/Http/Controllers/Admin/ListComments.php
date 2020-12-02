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
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {

            $posts = News::with('comment')->get();
            return view('admin.comments.list-comments', compact('posts'));
        }

        App::abort(404);
    }

    public function delete($id)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {

            if ($id) {
                $delete =  Comments::where('id', $id)->delete();
                return redirect()->back()->with('success', 'Đã xóa bình luận này !');
            }
        }

        App::abort(404);
    }

    public function view_list_comments($id)
    {
        if (isset($id)) {

            $post_comment = News::with('comment')->with('user')->where('id', $id)->first();
            if ($post_comment == true) {
                return view('admin.comments.view-list-comments', compact('post_comment'));
            }
        }
        App::abort(404);
    }

    public function deletes_checked(Request $request)
    {
        if (json_decode($request->checkeds) != null) {
            $data = json_decode($request->checkeds);
            foreach ($data as $value) {
                Comments::where('id', $value)->delete();
            }
            return Response::json(array('success' => 'Đã xóa bình luận được chọn!'), 200);
        }

        return Response::json(array('error' => 'Không có bình luận được xóa!'), 200);
    }
}