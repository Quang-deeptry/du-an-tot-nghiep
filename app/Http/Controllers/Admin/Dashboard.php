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
        $count_unapproval = Approval::count();
        $count_posts = News::count();
        $count_users = User::count();
        $count_comments = Comments::count();

        // show chartjs 12 months 
        $monthsData = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $time = Carbon::now();
        $current_year = $time->year;

        foreach ($monthsData as $month) {
            $countMonth[] = News::whereYear('created_at', $current_year)->whereMonth('created_at', $month)->count();
        }

        $month_current = $time->month - 1;
        $count_month_current = $countMonth[$month_current] - $countMonth[$month_current - 1];

        return view('admin.index', compact('count_unapproval', 'count_posts', 'count_users', 'count_comments', 'countMonth', 'count_month_current'));
    }
}