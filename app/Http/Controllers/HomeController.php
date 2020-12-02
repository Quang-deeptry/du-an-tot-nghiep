<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Categories;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        // show one post top banner
        $news_hot = News::orderBy('id', 'desc')
            ->take(8)
            ->get();
        $categories = Categories::with('newCount')->get();

        // categories
        $categories = Categories::with('newCount')
            ->get();
        //
        $news_four_top_1 = News::where('category_id', 1)
            ->inRandomOrder()
            ->take(1)
            ->get();

        $news_four_top_2 = News::where('category_id', 2)
            ->inRandomOrder()
            ->take(1)
            ->get();
        $news_four_top_3 = News::where('category_id', 3)
            ->inRandomOrder()
            ->take(1)
            ->get();
        $news_four_top_4 = News::where('category_id', 4)
            ->inRandomOrder()
            ->take(1)
            ->get();

        // show ot category
        $category_current = Categories::with('news')->where('id', 1)
            ->first();
        $post_category_current = News::with('category')
            ->with('user')
            ->where('category_id', 1)
            ->orderBy('views_count', 'desc')
            ->first();
        $post_four_category_current = News::where('category_id', 1)
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();
        // asd
        $categories_not1 = Categories::with(array('news' => function ($query) {
            $query->with(array('user' => function ($user) {
                $user->select('id', 'username');
            }))->orderBy('views_count', 'desc');
        }))
            ->where('id', '!=', 1)
            ->limit(4)
            ->get();

        // return $posts_four_categ ory;
        // life style 
        $life_style = News::take(6)
            ->orderBy('id', 'desc')
            ->get();

        // recents news
        $recent_news = News::take(4)
            ->orderBy('id', 'desc')
            ->get();

        // 
        $news_three_top_1 = News::with('category')->with('user')->where('category_id', 1)
            ->orderBy('id', 'desc')
            ->take(1)
            ->get();

        $news_three_top_2 = News::with('category')->with('user')->where('category_id', 2)
            ->orderBy('id', 'desc')
            ->take(1)
            ->get();

        $news_three_top_3 = News::with('category')->with('user')->where('category_id', 3)
            ->orderBy('id', 'desc')
            ->take(1)
            ->get();
        // three post demo
        $post_1_in_three = News::with('category')
            ->where('category_id', 1)
            ->where('id', '!=', 1)
            ->orderBy('id', 'desc')
            ->take(5)->get();

        $post_2_in_three = News::with('category')
            ->where('category_id', 2)
            ->where('id', '!=', 2)
            ->orderBy('id', 'desc')
            ->take(5)->get();

        $post_3_in_three = News::with('category')
            ->where('category_id', 3)
            ->where('id', '!=', 3)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // other news
        $post_other_news_current = News::where('category_id', 1)
            ->with('category')
            ->with('user')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // view
        return view('welcome', compact([
            'news_hot',
            'categories',
            'news_four_top_1',
            'news_four_top_2',
            'news_four_top_3',
            'news_four_top_4',
            'category_current',
            'post_category_current',
            'post_four_category_current',
            'categories_not1',
            'life_style',
            'recent_news',
            'news_three_top_1',
            'news_three_top_2',
            'news_three_top_3',
            'post_1_in_three',
            'post_2_in_three',
            'post_3_in_three',
            'post_other_news_current',
        ]));
    }
}