<?php
    use App\Models\Categories;
    use App\Models\News;

    $nav = Categories::with('news')->take(5)->get();
    $categories = Categories::with('newCount')->get();
    $top_views = News::orderBy('views_count', 'desc')->take(4)->get();
    $good_post = News::orderBy('views_count', 'desc')->limit(9)->get();
?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>NewsFlash | @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('clients/img/favicon.png')}}">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{asset('clients/css/normalize.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('clients/css/main.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('clients/css/bootstrap.min.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('clients/css/animate.min.css')}}">
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="{{asset('clients/css/font-awesome.min.css')}}">
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="{{asset('clients/vendor/OwlCarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('clients/vendor/OwlCarousel/owl.theme.default.min.css')}}">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="{{asset('clients/css/meanmenu.min.css')}}">
    <!-- Magnific CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('clients/css/magnific-popup.css')}}">
    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="{{asset('clients/css/hover-min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('clients/style.css')}}">
    <!-- For IE -->
    <link rel="stylesheet" type="text/css" href="{{asset('clients/css/ie-only.css')}}" />
    <!-- Modernizr Js -->
    <script src="{{asset('clients/js/modernizr-2.8.3.min.js')}}"></script>
    <!-- ///////// -->

</head>

<body>
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper">
        <!-- Header Area Start Here -->
        <header>
            <div id="header-layout1" class="header-style1">
                <div class="main-menu-area bg-primarytextcolor header-menu-fixed" id="sticker">
                    <div class="container">
                        <div class="row no-gutters d-flex align-items-center">
                            <div class="col-lg-2 d-none d-lg-block">
                                <div class="logo-area">
                                    <a href="{{url('/')}}">
                                        <img src="{{asset('clients/img/logo.png')}}" alt="logo" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7 position-static min-height-none">
                                <div class="ne-main-menu">
                                    <nav id="dropdown">
                                        <ul>
                                            <li class="active">
                                                <a href="{{url('/')}}">Trang chủ</a>
                                            </li>
                                            @foreach ($nav as $item)
                                            @if($item->news != null)
                                            <li>
                                                <a
                                                    href="{{url('/category')}}/{{$item->id}}/{{$item->slug}}">{{$item->category}}</a>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-12 text-right position-static">
                                <div class="header-action-item">
                                    <ul>
                                        <li>
                                            <form id="top-search-form" class="header-search-light">
                                                <input type="text" class="search-input" placeholder="Tìm kiếm...."
                                                    required="" style="display: none;">
                                                <button class="search-button">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </li>
                                        @if(Auth::guest())
                                        <li>
                                            <a href="{{ url('/login') }}" class="login-btn"></i>Đăng nhập</a>
                                        </li>
                                        @else
                                        <li>
                                            {{ Auth::user()->name }}
                                            <a href="{{ url('/logout') }}" class="login-btn"></i>Đăng xuất</a>
                                        </li>
                                        @endif
                                        <li>
                                            <div id="side-menu-trigger" class="offcanvas-menu-btn">
                                                <a href="#" class="menu-bar">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                                <a href="#" class="menu-times close">
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header Area End Here -->
        @yield('content')
        <!-- Footer Area Start Here -->
        <footer>
            <div class="footer-area-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="footer-box">
                                <h2 class="title-bold-light title-bar-left text-uppercase">Bài viết nhiều lượt xem nhất
                                </h2>
                                <ul class="most-view-post">
                                    @foreach ($top_views as $item)
                                    <li>
                                        <div class="media">
                                            <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">
                                                <img src="{{url('/')}}{{$item->image}}" alt="post" class="img-fluid">
                                            </a>
                                            <div class="media-body">
                                                <h3 class="title-medium-light size-md mb-10">
                                                    <a
                                                        href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a>
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
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-box">
                                <h2 class="title-bold-light title-bar-left text-uppercase">Danh mục phổ biến</h2>
                                <ul class="popular-categories">
                                    @foreach ($categories as $item)
                                    @if(count($item->newCount) != 0)
                                    <li>
                                        <a href="{{url('/category')}}/{{$item->id}}/{{$item->slug}}">{{$item->category}}
                                            <span>({{count($item->newCount)}})</span>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-12 col-sm-12">
                            <div class="footer-box">
                                <h2 class="title-bold-light title-bar-left text-uppercase">Bài viết hay</h2>
                                <ul class="post-gallery shine-hover ">
                                    @foreach ($good_post as $item)
                                    <li>
                                        <a href="{{url('/posts')}}/{{$item->id}}/{{$item->slug}}">
                                            <figure>
                                                <img src="{{url('/')}}{{$item->image}}" alt="post" class="img-fluid">
                                            </figure>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-area-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="{{url('/')}}" class="footer-logo img-fluid">
                                <img src="{{asset('clients/img/logo.png')}}" alt="logo" class="img-fluid">
                            </a>
                            <ul class="footer-social">
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
                                <li>
                                    <a href="#" title="rss">
                                        <i class="fa fa-rss" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="vimeo">
                                        <i class="fa fa-vimeo" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                            <p>© Website được viết bởi nhóm thực tập sinh PT14306</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->
        <!-- Modal Start-->
        <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="title-login-form">Đăng kí</div>
                    </div>
                    <div class="modal-body">
                        <div class="login-form">
                            <form method="POST" action="{{ route('register') }}">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End-->
        <!-- Offcanvas Menu Start -->
        <div id="offcanvas-body-wrapper" class="offcanvas-body-wrapper">
            <div id="offcanvas-nav-close" class="offcanvas-nav-close offcanvas-menu-btn">
                <a href="#" class="menu-times re-point">
                    <span></span>
                    <span></span>
                </a>
            </div>
            <div class="offcanvas-main-body">
                <ul id="accordion" class="offcanvas-nav panel-group">
                    <li class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{url('/')}}">
                                <i class="fa fa-home" aria-hidden="true"></i>Trang chủ</a>
                        </div>
                    </li>
                    @if (Auth::user())
                    <li>
                        <a href="{{url('/auth-posts')}}/{{Auth::user()->id}}/{{Auth::user()->username}}">
                            <i class="fa fa-user" aria-hidden="true"></i>Bài viết cá nhân</a>
                    </li>
                    @if(Auth::user()->role != 4)
                    <li>
                        <a href="{{url('/admin-newsflash/trang-chu')}}">
                            <i class="fa fa-tasks" aria-hidden="true"></i>Quản trị </a>
                    </li>
                    @endif
                    @endif
                    <li class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{url('/news')}}">
                                <i class="fa fa-file-text" aria-hidden="true"></i>Tin tức</a>
                        </div>
                    </li>
                    <li>
                        <a href="{{url('/contact')}}">
                            <i class="fa fa-phone" aria-hidden="true"></i>Contact Page</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Offcanvas Menu End -->
    </div>
    <!-- Wrapper End -->
    <!-- jquery-->
    <script src="{{asset('clients/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
    <!-- Plugins js -->
    <script src="{{asset('clients/js/plugins.js')}}" type="text/javascript"></script>
    <!-- Popper js -->
    <script src="{{asset('clients/js/popper.js')}}" type="text/javascript"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('clients/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- WOW JS -->
    <script src="{{asset('clients/js/wow.min.js')}}"></script>
    <!-- Owl Cauosel JS -->
    <script src="{{asset('clients/vendor/OwlCarousel/owl.carousel.min.js')}}" type="text/javascript"></script>

    <!-- Meanmenu Js -->
    <script src="{{asset('clients/js/jquery.meanmenu.min.js')}}" type="text/javascript"></script>
    <!-- Srollup js -->
    <script src="{{asset('clients/js/jquery.scrollUp.min.js')}}" type="text/javascript"></script>
    <!-- jquery.counterup js -->
    <script src="{{asset('clients/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('clients/js/waypoints.min.js')}}"></script>
    <!-- Isotope js -->
    <script src="{{asset('clients/js/isotope.pkgd.min.js')}}" type="text/javascript"></script>
    <!-- Magnific Popup -->
    <script src="{{asset('clients/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Ticker Js -->
    <script src="{{asset('clients/js/ticker.js')}}" type="text/javascript"></script>
    <!-- Custom Js -->
    <script src="{{asset('clients/js/main.js')}}" type="text/javascript"></script>
    <script src="{{asset('clients/js/subscribe.js')}}"></script>

    @yield('script')

    <a id="scrollUp" href="#top" style="display: none; position: fixed; z-index: 2147483647;"><i
            class="fa fa-angle-double-up"></i></a>
</body>

</html>