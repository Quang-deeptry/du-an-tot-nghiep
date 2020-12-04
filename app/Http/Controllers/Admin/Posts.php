<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;


class Posts extends Controller
{
    protected $role;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            if ($this->role != 4) {
                return $next($request);
            }
            App::abort(404);
        });
    }


    public function index()
    {
        // categories 
        $categories = Categories::get();
        return view('admin.posts.create-post', compact('categories'));
    }

    public function createPost(Request $request)
    {

        $messages = [
            'category_id.required' => 'Vui lòng chọn thể loại',
            'title.required' => 'Vui lòng nhập thể loại',
            'title.max' => 'Vui lòng ít hơn 191 kí tự',
            'description.required' => 'Vui lòng nhập mô tả ngắn',
            'description.max' => 'Vui lòng nhập nhỏ hơn 255 kí tự',
            'image.required'  => 'Vui lòng chọn hình ảnh',
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

        $approval = Approval::create(array(
            'user_id'       => Auth::user()->id,
            'category_id'   => $request->category_id,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'description'   => $request->description,
            'image'         => '/clients/uploads/' . $name,
            'content'       => $request->content,
            'views_count'   => 1,
            'status'        => 0,
        ));
        $newapproval = $approval->replicate();

        return redirect()->back()->with('message', 'Tạo bài viết thành công!');
    }
}