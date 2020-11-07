<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthPost extends Controller
{
    public function index($id, $username, Request $request)
    {
        // hot title
        $posts = News::orderBy('id', 'desc')
            ->take(8)
            ->get();

        // show posts with user
        if (User::with('news')->with('roles')->where('id', $id)->first()) {
            $user = User::with('news')->with('roles')->where('id', $id)->first();
            $news_posts = News::with('category')->where('user_id', $id)->orderBy('id', 'desc')->paginate(8);
        } else {
            $user = User::with('news')->with('roles')->where('id', Auth::user()->id)->first();
            $news_posts = News::with('category')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(8);
        }
        return view('client.auth-post', compact('posts', 'user', 'news_posts'));
    }

    public function profile($username)
    {
        // hot title
        $posts = News::orderBy('id', 'desc')
            ->take(8)
            ->get();

        // show posts with user
        $user = User::with('news')->with('roles')->where('id', Auth::user()->id)->first();
        // show product to user create
        $news_posts = News::with('category')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(8);
        // dd($news_posts);
        return view('client.auth-post', compact('posts', 'user', 'news_posts'));
    }
}