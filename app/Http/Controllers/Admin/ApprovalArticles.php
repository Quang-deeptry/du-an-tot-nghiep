<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ApprovalArticles extends Controller
{
    protected $role;

    public function __construct()
    {
        // sử dụng middleware đặt biến $this->role = role người dùng đã login vào
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            // Nếu người dùng đăng nhập vào là người dùng có role = 4 và tác giả là role = 3 thì sẽ trả về trang không tồn  tại abort(404)
            if ($this->role == 1 || $this->role == 2) {
                // Hoặc sẽ đi tới trang đã chỉ định
                return $next($request);
            }
            App::abort(404);
        });
    }

    public function index()
    {
        // news lấy bài viết có status = 1 và hiển thị ra
        $approval_articles =  News::with('category')
            ->orderBy('id', 'desc')
            ->where('status', 1)
            ->get();

        return view('admin.manager-post.approval-articles', compact('approval_articles'));
    }

    public function editer($id, $slug)
    {
        // check tồn tại của $id
        if (isset($id)) {
            // lấy toàn bộ thể loại trong database
            $categories = Categories::get();
            // lấy bài viết có id = với $id được chỉ định
            $post = News::with('category')
                ->where('id', $id)
                ->first();

            return view('admin.manager-post.approval-articles-editer', compact('categories', 'post'));
        }
    }

    public function update(Request $request)
    {
        // lấy bài viết có id = $id được chỉnh định
        $post = News::where('id', $request->id)->first();

        // phần hiển thị thông báo lỗi được custom lại = tiếng việt
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

        // check validator xem kiều kiện nhập vào có đúng với định dạng hay không
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required|max:191',
            'description' => 'required|max:255',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
            'content' => 'required',
        ], $messages);

        // nếu validator ko thoả mãn điều kiện nào đó thì sẽ check ở đoạn này
        if ($validator->fails()) {
            // trả về đoạn lỗi $message mà mình đã đưa vào validator $message
            return Redirect::back()->withErrors($validator);
        }

        // kiểm tra có file image được request lên hay ko
        if ($request->hasFile('image')) {
            // trong này sẽ là upload ảnh lên serve
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalName();
            $publicPath = public_path('/clients/uploads');
            $image->move($publicPath, $name);
        }

        // update dữ liệu mới vào dữ liệu cũ
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

    public function delete($id)
    {
        // check tồn tại của $id
        if (isset($id)) {
            // xóa bài viết có trường id được chỉ định
            $delete = News::where('id', $id)->delete();
            return redirect()->back()->with('remove_success', 'Xóa bài viết thành công!');
        }
        App::abort(404);
    }

    public function deletes_checked(Request $request)
    {
        // check $request->checkeds có == null không
        if (json_decode($request->checkeds) != null) {

            // json_decode đoạn request->checkeds đó
            $data = json_decode($request->checkeds);
            foreach ($data as $value) {
                //foreach data ra và xóa từng giá trị bên trong đó
                //ở đây $value là $id của các bài viết mà mình chọn ở phần front-end 
                $delete = News::where('id', $value)->delete();
            }
            // số 200 là mình đặt mã trạng thái phản hồi,
            // muốn đổi mã trạng thái khác thì cần phải custom lại đoạn response::json 
            return Response::json(array('success' => 'Đã xóa bài viết được chọn!'), 200);
        }

        return Response::json(array('error' => 'Không có bài viết được xóa!'), 200);
    }
}