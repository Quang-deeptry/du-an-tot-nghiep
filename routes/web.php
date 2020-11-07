<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', 'HomeController@index');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// menu news page
Route::group(['prefix' => '/'], function () {
    Route::get('/news', 'Clients\News@index');
    Route::get('/category/{id}/{slug}', 'Clients\PostCategories@index');
    // Post detail
    Route::get('/posts/{id}/{slug}', 'Clients\PostDetail@index');
    Route::get('/posts/getcomments', 'Clients\PostDetail@getComment');
    //send message 
    Route::post('/posts/post-detail/send-message', 'Clients\PostDetail@createComment')->middleware('auth');
    // auth post user
    Route::get('/auth-posts/{id}/{username}', 'Clients\AuthPost@index')->middleware('auth');
    Route::get('/auth-posts/{username}', 'Clients\AuthPost@profile')->middleware('auth');
});;