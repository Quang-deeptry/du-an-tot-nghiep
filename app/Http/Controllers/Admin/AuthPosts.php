<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;



class AuthPosts extends Controller
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
        // news 
        $news =  News::with('category')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.manager-post.auth-posts', compact('news'));
    }

    public function editer($id, $slug)
    {
        if (isset($id)) {

            $categories = Categories::get();

            $post = News::with('category')
                ->where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->first();
            if ($post != null) {
                return view('admin.manager-post.auth-post-editer', compact('categories', 'post'));
            }
            App::abort(404);
        }

        App::abort(404);
    }

    public function update(Request $request)
    {
        if (!empty($request->id)) {

            $post = News::where('id', $request->id)->first();

            $messages = [
                'category_id.required' => 'Vui lòng chọn thể loại',
                'title.required' => 'Vui lòng nhập thể loại',
                'title.max' => 'Vui lòng ít hơn 191 kí tự',
                'description.required' => 'Vui lòng nhập mô tả ngắn',
                'description.max' => 'Vui lòng nhập nhỏ hơn 255 kí tự',
                'image.required'  => 'Vui lòng chọn hình ảnh',
                'image.mimes' => 'Vui lòng chọn đúng định dạng ảnh',
                'content.required' => 'Vui lòng nhập nội dung chính',
            ];

            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
                'title' => 'required|max:191',
                'description' => 'required|max:255',
                'image' => 'required|mimes:jpeg,jpg,png,gif',
                'content' => 'required',
            ], $messages);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalName();
                $publicPath = public_path('/clients/uploads');
                $image->move($publicPath, $name);
            }

            $update = News::where('id', $request->id)->update(array(
                'user_id'       => Auth::user()->id,
                'category_id'   => $request->category_id,
                'title'         => $request->title,
                'slug'          => Str::slug($request->title),
                'description'   => $request->description,
                'image'         => '/clients/uploads/' . $name,
                'content'       => $request->content,
                'views_count'   => $post->views_count,
                'status'        => $request->status,
            ));

            return redirect()->back()->with('message', 'Cập nhật thành công!');
        }

        return redirect()->back()->with('danger', 'Chúng tôi phát hiện bạn đang thay đổi 1 số điều không được phép !');
    }

    public function deletes_checked(Request $request)
    {
        if (json_decode($request->checkeds) != null) {
            $data = json_decode($request->checkeds);
            foreach ($data as $value) {
                News::where('id', $value)->delete();
                Comments::where('news_id', $value)->delete();
            }
            return Response::json(array('success' => 'Đã xóa bài viết được chọn!'), 200);
        }

        return Response::json(array('error' => 'Không có bài viết được xóa!'), 200);
    }

    public function delete($id)
    {
        if (isset($id)) {
            News::where('id', $id)->delete();
            Comments::where('news_id', $id)->delete();
            return redirect()->back()->with('remove_success', 'Xóa bài viết thành công !');
        }
        App::abort(404);
    }
}