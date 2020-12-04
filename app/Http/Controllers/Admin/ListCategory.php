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
        // sử dụng middleware đặt biến $this->role = role người dùng đã login vào
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            // Nếu người dùng đăng nhập vào là admin = 1 hoặc kiểm duyệt = 2 thì sẽ trả về trang không tồn  tại abort(404)
            if ($this->role == 1 || $this->role == 2) {
                return $next($request);
            }
            App::abort(404);
        });
    }

    public function index()
    {
        // lấy toàn bộ thể loại trong database 
        $categories = Categories::get();

        return view('admin.categories.list-category', compact('categories'));
    }

    public function create(Request $request)
    {
        // phần hiển thị thông báo lỗi được custom lại = tiếng việt
        $messages = [
            'category_name.required' => 'Vui lòng nhập thể loại',
        ];
        // check validator xem kiều kiện nhập vào có đúng với định dạng hay không
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|max:55',
        ], $messages);
        // nếu validator ko thoả mãn điều kiện nào đó thì sẽ check ở đoạn này
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }

        // phân tách đoạn string nhập vào bởi dấu cách và thêm vào trong 1 mảng
        $category_name = explode(' ', $request->category_name);

        // foreach mảng đó ra
        foreach ($category_name as $name) {
            // tìm kiếm tên thể loại có trùng với các từ trong mảng hay không 
            $category_get = Categories::where('category', 'like', '%' . $name . '%')->distinct()->get();
        }

        // nếu không trùng khớp với thể loại nào thì tiếp tục ở đoạn này
        // nếu trùng thì sẽ bỏ qua đoạn này
        if (count($category_get) == 0) {
            // thêm thể loại mới vào bảng
            $created_category = Categories::create([
                'category' => $request->category_name,
                'slug'  => Str::slug($request->category_name),
            ]);

            return Response::json(array('success' => 'Thêm thể loại thành công!'), 200);
        }

        return Response::json(array('error' => 'Thể loại đã tồn tại!'), 200);
    }

    public function delete($id)
    {
        // check tồn tại của $Id
        if ($id) {
            // lấy bài viết có category_id = $id được chỉ định
            $posts = News::where('category_id', $id)->get();
            // nếu đoạn mã trên đúng thì sẽ tiếp tục ở đây
            if ($posts == true) {
                // nếu đoạn select eloquent trên có tồn tại một hoặc nhiều bài viết có cùng category_id
                if (count($posts) > 0) {
                    // foreach bài viết đó ra
                    foreach ($posts as $post) {
                        // xóa comment có news_id = id bài viết
                        Comments::where('news_id', $post->id)->delete();
                    }
                    // xóa thể loại có id = $id được chỉ định
                    Categories::where('id', $id)->delete();
                    // xóa bài viết có category_id = $id của thể loại
                    News::where('category_id', $id)->delete();
                    // xóa bài viết chưa duyệt có category_id = $id của thể loại
                    Approval::where('category_id', $id)->delete();

                    return redirect()->back()->with('success', 'Xóa thể loại thành công');
                }
            }
        }
    }

    public function deletes_checked(Request $request)
    {
        // check $request->checkeds có == null không
        if (json_decode($request->checkeds) != null) {
            // lấy toàn bộ bài viết đã duyệt
            $news = News::get();
            // lấy toàn bộ bài viết chưa duyệt
            $approvals = Approval::get();
            // json_decode đoạn request->checkeds đó
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