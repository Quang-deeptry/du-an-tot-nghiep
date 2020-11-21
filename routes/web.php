<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', 'HomeController@index');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// menu news page
Route::group(['prefix' => '/'], function () {
    Route::get('/news', 'Clients\Posts@index');
    Route::get('news/q/{year?}/{month?}/{category?}', 'Clients\Posts@getPosts');

    Route::get('/category/{id}/{slug}', 'Clients\PostCategories@index');
    // Post detail
    Route::get('/posts/{id}/{slug}', 'Clients\PostDetail@index');
    //send message 
    Route::post('/posts/post-detail/send-message', 'Clients\PostDetail@createComment')->middleware('auth');
    // auth post user
    Route::get('/auth-posts/{id}/{username}', 'Clients\AuthPost@index')->middleware('auth');
    Route::get('/auth-posts/{username}', 'Clients\AuthPost@profile')->middleware('auth');
    // user edit
    Route::get('/user-edit', 'Clients\AuthPost@edit')->middleware('auth');
    Route::post('/user-update', 'Clients\AuthPost@update')->middleware('auth');
});;

// get comment 
Route::get('/posts/getcomments', 'Clients\PostDetail@getComment');


Route::group(['prefix' => '/admin-newsflash', 'middleware' => 'auth'], function () {
    Route::get('trang-chu', 'Admin\HomeController@index');

    // manager accounts
    Route::get('/manager-accounts', 'Admin\ManagerAccounts@index');
    Route::get('/manager-accounts/delete/{id}', 'Admin\ManagerAccounts@delete');
    Route::get('/manager-accounts/editer/{id}/{username}', 'Admin\ManagerAccounts@editer');
    Route::post('/manager-accounts/update', 'Admin\ManagerAccounts@update');
    // change roles
    Route::get('/change-roles', 'Admin\ChangesRole@changeRole');
    Route::get('/change-roles/editer/{id}/{name}', 'Admin\ChangesRole@editer');
    Route::post('/change-roles/update', 'Admin\ChangesRole@update');

    // managers auth post
    Route::get('/auth-posts', 'Admin\AuthPosts@index');
    Route::get('/auth-posts/editer/{id}/{slug}', 'Admin\AuthPosts@editer');
    Route::post('/auth-post/update', 'Admin\AuthPosts@update');

    // Approval articles
    Route::get('/approval-articles', 'Admin\ApprovalArticles@index');
    Route::get('/approval-articles/editer/{id}/{slug}', 'Admin\ApprovalArticles@editer');
    Route::post('/approval-articles/update', 'Admin\ApprovalArticles@update');

    // unapproval articles
    Route::get('/unapproval-articles', 'Admin\UnapprovalArticles@index');
    Route::get('/unapproval-articles/editer/{id}/{slug}', 'Admin\UnapprovalArticles@editer');
    Route::post('/unapproval-articles/update', 'Admin\UnapprovalArticles@update');
    Route::get('/unapproval-articles/active/{id}/{slug}', 'Admin\UnapprovalArticles@active');

    // created post
    Route::get('/create-post', 'Admin\Posts@index');
    Route::post('/create-post', 'Admin\Posts@createPost');
});