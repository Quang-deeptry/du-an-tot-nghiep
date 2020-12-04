<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\News;
use App\User;
use App\Models\Comments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;


class Dashboard extends Controller
{
    protected $role;

    public function __construct()
    {
        // sử dụng middleware đặt biến $this->role = role người dùng đã login vào
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            // Nếu người dùng đăng nhập vào là người dùng có role = 4 thì sẽ trả về trang không tồn  tại abort(404)
            if ($this->role != 4) {
                return $next($request);
            }
            App::abort(404);
        });
    }

    public function index()
    {
        // lấy số lượng bài viet chưa duyệt
        $count_unapproval = Approval::count();
        // lấy số lượng bài viết đã duyệt 
        $count_posts = News::count();
        // lấy số lượng users
        $count_users = User::count();
        // lấy số lượng bình luận
        $count_comments = Comments::count();

        // show chartjs 12 months 
        $monthsData = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        // tgian hiện tại
        $time = Carbon::now();
        // năm hiện tại
        $current_year = $time->year;

        // foreach data 12 tháng
        foreach ($monthsData as $month) {
            // thêm tháng của năm hiện tại vào countMonth có số lượng bài viết
            $countMonth[] = News::whereYear('created_at', $current_year)->whereMonth('created_at', $month)->count();
        }

        // tháng hiện tại = tháng hiện tại - 1 để tính tháng trước của tháng hiện tại
        $month_current = $time->month - 1;
        // tính số lượng bài viết của tháng hiện tại trừ số lượng bài viết của tháng trước
        $count_month_current = $countMonth[$month_current] - $countMonth[$month_current - 1];

        return view('admin.index', compact('count_unapproval', 'count_posts', 'count_users', 'count_comments', 'countMonth', 'count_month_current'));
    }
}