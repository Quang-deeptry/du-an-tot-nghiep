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
                        <li>
                            <a href="#">list new hot</a>
                        </li>
                        <li>
                            <a href="#"></a>
                        </li>
                        <li>
                            <a href="#"></a>
                        </li>
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
                                <div class="ne-custom-select">
                                    <select name="year">
                                        <option value="0">Chọn năm</option>
                                        <option value="1">2019</option>
                                        <option value="2">2020</option>
                                        <option value="3">2021</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="form-group">
                                <div class="ne-custom-select">
                                    <select name="month">
                                        <option value="0">Chọn tháng</option>
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
                                <div class="ne-custom-select">
                                    <select name="category">
                                        <option value="0">Chọn thể loại</option>
                                        <option value="1">Du lịch</option>
                                        <option value="2">Thời trang</option>
                                        <option value="3">Sức khỏe</option>
                                        <option value="4">Thể thao</option>
                                        <option value="5">Âm nhạc</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-right">
                            <button type="submit" class="btn-ftg-ptp-40 disabled mb-5">Search</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="media media-none--lg mb-30">
                            <div class="position-relative width-40">
                                <a href="single-news-1.html" class="img-opacity-hover img-overlay-70">
                                    <img src="{{asset('Clients/img/news/news140.jpg')}}" alt="news" class="img-fluid">
                                </a>
                                <div class="topic-box-top-xs">
                                    <div class="topic-box-sm color-cod-gray mb-20">Football</div>
                                </div>
                            </div>
                            <div class="media-body p-mb-none-child media-margin30">
                                <div class="post-date-dark">
                                    <ul>
                                        <li>
                                            <span>by</span>
                                            <a href="single-news-1.html">Adams</a>
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>March 22, 2017
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="title-semibold-dark size-lg mb-15">
                                    <a href="single-news-1.html">Erik Jones has day he won’t soon forget as Denny backup
                                        at Bristol</a>
                                </h3>
                                <p>Separated they live in the coast of the Semantics, a large language ocean. A
                                    river named Duden flows by their place and ...
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="media media-none--lg mb-30">
                            <div class="position-relative width-40">
                                <a href="single-news-1.html" class="img-opacity-hover img-overlay-70">
                                    <img src="{{asset('Clients/img/news/news141.jpg')}}" alt="news" class="img-fluid">
                                </a>
                                <div class="topic-box-top-xs">
                                    <div class="topic-box-sm color-cod-gray mb-20">Adventure</div>
                                </div>
                            </div>
                            <div class="media-body p-mb-none-child media-margin30">
                                <div class="post-date-dark">
                                    <ul>
                                        <li>
                                            <span>by</span>
                                            <a href="single-news-1.html">Adams</a>
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>March 22, 2017
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="title-semibold-dark size-lg mb-15">
                                    <a href="single-news-1.html">Erik Jones has day he won’t soon forget as Denny backup
                                        at Bristol</a>
                                </h3>
                                <p>Separated they live in the coast of the Semantics, a large language ocean. A
                                    river named Duden flows by their place and ...
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="media media-none--lg mb-30">
                            <div class="position-relative width-40">
                                <a href="single-news-1.html" class="img-opacity-hover img-overlay-70">
                                    <img src="{{asset('Clients/img/news/news142.jpg')}}" alt="news" class="img-fluid">
                                </a>
                                <div class="topic-box-top-xs">
                                    <div class="topic-box-sm color-cod-gray mb-20">Food</div>
                                </div>
                            </div>
                            <div class="media-body p-mb-none-child media-margin30">
                                <div class="post-date-dark">
                                    <ul>
                                        <li>
                                            <span>by</span>
                                            <a href="single-news-1.html">Adams</a>
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>March 22, 2017
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="title-semibold-dark size-lg mb-15">
                                    <a href="single-news-1.html">Erik Jones has day he won’t soon forget as Denny backup
                                        at Bristol</a>
                                </h3>
                                <p>Separated they live in the coast of the Semantics, a large language ocean. A
                                    river named Duden flows by their place and ...
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="media media-none--lg mb-30">
                            <div class="position-relative width-40">
                                <a href="single-news-1.html" class="img-opacity-hover img-overlay-70">
                                    <img src="{{asset('Clients/img/news/news143.jpg')}}" alt="news" class="img-fluid">
                                </a>
                                <div class="topic-box-top-xs">
                                    <div class="topic-box-sm color-cod-gray mb-20">Race</div>
                                </div>
                            </div>
                            <div class="media-body p-mb-none-child media-margin30">
                                <div class="post-date-dark">
                                    <ul>
                                        <li>
                                            <span>by</span>
                                            <a href="single-news-1.html">Adams</a>
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>March 22, 2017
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="title-semibold-dark size-lg mb-15">
                                    <a href="single-news-1.html">Erik Jones has day he won’t soon forget as Denny backup
                                        at Bristol</a>
                                </h3>
                                <p>Separated they live in the coast of the Semantics, a large language ocean. A
                                    river named Duden flows by their place and ...
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="media media-none--lg mb-30">
                            <div class="position-relative width-40">
                                <a href="single-news-1.html" class="img-opacity-hover img-overlay-70">
                                    <img src="{{asset('Clients/img/news/news144.jpg')}}" alt="news" class="img-fluid">
                                </a>
                                <div class="topic-box-top-xs">
                                    <div class="topic-box-sm color-cod-gray mb-20">Corporate</div>
                                </div>
                            </div>
                            <div class="media-body p-mb-none-child media-margin30">
                                <div class="post-date-dark">
                                    <ul>
                                        <li>
                                            <span>by</span>
                                            <a href="single-news-1.html">Adams</a>
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>March 22, 2017
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="title-semibold-dark size-lg mb-15">
                                    <a href="single-news-1.html">Erik Jones has day he won’t soon forget as Denny backup
                                        at Bristol</a>
                                </h3>
                                <p>Separated they live in the coast of the Semantics, a large language ocean. A
                                    river named Duden flows by their place and ...
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                        <div class="media media-none--lg mb-30">
                            <div class="position-relative width-40">
                                <a href="single-news-1.html" class="img-opacity-hover img-overlay-70">
                                    <img src="img/news/news145.jpg" alt="news" class="img-fluid">
                                </a>
                                <div class="topic-box-top-xs">
                                    <div class="topic-box-sm color-cod-gray mb-20">People</div>
                                </div>
                            </div>
                            <div class="media-body p-mb-none-child media-margin30">
                                <div class="post-date-dark">
                                    <ul>
                                        <li>
                                            <span>by</span>
                                            <a href="single-news-1.html">Adams</a>
                                        </li>
                                        <li>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>March 22, 2017
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="title-semibold-dark size-lg mb-15">
                                    <a href="single-news-1.html">Erik Jones has day he won’t soon forget as Denny backup
                                        at Bristol</a>
                                </h3>
                                <p>Separated they live in the coast of the Semantics, a large language ocean. A
                                    river named Duden flows by their place and ...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-20-r mb-30">
                    <div class="col-sm-6 col-12">
                        <div class="pagination-btn-wrapper text-center--xs mb15--xs">
                            <ul>
                                <li class="active">
                                    <a href="#">1</a>
                                </li>
                                <li>
                                    <a href="#">2</a>
                                </li>
                                <li>
                                    <a href="#">3</a>
                                </li>
                                <li>
                                    <a href="#">4</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="pagination-result text-right pt-10 text-center--xs">
                            <p class="mb-none">Page 1 of 4</p>
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