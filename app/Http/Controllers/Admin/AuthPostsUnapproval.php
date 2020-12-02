<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Categories;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;


class AuthPostsUnapproval extends Controller
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

        $unapproval_articles =  Approval::with('category')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('admin.manager-post.auth-post-unapproval', compact('unapproval_articles'));
    }

    public function editer($id, $slug)
    {
        if (isset($id)) {
            $categories = Categories::get();
            $post = Approval::with('category')->where('user_id', Auth::user()->id)->where('id', $id)->first();

            return view('admin.manager-post.auth-post-unapproval-editer', compact('categories', 'post'));
        }
    }

    public function update(Request $request)
    {

        if ($request->id && $request->user_id != "") {
            $post = Approval::where('user_id', Auth::user()->id)->where('id', $request->id)->first();

            $messages = [
                'user_id.required' => 'user null',
                'id.required' => 'id post null',
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

            $update = Approval::where('user_id', Auth::user()->id)->where('id', $request->id)->update(array(
                'user_id'       => $request->user_id,
                'category_id'   => $request->category_id,
                'title'         => $request->title,
                'slug'          => Str::slug($request->title),
                'description'   => $request->description,
                'image'         => '/clients/uploads/' . $name,
                'content'       => $request->content,
                'views_count'   => $post->views_count,
                'status'        => 0,
                'updated_at'    => Carbon::now(),
            ));

            return redirect()->back()->with('message', 'Cập nhật thành công!');
        } else {
            return redirect()->back()->with('danger', 'Chúng tôi phát hiện bạn đang thay đổi 1 số điều không được phép');
        }
    }

    public function delete($id)
    {
        if (isset($id)) {
            Approval::where('id', $id)->delete();
            return redirect()->back()->with('remove_success', 'Xóa bài viết thành công !');
        }
        App::abort(404);
    }

    public function deletes_checked(Request $request)
    {
        if (json_decode($request->checkeds) != null) {
            $data = json_decode($request->checkeds);
            foreach ($data as $value) {
                Approval::where('id', $value)->delete();
            }
            return Response::json(array('success' => 'Đã xóa bài viết được chọn!'), 200);
        }

        return Response::json(array('error' => 'Không có bài viết được xóa!'), 200);
    }
}