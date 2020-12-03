<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use App\Models\News;

class PostCategories extends Controller
{
    public function index(Request $request, $id, $slug)
    {
        if (isset($id) && isset($slug)) {
            // display categories
            $category = Categories::where('id', $id)->first();
            // check category == true
            if ($category == true) {
                // select news where category_id = $category_id after pagination
                $news_with_category = News::with('category')->where('category_id', $category->id)->paginate(6);
                $news_hot = News::orderBy('id', 'desc')->take(8)->get();
                return view('client.post-category', compact(
                    'id',
                    'news_hot',
                    'category',
                    'news_with_category',
                ));
            }
            App::abort(404);
        }
        App::abort(404);
    }
}