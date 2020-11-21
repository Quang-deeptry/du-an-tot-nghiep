<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\News;
use App\Models\Roles;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostDetail extends Controller
{
    public function index($id, $slug)
    {

        $posts = News::orderBy('id', 'desc')
            ->take(8)
            ->get();

        $news_post_detail = News::with('user')
            ->with('category')->with('comment')
            ->where('id', $id)
            ->first();

        // show role user
        $user = User::with('roles')
            ->where('id', $news_post_detail->user_id)
            ->first();

        $related_news = News::with('category')
            ->where('category_id', $news_post_detail->category_id)
            ->where('id', '!=', $news_post_detail->id)
            ->take(8)
            ->get();
        $title = $news_post_detail->title;

        News::where('id', $id)->update([
            'views_count' =>  $news_post_detail->views_count + 1,
            'updated_at' => Carbon::now(),
        ]);

        return view('client.post-detail', compact('title', 'posts', 'news_post_detail', 'related_news', 'user'));
    }

    public function createComment(Request $request)
    {
        Comments::create([
            'user_id' => Auth::user()->id,
            'news_id' => $request->post_id,
            'comment' => $request->message,
        ]);

        $res = Comments::with('news')
            ->with('user')
            ->where('news_id', $request->post_id)
            ->orderBy('id', 'desc')
            ->first();
        return response()->json($res);
    }

    public function getComment(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $comments = Comments::select('comment', 'created_at', 'user_id')
            ->with(['user' => function ($query) {
                $query->select('id', 'username');
            }])
            ->where('news_id', $request->id)
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        $countComments = Comments::where('news_id', $request->id)
            ->count();
        return response()->json([
            'data' => $comments,
            'count' => $countComments,
        ]);
    }
}