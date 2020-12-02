<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Categories;
use App\Models\News;
use Carbon\Carbon;

class Posts extends Controller
{
    public function index(Request $request)
    {
        // hot title
        $posts = News::orderBy('id', 'desc')
            ->take(8)
            ->get();

        $getposts = News::with('user')
            ->with('category')
            ->orderBy('id', 'desc')
            ->paginate(6);

        $categories = Categories::get();

        return view('client.news', compact('posts', 'getposts', 'categories'));
    }

    public function getPosts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required',
            'month' => 'required',
            'category' => 'required',
        ]);
        // hot title
        $posts = News::orderBy('id', 'desc')
            ->take(8)
            ->get();

        $posts_all = News::get();

        $getposts = News::with('user')
            ->with('category')
            ->where('category_id', 'like', '%' . $request->category . '%')
            ->where('created_at', 'like', '%' . $request->month . '%')
            ->where('created_at', 'like', '%' . $request->year . '%')
            ->orderBy('id', 'desc')
            ->paginate(6);

        $categories = Categories::get();

        return view('client.search-posts', compact('posts', 'getposts', 'categories'));
    }
}