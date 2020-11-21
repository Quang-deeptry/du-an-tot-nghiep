<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

    public function edit()
    {
        // hot title
        $posts = News::orderBy('id', 'desc')
            ->take(8)
            ->get();
        $user = User::with('roles')->where('id', Auth::user()->id)->first();

        return view('client.edit-user', compact('posts', 'user'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {

            $message =  [
                'mess' => 'Cập nhật không thành công !'
            ];
        } else {
            $message =  [
                'mess' => 'Cập nhật thành công!'
            ];

            User::where('id', Auth::user()->id)->update([
                'username' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }
        return response()->json($message);
    }
}