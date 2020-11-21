<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ApprovalArticles extends Controller
{
    public function index()
    {
        if (Auth::user()->id == 0 || Auth::user()->id == 2) {
            // news 
            $approval_articles =  News::with('category')->orderBy('id', 'desc')->where('status', 1)->get();

            return view('admin.manager-post.approval-articles', compact('approval_articles'));
        }

        App::abort(404);
    }

    public function editer($id, $slug)
    {
        if (isset($id)) {
            $categories = Categories::get();
            $post = News::with('category')->where('id', $id)->first();

            return view('admin.manager-post.approval-articles-editer', compact('categories', 'post'));
        }
    }

    public function update(Request $request)
    {

        $post = News::where('id', $request->id)->first();

        $messages = [
            'category_id.required' => 'Vui lòng chọn thể loại',
            'title.required' => 'Vui lòng nhập thể loại',
            'title.max' => 'Vui lòng ít hơn 80 kí tự',
            'description.required' => 'Vui lòng nhập mô tả ngắn',
            'description.max' => 'Vui lòng nhập nhỏ hơn 255 kí tự',
            'image.required'  => 'Vui lòng chọn hình ảnh',
            'image.mimes' => 'Vui lòng chọn đúng định dạng ảnh',
            'content.required' => 'Vui lòng nhập nội dung chính',
        ];

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required|max:80',
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
            'updated_at'    => Carbon::now(),
        ));

        return redirect()->back()->with('message', 'Cập nhật thành công!');
    }
}