<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\News;
use App\Models\Approval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;


class ListCategory extends Controller
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
        //categories 
        $categories = Categories::get();

        return view('admin.categories.list-category', compact('categories'));
    }

    public function create(Request $request)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {

            $messages = [
                'category_name.required' => 'Vui lòng nhập thể loại',
            ];

            $validator = Validator::make($request->all(), [
                'category_name' => 'required|max:55',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ));
            }

            $category_name = explode(' ', $request->category_name);

            foreach ($category_name as $name) {
                $category_get = Categories::where('category', 'like', '%' . $name . '%')->distinct()->get();
            }

            if (count($category_get) == 0) {

                $created_category = Categories::create([
                    'category' => $request->category_name,
                    'slug'  => Str::slug($request->category_name),
                ]);

                return Response::json(array('success' => 'Thêm thể loại thành công!'), 200);
            }

            return Response::json(array('error' => 'Thể loại đã tồn tại!'), 200);
        }

        App::abort(404);
    }

    public function delete($id)
    {
        if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            if ($id) {

                $posts = News::where('category_id', $id)->get();

                if ($posts == true) {
                    if (count($posts) > 0) {
                        foreach ($posts as $post) {
                            Comments::where('news_id', $post->id)->delete();
                        }

                        Categories::where('id', $id)->delete();
                        News::where('category_id', $id)->delete();
                        Approval::where('category_id', $id)->delete();

                        return redirect()->back()->with('success', 'Xóa thể loại thành công');
                    }
                }
            }
        }
        App::abort(404);
    }

    public function deletes_checked(Request $request)
    {
        if (json_decode($request->checkeds) != null) {

            $news = News::get();
            $approvals = Approval::get();

            $data = json_decode($request->checkeds);

            // value => id category of categories
            foreach ($data as $value) {
                // item -> category_id of news
                foreach ($news as $item) {
                    News::where('category_id', $value)->delete();
                    Approval::where('category_id', $value)->delete();
                }
                // item -> category_id of approval
                foreach ($approvals as $item) {
                    Approval::where('category_id', $value)->delete();
                }
                Categories::where('id', $value)->delete();
            }

            return Response::json(array('success' => 'Đã xóa thể loại đã chọn !'), 200);
        }

        return Response::json(array('error' => 'Không có thể loại được xóa!'), 200);
    }
}