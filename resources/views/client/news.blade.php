@extends('layouts.app')
@section('title', 'Tin tức')

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
<!-- Breadcrumb Area Start Here -->
<section class="breadcrumbs-area">
    <div class="container">
        <div class="breadcrumbs-content">
            <h1>Tin tức</h1>
            <ul>
                <li>
                    <a href="index.html">Trang chủ</a> -
                </li>
                <li>Tin tức</li>
            </ul>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End Here -->
<!-- Archive Page Area Start Here -->
<section class="bg-body section-space-less30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <form id="archive-search" class="archive-search-box bg-accent item-shadow-1">
                    <div class="row tab-space5">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <div class="ne-custom-select" id="year">
                                    <select name="year">
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <div class="ne-custom-select" id="month">
                                    <select name="month">
                                        <option value="1">Tháng 1</option>
                                        <option value="2">Tháng 2</option>
                                        <option value="3">Tháng 3</option>
                                        <option value="4">Tháng 4</option>
                                        <option value="5">Tháng 5</option>
                                        <option value="6">Tháng 6</option>
                                        <option value="7">Tháng 7</option>
                                        <option value="8">Tháng 8</option>
                                        <option value="9">Tháng 9</option>
                                        <option value="10">Tháng 10</option>
                                        <option value="11">Tháng 11</option>
                                        <option value="12">Tháng 12</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <div class="ne-custom-select" id="category">
                                    <select name="category">
                                        @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-right">
                            <button id="button-search" type="button"
                                class="btn-ftg-ptp-40 disabled mb-5">Search</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    @foreach ($getposts as $item)
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="media media-none--lg mb-30">
                            <div class="position-relative width-40">
                                <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}"
                                    class="img-opacity-hover img-overlay-70">
                                    <img src="{{url('/')}}{{$item->image}}" alt="news" class="img-fluid-news">
                                </a>
                                <div class="topic-box-top-xs">
                                    <div class="topic-box-sm color-cod-gray mb-20">{{$item->category->category}}</div>
                                </div>
                            </div>
                            <div class="media-body p-mb-none-child media-margin30">
                                <div class="post-date-dark">
                                    <ul>
                                        <li>
                                            <span>Bởi </span>
                                            <a
                                                href="{{url('/auth-posts')}}/{{$item->user->id}}/{{$item->user->username}}">{{$item->user->username}}</a>
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>{{$item->created_at}}
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="title-semibold-dark size-lg mb-15">
                                    <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
                                </h3>
                                <p>{{$item->description}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row mt-20-r mb-30">
                    <div class="col-sm-6 col-12">
                        {{$getposts->links()}}
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="pagination-result text-right pt-10 text-center--xs">
                            <p class="mb-none">Trang {{$getposts->currentPage()}} of {{$getposts->lastPage()}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ne-sidebar sidebar-break-md col-lg-4 col-md-12">
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Archives</div>
                    </div>
                    <ul class="archive-list">

                        <li>
                            <a href="#">Tháng 2 2020 (1)</a>
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
                        <div class="topic-box-lg color-cod-gray">Newsletter</div>
                    </div>
                    <div class="newsletter-area bg-primary">
                        <img src="{{asset('clients/img/banner/newsletter.png')}}" alt="newsletter"
                            class="img-fluid m-auto mb-15">
                        <p>Đăng kí để nhận được thông tin mới nhất</p>
                        <div class="input-group stylish-input-group">
                            <input type="email" placeholder="Nhập địa chỉ email" class="form-control">
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
<!-- Archive Page Area End Here -->
@endsection
@section('script')
<script src="{{asset('clients/js/posts.js')}}"></script>
@endsection