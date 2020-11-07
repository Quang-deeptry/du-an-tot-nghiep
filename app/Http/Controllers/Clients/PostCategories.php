<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;

class PostCategories extends Controller
{
    public function index($id, $slug)
    {
        // display categories
        $categories = Categories::get();
        $news_with_category = News::with('category')->where('category_id', $id)->paginate(6);
        $news_hot = News::orderBy('id', 'desc')->take(8)->get();
        return view('client.post-category', compact(
            'id',
            'news_hot',
            'categories',
            'news_with_category',
        ));
    }
}