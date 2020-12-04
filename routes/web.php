<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', 'HomeController@index');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// menu news page
Route::group(['prefix' => '/'], function () {
    Route::get('/news', 'Clients\Posts@index');
    Route::get('news/q', 'Clients\Posts@getPosts');

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

    // get comment 
    Route::get('/posts/getcomments', 'Clients\PostDetail@getComment');

    // subscribe
    Route::post('/subscribe', 'Admin\Subscribe@created')->middleware('auth');
});;


Route::group(['prefix' => '/admin-newsflash', 'middleware' => 'auth'], function () {

    Route::get('trang-chu', 'Admin\Dashboard@index');

    // manager accounts
    Route::get('/manager-accounts', 'Admin\ManagerAccounts@index');
    Route::get('/manager-accounts/delete/{id}', 'Admin\ManagerAccounts@delete');
    Route::get('/manager-accounts/editer/{id}/{username}', 'Admin\ManagerAccounts@editer');
    Route::post('/manager-accounts/editer', 'Admin\ManagerAccounts@update');
    Route::post('/manager-accounts', 'Admin\ManagerAccounts@createAccount');
    // delete checked 
    Route::post('/manager-accounts/deletes-checked', 'Admin\ManagerAccounts@deletes_checked');

    // change roles
    Route::get('/change-roles', 'Admin\ChangesRole@changeRole');
    // Route::get('/change-roles/editer/{id}/{name}', 'Admin\ChangesRole@editer');
    // Route::post('/change-roles/update', 'Admin\ChangesRole@update');

    // managers auth post
    Route::get('/auth-posts', 'Admin\AuthPosts@index');
    Route::get('/auth-posts/editer/{id}/{slug}', 'Admin\AuthPosts@editer');
    Route::post('/auth-post/update', 'Admin\AuthPosts@update');
    Route::post('/auth-posts/deletes-checked', 'Admin\AuthPosts@deletes_checked');
    Route::get('/auth-posts/delete/{id}', 'Admin\AuthPosts@delete');


    // auth post unapproval 
    Route::get('/auth-posts-unapproval', 'Admin\AuthPostsUnapproval@index');
    Route::get('/auth-posts-unapproval/editer/{id}/{slug}', 'Admin\AuthPostsUnapproval@editer');
    Route::post('/auth-posts-unapproval/update', 'Admin\AuthPostsUnapproval@update');
    Route::get('/auth-posts-unapproval/delete/{id}', 'Admin\AuthPostsUnapproval@delete');
    Route::post('/auth-posts-unapproval/deletes-checked', 'Admin\AuthPostsUnapproval@deletes_checked');

    // Approval articles
    Route::get('/approval-articles', 'Admin\ApprovalArticles@index');
    Route::get('/approval-articles/editer/{id}/{slug}', 'Admin\ApprovalArticles@editer');
    Route::post('/approval-articles/update', 'Admin\ApprovalArticles@update');
    Route::get('/approval-articles/delete/{id}', 'Admin\ApprovalArticles@delete');
    Route::post('/approval-articles/deletes-checked', 'Admin\ApprovalArticles@deletes_checked');


    // unapproval articles
    Route::get('/unapproval-articles', 'Admin\UnapprovalArticles@index');
    Route::get('/unapproval-articles/editer/{id}/{slug}', 'Admin\UnapprovalArticles@editer');
    Route::post('/unapproval-articles/update', 'Admin\UnapprovalArticles@update');
    Route::get('/unapproval-articles/active/{id}/{slug}', 'Admin\UnapprovalArticles@active');
    Route::get('/unapproval-articles/delete/{id}', 'Admin\UnapprovalArticles@delete');
    Route::post('/unapproval-articles/deletes-checked', 'Admin\UnapprovalArticles@deletes_checked');


    // auth posts comments
    Route::get('/auth-posts-comments', 'Admin\AuthPostsComments@index');
    Route::get('/auth-posts-comments/delete/{id}', 'Admin\AuthPostsComments@delete');
    Route::get('/auth-posts-comments/view/{id}', 'Admin\AuthPostsComments@view_list_comments');


    // list comments
    Route::get('/list-comments', 'Admin\ListComments@index');
    Route::get('/list-comments/delete/{id}', 'Admin\ListComments@delete');
    Route::get('/list-comments/view/{id}', 'Admin\ListComments@view_list_comments');
    Route::post('/list-comments/view/deletes-checked', 'Admin\ListComments@deletes_checked');

    // list category
    Route::get('/list-category', 'Admin\ListCategory@index');
    Route::post('/list-category/create', 'Admin\ListCategory@create');
    Route::get('/list-category/editer/{id}/{slug}', 'Admin\ListCategory@editor');
    Route::post('/list-category/editer', 'Admin\ListCategory@update');
    Route::get('/list-category/delete/{id}', 'Admin\ListCategory@delete');
    Route::post('/list-category/deletes-checked', 'Admin\ListCategory@deletes_checked');

    // created post
    Route::get('/create-post', 'Admin\Posts@index');
    Route::post('/create-post', 'Admin\Posts@createPost');

    // subscribe
    Route::get('/subscribe', 'Admin\Subscribe@index');
    Route::post('/subscribe/deletes-checked', 'Admin\Subscribe@deletes_checked');

    // information admin
    Route::get('/admin-info', 'Admin\AdminInfo@index');
});