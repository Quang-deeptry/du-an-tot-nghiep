@extends('layouts.app')
@section('title', $title)

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
<section class="breadcrumbs-area2">
    <div class="container">
        <div class="breadcrumbs-content">
            <h1>{{$news_post_detail->category->category}}</h1>
            <ul>
                <li>
                    <a href="{{url('/')}}">Trang chủ</a> -
                </li>
                <li>
                    <a href="#">{{$news_post_detail->category->category}}</a> -
                </li>
                <li>{{$news_post_detail->title}}</li>
            </ul>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End Here -->
<!-- News Details Page Area Start Here -->
<section class="bg-body section-space-less30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="news-details-layout3 mb-30">
                    <div class="position-relative mb-30">
                        <img src="{{url('/')}}{{$news_post_detail->image}}" alt="news-details"
                            class="img-fluid-post-detail">
                        <div class="topic-box-top-sm">
                            <div class="topic-box-sm color-cinnabar mb-20">{{$news_post_detail->category->category}}
                            </div>
                        </div>
                    </div>
                    <h2 class="title-semibold-dark size-c30">{{$news_post_detail->title}}</h2>
                    <ul class="post-info-dark mb-30">
                        <li>
                            <a href="{{url('/auth-posts')}}/{{$news_post_detail->user->username}}">
                                <span>Bởi </span>{{$news_post_detail->user->username}} </a>
                        </li>
                        <li>
                            <a href="#current_time">
                                <i class="fa fa-calendar" aria-hidden="true"></i>{{$news_post_detail->created_at}}</a>
                        </li>
                        <li>
                            <a href="#current_time">
                                <i class="fa fa-eye" aria-hidden="true"></i>{{$news_post_detail->views_count}}</a>
                        </li>
                        <li>
                            <a href="#fa-comments">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                                <span class="count_comment"></span></a>
                        </li>
                    </ul>
                    <p>
                        {!! $news_post_detail->content !!}
                    </p>
                    <ul class="blog-tags item-inline">
                        <li>Thể loại</li>
                        <li>
                            <a
                                href="{{url('category')}}/{{$news_post_detail->category->id}}/{{$news_post_detail->category->slug}}">#{{$news_post_detail->category->category}}
                            </a>
                        </li>
                    </ul>
                    <div class="post-share-area mb-40 item-shadow-1">
                        <p>Bạn có thể chia sẻ bài viết</p>
                        <ul class="social-default item-inline">
                            <li>
                                <a href="#" class="facebook">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="twitter">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="google">
                                    <i class="fa fa-google-plus" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="pinterest">
                                    <i class="fa fa-pinterest" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="rss">
                                    <i class="fa fa-rss" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="linkedin">
                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="author-info bg-accent item-shadow-1 p-35-r mb-50">
                        <div class="media media-none-xs">
                            <img src="{{asset('clients/img/author.jpg')}}" alt="author"
                                class="img-fluid rounded-circle">
                            <div class="media-body pt-10 media-margin30">
                                <h3 class="size-lg mb-5">Tác giả</h3>
                                <div class="post-by mb-5">{{$user->username}}</div>
                                <p class="mb-15"></p>
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
                    <div class="comments-area" id="fa-comments">
                        <h2 class="title-semibold-dark size-xl border-bottom mb-40 pb-20">
                            <span class="count_comment"> </span> Bình luận </h2>
                        <ul id="res-comments">

                        </ul>
                    </div>
                    @if(Auth::guest())
                    <form class="leave-comments">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <p id="post_id">{{$news_post_detail->id}}</p>
                                </div>
                            </div>
                        </div>
                    </form>
                    @else
                    <form class="leave-comments">
                        <h2 class="title-semibold-dark size-xl mb-40">Viết bình luận</h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <p id="post_id">{{$news_post_detail->id}}</p>
                                    <textarea placeholder="Bình luận..." class="textarea form-control" id="message"
                                        rows="8" cols="20"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-none">
                                    <button type="button" id="button-sendMess" class="btn-ftg-ptp-56">
                                        Gửi bình luận
                                    </button>
                                    <button type="button" id="button-loading" class="btn-ftg-ptp-566">
                                        Đang gửi ...
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif

                </div>
            </div>
            <div class="ne-sidebar sidebar-break-md col-lg-4 col-md-12">
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Mạng xã hội</div>
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
                            <img src="{{url('clients')}}/img/banner/banner3.jpg" alt="ad" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-5">
                        <div class="topic-box-lg color-cod-gray">Tin liên quan</div>
                    </div>
                    <div class="row">
                        @foreach ($related_news as $item)
                        <div class="col-lg-6 col-md-4 col-sm-6 col-6">
                            <div class="mt-25 position-relative">
                                <div class="topic-box-top-xs">
                                    <div class="topic-box-sm color-cod-gray mb-20">{{$item->category->category}}
                                    </div>
                                </div>
                                <a href="{{url('posts')}}/{{$item->id}}/{{$item->slug}}"
                                    class="img-opacity-hover mb-10 display-block">
                                    <img src="{{url('')}}/{{$item->image}}" alt="news"
                                        class="img-fluid m-auto width-100">
                                </a>
                                <h3 class="title-medium-dark size-md mb-none">
                                    <a href="{{url('posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                                </h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Tin Tức Mới
                        </div>
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
<!-- News Details Page Area End Here -->
@endsection
@section('script')
<script src="{{asset('clients/js/post-detail.js')}}" type="text/javascript"></script>
@endsection