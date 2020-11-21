@extends('layouts.app')
@section('title', 'Bài viết cá nhân')

@section('content')
<section class="bg-accent border-bottom add-top-margin">
    <div class="container">
        <div class="row no-gutters d-flex align-items-center">
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <div class="topic-box topic-box-margin">Tin tức hot nhất</div>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-6">
                <div class="feeding-text-dark">
                    <ol id="sample" class="ticker">
                        @foreach ($posts as $item)
                        <li>
                            <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- News Feed Area End Here -->
<!-- News Info List Area Start Here -->
<section class="bg-body">
    <div class="container">
        <ul class="news-info-list text-center--md">
            <li>
                <i class="fa fa-map-marker" aria-hidden="true"></i>Vietnamese
            </li>
            <li>
                <i class="fa fa-calendar" aria-hidden="true"></i><span id="current_date"></span>
            </li>
            <li>
                <i class="fa fa-clock-o" aria-hidden="true"></i><span id="current_time"></span>
            </li>
            <li>
                <i class="fa fa-cloud" aria-hidden="true"></i>29&#8451; Hoa Khanh, Da Nang
            </li>
        </ul>
    </div>
</section>
<!-- News Info List Area End Here -->
<!-- Breadcrumb Area Start Here -->
<section class="breadcrumbs-area"
    style="background-image: url('{{asset('clients/img/banner/breadcrumbs-banner.jpg')}}');">
    <div class="container">
        <div class="breadcrumbs-content">
            <h1>Bài viết cá nhân</h1>
            <ul>
                <li>
                    <a href="{{url('/')}}">Trang chủ</a> -
                </li>
                <li>Bài viết cá nhân</li>
            </ul>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End Here -->
<!-- Author Post Page Area Start Here -->
<section class="bg-body section-space-less30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="bg-accent p-35-r mb-50 item-shadow-1">
                    <div class="media media-none-xs">
                        <img src="{{asset('clients/img/author.jpg')}}" alt="author" class="img-fluid rounded-circle">
                        <div class="media-body pt-10 media-margin30">
                            @if ($user->id === Auth::user()->id)
                            <a href="{{url('/user-edit')}}" class="mb-5"
                                style="font-size: 0.75em; color: #007bff; text-decoration: none">Chỉnh sửa</a>
                            @endif
                            <div class="post-by mb-5">By {{$user->username}}</div>
                            <p class="mb-15">Email: {{$user->email}}</p>
                            <ul class="author-social-style1 item-inline">
                                <li>
                                    <a href="#" title="facebook">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="twitter">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="google-plus">
                                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="linkedin">
                                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="pinterest">
                                        <i class="fa fa-pinterest" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($news_posts as $item)
                    <div class="col-sm-6 col-12">
                        <div class="mb-30">
                            <div class="position-relative mb-20">
                                <a class="img-opacity-hover" href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">
                                    <img src="{{url('/')}}{{$item->image}}" alt="news"
                                        class="img-fluid-auth-post width-100">
                                </a>
                                <div class="topic-box-top-xs">
                                    <div class="topic-box-sm color-cod-gray mb-20">{{$item->category->category}}</div>
                                </div>
                            </div>
                            <div class="post-date-dark">
                                <ul>
                                    <li>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>{{$item->created_at}}
                                    </li>
                                </ul>
                            </div>
                            <h3 class="title-medium-dark size-lg mb-none">
                                <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}} </a>
                            </h3>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row mt-20-r mb-30">
                    <div class="col-sm-6 col-12">
                        {{$news_posts->links()}}
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="pagination-result text-right pt-10 text-center--xs">
                            <p class="mb-none">Trang
                                {{$news_posts->currentPage()}}/{{$news_posts->lastPage()}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ne-sidebar sidebar-break-md col-lg-4 col-md-12">
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">mạng xã hội</div>
                    </div>
                    <ul class="stay-connected overflow-hidden">
                        <li class="facebook">
                            <a href="#">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                                <div class="connection-quantity">50.2 k</div>
                                <p>Fans</p>
                            </a>
                        </li>
                        <li class="twitter">
                            <a href="#">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                                <div class="connection-quantity">10.3 k</div>
                                <p>Followers</p>
                            </a>
                        </li>
                        <li class="linkedin">
                            <a href="#">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                                <div class="connection-quantity">25.4 k</div>
                                <p>Fans</p>
                            </a>
                        </li>
                        <li class="rss">
                            <a href="#">
                                <i class="fa fa-rss" aria-hidden="true"></i>
                                <div class="connection-quantity">20.8 k</div>
                                <p>Subscriber</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-box">
                    <div class="ne-banner-layout1 text-center">
                        <a href="#">
                            <img src="{{asset('clients/img/banner/banner3.jpg')}}" alt="ad" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Tin tức mới</div>
                    </div>
                    <div class="newsletter-area bg-primary">

                        <img src="{{url('clients')}}/img/banner/newsletter.png" alt="newsletter"
                            class="img-fluid m-auto mb-15">
                        <p>Đăng ký để nhận được thông báo sớm nhất </p>
                        <div class="input-group stylish-input-group">
                            <input type="text" placeholder="Nhập email của bạn" class="form-control">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Author Post Page Area End Here -->
@endsection