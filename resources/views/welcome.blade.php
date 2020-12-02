@extends('layouts.app')
@section('title', 'Trang chủ')
@section('content')
<!-- News Feed Area Start Here -->
<section class="bg-accent border-bottom add-top-margin">
    <div class="container">
        <div class="row no-gutters d-flex align-items-center">
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <div class="topic-box topic-box-margin">Tin tức hot nhất</div>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-6">
                <div class="feeding-text-dark">
                    <ol id="sample" class="ticker">
                        @foreach($news_hot as $item_hot)
                        <li>
                            <a href="{{url('/posts')}}/{{$item_hot->id}}/{{$item_hot->slug}}">{{$item_hot->title}}</a>
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
<!-- News Slider Area Start Here -->
<section class="bg-accent section-space-less2">
    <div class="container">
        <div class="row tab-space1">
            @foreach ($news_four_top_1 as $item)
            <div class="col-lg-6 col-md-12">
                <div class="img-overlay-70 img-scale-animate mb-2">
                    <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-top-1 width-100">
                    <div class="mask-content-lg">
                        <div class="topic-box-sm color-cinnabar mb-20">{{$item->category->category}}</div>
                        <h1 class="title-medium-light">
                            <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                        </h1>
                        <div class="post-date-light">
                            <ul>

                                <li>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>{{$item->created_at}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @foreach ($news_four_top_2 as $item)
            <div class="col-lg-6 col-md-12">
                <div class="row tab-space1">
                    <div class="col-12">
                        <div class="img-overlay-70 img-scale-animate mb-2">
                            <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-top-2 width-100">
                            <div class="mask-content-lg">
                                <div class="topic-box-sm color-azure-radiance mb-20">{{$item->category->category}}</div>
                                <h1 class="title-medium-light">
                                    <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                                </h1>
                                <div class="post-date-light">
                                    <ul>

                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>{{$item->created_at}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($news_four_top_3 as $item)
                    <div class="col-sm-6 col-12">
                        <div class="img-overlay-70 img-scale-animate mb-2">
                            <div class="mask-content-sm">
                                <div class="topic-box-sm color-apple mb-10">{{$item->category->category}}</div>
                                <h3 class="title-medium-light">
                                    <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                                </h3>
                                <div class="post-date-light">
                                    <ul>

                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>{{$item->created_at}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-top-3 width-100">
                        </div>
                    </div>
                    @endforeach
                    @foreach ($news_four_top_4 as $item)
                    <div class="col-sm-6 col-12">
                        <div class="img-overlay-70 img-scale-animate mb-2">
                            <div class="mask-content-sm">
                                <div class="topic-box-sm color-razzmatazz mb-10">{{$item->category->category}}</div>
                                <h3 class="title-medium-light">
                                    <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                                </h3>
                                <div class="post-date-light">
                                    <ul>

                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>{{$item->created_at}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-top-4 width-100">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- News Slider Area End Here -->
<!-- Top Story Area Start Here -->
<section class="bg-body section-space-default">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="mb-20-r ne-isotope">
                    <div class="topic-border color-cinnabar mb-30">
                        <div class="topic-box-lg color-cinnabar">Bài viết nổi bật</div>
                        <div class="isotope-classes-tab isotop-btn">
                            @if($category_current != null)
                            <a href="#" data-filter=".item{{$category_current->id}}"
                                class="current">{{$category_current->category}}</a>
                            @endif
                            @foreach ($categories_not1 as $category)
                            @if($category->news != null)
                            <a href="#" data-filter=".item{{$category->id}}">{{$category->category}}</a>
                            @endif
                            @endforeach

                        </div>
                        <div class="more-info-link">
                            <a href="{{url('/news')}}">Thêm
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    <div class="featuredContainer">
                        @if($category_current != null)
                        <div class="row item{{$category_current->id}}">
                            <div class="col-md-6 col-sm-12">
                                <div class="img-overlay-70 img-scale-animate mb-30">
                                    <a
                                        href="{{url('posts')}}/{{$post_category_current->id}}/{{$post_category_current->slug}}">
                                        <img src="{{url('/')}}{{$post_category_current->image}}" alt="news"
                                            class="img-fluid width-100">
                                    </a>

                                    <div class="mask-content-lg">
                                        <div class="topic-box-sm color-cinnabar mb-20">
                                            {{$category_current->category}}
                                        </div>
                                        <h2 class="title-medium-light size-lg">
                                            <a
                                                href="{{url('posts')}}/{{$post_category_current->id}}/{{$post_category_current->slug}}">{{$post_category_current->title}}</a>
                                        </h2>
                                        <div class="post-date-light">
                                            <ul>

                                                <li>
                                                    <span>
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>{{$post_category_current->created_at}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                @foreach ($post_four_category_current as $key => $item)
                                @if($key > 0)
                                <div class="media mb-30">
                                    <a class="width38-lg width40-md img-opacity-hover"
                                        href="{{url('posts')}}/{{$item->id}}/{{$item->slug}}">
                                        <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid">
                                    </a>
                                    <div class="media-body">
                                        <div class="post-date-dark">
                                            <ul>
                                                <li>
                                                    <span>
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>{{$item->created_at}}</li>
                                            </ul>
                                        </div>
                                        <h3 class="title-medium-dark size-md mb-none">
                                            <a
                                                href="{{url('posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                                        </h3>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endif
                        {{-- end item curren  --}}

                        @foreach ($categories_not1 as $cate)
                        @if($cate->news != null)
                        @php
                        $post_four = App\Models\News::with('category')->with('user')->where('category_id',
                        $cate->id)->take(4)->get();
                        @endphp
                        <div class="row item{{$cate->id }}">
                            <div class="col-md-6 col-sm-12">
                                <div class="img-overlay-70 img-scale-animate mb-30">
                                    <a href="{{url('posts')}}/{{$cate->news->id}}/{{$cate->news->slug}}">
                                        <img src="{{url('/')}}{{$cate->news->image}}" alt="news"
                                            class="img-fluid width-100">
                                    </a>

                                    <div class="mask-content-lg">
                                        <div class="topic-box-sm color-azure-radiance mb-20">
                                            {{$cate->category}}</div>
                                        <div class="post-date-light">
                                            <ul>

                                                <li>
                                                    <span>
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>{{$cate->news->created_at}}</li>
                                            </ul>
                                        </div>
                                        <h2 class="title-medium-light size-lg">
                                            <a
                                                href="{{url('posts')}}/{{$cate->news->id}}/{{$cate->news->slug}}">{{$cate->news->title}}</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                @foreach ($post_four as $item_sub)
                                @if ($cate->id == $item_sub->category_id)
                                @if ($key > 0)
                                <div class="media mb-30">
                                    <a class="width38-lg width40-md img-opacity-hover"
                                        href="{{url('posts')}}/{{$item_sub->id}}/{{$item_sub->slug}}">
                                        <img src="{{url('/')}}{{$item_sub->image}}" alt="news" class="img-fluid">
                                    </a>
                                    <div class="media-body">
                                        <div class="post-date-dark">
                                            <ul>
                                                <li>
                                                    <span>
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>{{$item_sub->created_at}}</li>
                                            </ul>
                                        </div>
                                        <h3 class="title-medium-dark size-md mb-none">
                                            <a
                                                href="{{url('posts')}}/{{$item_sub->id}}/{{$item_sub->slug}}">{{$item_sub->title}}</a>
                                        </h3>
                                    </div>
                                </div>
                                @endif
                                @endif
                                @endforeach

                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>
                <div class="row tab-space1 mb-25">
                    <div class="col-12">
                        <div class="topic-border color-apple mb-30 width-100">
                            <div class="topic-box-lg color-apple">Bài viết mới</div>
                        </div>
                    </div>

                    @foreach ($life_style as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                        <div class="img-overlay-70 img-scale-animate mb-2">
                            <div class="mask-content-xs">
                                <div class="post-date-light">
                                    <ul>
                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>{{$item->created_at}}</li>
                                    </ul>
                                </div>
                                <h3 class="title-medium-light">
                                    <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}} </a>
                                </h3>
                            </div>
                            <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-life-style width-100">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="ne-sidebar sidebar-break-md col-lg-4 col-md-12">
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Mạng xã hội</div>
                    </div>
                    <ul class="stay-connected overflow-hidden">
                        <li class="facebook">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                            <div class="connection-quantity">50.2 k</div>
                            <p>Fans</p>
                        </li>
                        <li class="twitter">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                            <div class="connection-quantity">10.3 k</div>
                            <p>Followers</p>
                        </li>
                        <li class="linkedin">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                            <div class="connection-quantity">25.4 k</div>
                            <p>Fans</p>
                        </li>
                        <li class="rss">
                            <i class="fa fa-rss" aria-hidden="true"></i>
                            <div class="connection-quantity">20.8 k</div>
                            <p>Subscriber</p>
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
                    <div class="topic-border color-scampi mb-5">
                        <div class="topic-box-lg color-scampi">Tin mới nhất</div>
                    </div>
                    <div class="row rencent-news">
                        @foreach ($recent_news as $item)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="mt-25">
                                <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}" class="img-opacity-hover">
                                    <img src="{{url('/')}}{{$item->image}}" alt="ad" class="img-fluid mb-10 width-100">
                                </a>
                                <h3 class="title-medium-dark size-md mb-none">
                                    <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                                </h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ne-banner-layout1 mt-20-r text-center">
                    <a href="#">
                        <img src="{{asset('clients/img/banner/banner2.jpg')}}" alt="ad" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Top Story Area End Here -->

<!-- Latest News Area Start Here -->
<section class="bg-body section-space-less30">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                @foreach ($news_three_top_1 as $item)
                <div class="topic-border color-cutty-sark mb-30 width-100">
                    <div class="topic-box-lg color-cutty-sark">{{$item->category->category}}</div>
                </div>
                <div class="img-overlay-70 img-scale-animate mb-30">
                    <div class="mask-content-sm">
                        <div class="post-date-light">
                            <ul>

                                <li>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>{{$item->created_at}}
                                </li>
                            </ul>
                        </div>
                        <h3 class="title-medium-light">
                            <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                        </h3>
                    </div>
                    <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-three-top-1 width-100">
                </div>
                @endforeach
                @foreach ($post_1_in_three as $key => $item)
                @if($key > 0)
                <div class="media mb-30">
                    <a class="img-opacity-hover" href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">
                        <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-sub-three-top-1">
                    </a>
                    <div class="media-body">
                        <div class="post-date-dark">
                            <ul>
                                <li>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>{{$item->created_at}}
                                </li>
                            </ul>
                        </div>
                        <h3 class="title-medium-dark size-md mb-none">
                            <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                        </h3>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="col-lg-4 col-md-12">
                @foreach ($news_three_top_2 as $item)
                <div class="topic-border color-web-orange mb-30 width-100">
                    <div class="topic-box-lg color-web-orange">{{$item->category->category}}</div>
                </div>
                <div class="img-overlay-70 img-scale-animate mb-30">
                    <div class="mask-content-sm">
                        <div class="post-date-light">
                            <ul>

                                <li>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>{{$item->created_at}}
                                </li>
                            </ul>
                        </div>
                        <h3 class="title-medium-light">
                            <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                        </h3>
                    </div>
                    <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-three-top-1 width-100">
                </div>
                @endforeach
                @foreach ($post_2_in_three as $key => $item)
                @if($key > 0)
                <div class="media mb-30">
                    <a class="img-opacity-hover" href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">
                        <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-sub-three-top-1">
                    </a>
                    <div class="media-body">
                        <div class="post-date-dark">
                            <ul>
                                <li>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>{{$item->created_at}}
                                </li>
                            </ul>
                        </div>
                        <h3 class="title-medium-dark size-md mb-none">
                            <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                        </h3>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="col-lg-4 col-md-12">
                @foreach ($news_three_top_3 as $item)
                <div class="topic-border color-cutty-sark mb-30 width-100">
                    <div class="topic-box-lg color-cutty-sark">{{$item->category->category}}</div>
                </div>
                <div class="img-overlay-70 img-scale-animate mb-30">
                    <div class="mask-content-sm">
                        <div class="post-date-light">
                            <ul>

                                <li>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>{{$item->created_at}}
                                </li>
                            </ul>
                        </div>
                        <h3 class="title-medium-light">
                            <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                        </h3>
                    </div>
                    <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-three-top-1 width-100">
                </div>
                @endforeach
                @foreach ($post_3_in_three as $key => $item)
                @if($key > 0)
                <div class="media mb-30">
                    <a class="img-opacity-hover" href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">
                        <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-sub-three-top-1">
                    </a>
                    <div class="media-body">
                        <div class="post-date-dark">
                            <ul>
                                <li>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>{{$item->created_at}}
                                </li>
                            </ul>
                        </div>
                        <h3 class="title-medium-dark size-md mb-none">
                            <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                        </h3>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ne-banner-layout1 mb-50 mt-20-r text-center">
                    <a href="#">
                        <img src="{{asset('clients/img/banner/banner2.jpg')}}" alt="ad" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Latest News Area End Here -->
<!-- More News Area Start Here -->
<section class="bg-accent section-space-less30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="ne-isotope">
                    <div class="topic-border color-scampi mb-30">
                        <div class="topic-box-lg color-scampi">Tin tức khác</div>
                        <div class="isotope-classes-tab isotop-btn">
                            @if($category_current != null)
                            <a href="#" data-filter=".item{{$category_current->id}}"
                                class="current">{{$category_current->category}}</a>
                            @endif
                            @foreach ($categories_not1 as $category)
                            @if($category->news != null)
                            <a href="#" data-filter=".item{{$category->id}}">{{$category->category}}</a>
                            @endif
                            @endforeach
                        </div>
                        <div class="more-info-link">
                            <a href="{{url('/news')}}">Thêm
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="featuredContainer">
                        @if($category_current != null)
                        <div class="row item{{$category_current->id}}">
                            @foreach ($post_other_news_current as $item)
                            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                                <div class="media media-none--lg mb-30">
                                    <div class="position-relative">
                                        <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}"
                                            class="img-opacity-hover">
                                            <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid">
                                        </a>
                                        <div class="topic-box-top-xs">
                                            <div class="topic-box-sm color-cinnabar mb-20">{{$item->category->category}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="media-body p-mb-none-child media-margin30">
                                        <div class="post-date-dark">
                                            <ul>

                                                <li>
                                                    <span>
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>{{$item->created_at}}
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="title-semibold-dark size-lg mb-15">
                                            <a
                                                href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                                        </h3>
                                        <p>{{$item->description}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @foreach ($categories_not1 as $item_cate)
                        @if($item_cate->news != null)
                        @php
                        $post_other_news = App\Models\News::where('category_id',$item_cate->id)->take(5)->get();
                        @endphp
                        @foreach ($post_other_news as $item)
                        @if ($item->category_id == $item_cate->id)
                        <div class="row item{{$item_cate->id}}">
                            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                                <div class="media media-none--lg mb-30">
                                    <div class="position-relative">
                                        <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}"
                                            class="img-opacity-hover">
                                            <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid">
                                        </a>
                                        <div class="topic-box-top-xs">
                                            <div class="topic-box-sm color-cinnabar mb-20">{{$item->category->category}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="media-body p-mb-none-child media-margin30">
                                        <div class="post-date-dark">
                                            <ul>

                                                <li>
                                                    <span>
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>{{$item->created_at}}
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="title-semibold-dark size-lg mb-15">
                                            <a
                                                href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                                        </h3>
                                        <p>{{$item->description}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <p>Not data</p>
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="ne-sidebar sidebar-break-md col-lg-4 col-md-12">
                <div class="sidebar-box">
                    <div class="ne-banner-layout1 text-center">
                        <a href="#">
                            <img src="{{asset('clients/img/banner/banner6.jpg')}}" alt="ad" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Tin mới nhất</div>
                    </div>
                    <div class="newsletter-area bg-primary">
                        <img src="{{asset('clients/img/banner/newsletter.png')}}" alt="newsletter"
                            class="img-fluid mb-40">
                        <p>Đăng ký để nhận được thông báo sớm nhất</p>
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
<!-- More News Area End Here -->


@endsection