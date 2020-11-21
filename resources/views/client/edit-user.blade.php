@extends('layouts.app')
@section('title', 'Chỉnh sửa trang cá nhân')
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
<section class="breadcrumbs-area" style="background-image: url('clients/img/banner/breadcrumbs-banner.jpg');">
    <div class="container">
        <div class="breadcrumbs-content">
            <h1>Chỉnh sửa</h1>
            <ul>
                <li>
                    <a href="index.html">Trang chủ</a> -</li>
                <li>Chỉnh sửa trang cá nhân</li>
            </ul>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End Here -->

<!-- Contact Page Area Start Here -->
<section class="bg-body section-space-less30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 mb-30">
                <div class="topic-border color-cod-gray mb-30">
                    <div class="topic-box-lg color-cod-gray">Thông tin cá nhân</div>
                </div>
                <p>Đặc quyền của bạn là : <b>{{$user->roles->name}}</b></p>
                <p><b>Quyền quản trị</b> : Là người quản trị toàn bộ website có đủ mọi đặc quyền
                    trên website.</p>
                <p>
                    <b>Kiểm duyệt</b> : Ngoài quyền quản lí tài khoản người dùng ra thì kiểm duyệt có đủ mọi tư cách
                    thay thế quản trị viên xử lí mọi thứ.
                </p>
                <p>
                    <b>Tác giả</b> : Tác giả chỉ có quyền đăng bài viết lên website nhưng cần phải thông qua kiểm duyệt
                    bài viết.
                </p>
                <p class="size-lg mb-40">
                    <b>Người dùng</b> : Người dùng chỉ cho phép bình luận lên mỗi bài viết.
                </p>
                <p>
                    <b>Chức năng</b> : <a class="btn btn-primary" href="{{url('/admin-newsflash/trang-chu')}}">Vào quản
                        trị
                    </a>
                </p>
                <div class="card col-md-6">
                    <img class="card-img-top pt-3" src="{{asset('clients/img/news/news13.jpg')}}">
                    <div class="card-body">
                        <h4 class="card-title">Tài khoản: {{$user->username}}</h4>
                        <p class="card-text">Email : {{$user->email}} </p>
                        <p class="card-text">Mật khẩu : *****************</p>
                        <button type="submit" class="btn btn-primary btn-lg click-editer">Chỉnh sửa </button>
                    </div>
                </div>
                <form class="contact-form">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Nhập tên tài khoản</label>
                                    <input type="text" placeholder="Nhập tên tài khoản" class="form-control" name="name"
                                        value="{{$user->username}}">
                                    <div class="help-block with-errors-name"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Nhập email</label>
                                    <input type="email" placeholder="Nhập email" class="form-control"
                                        value="{{$user->email}}" name="email">
                                    <div class="help-block with-errors-email"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="">Mật khẩu</label>
                                    <input type="password" value="{{$user->password}}" placeholder="Mật khẩu"
                                        class="form-control" name="password">
                                    <div class="help-block with-errors-password"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12">
                                <div class="form-response">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-sm-12">
                                <div class="form-group mb-none">
                                    <button type="submit" class="btn-ftg-ptp-56 click-update">Cập nhật
                                    </button>
                                    <button type="button" class="btn-ftg-ptp-56 click-load" disabled> Cập nhật
                                        <i class="fa fa-circle-o-notch fa-spinner fa-spin" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <button type="button" class="btn btn-success btn-lg click-reload mt-4">Quay lại
                                    <i style="font-size:12px" class="fa">&#xf112;</i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>

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
                            <img src="{{asset('clients')}}/img/banner/banner3.jpg" alt="ad" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="sidebar-box">
                    <div class="topic-border color-cod-gray mb-30">
                        <div class="topic-box-lg color-cod-gray">Tin mới nhất</div>
                    </div>
                    <div class="newsletter-area bg-primary">
                        <img src="{{asset('clients')}}/img/banner/newsletter.png" alt="newsletter"
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
@endsection
@section('script')
<script src="{{asset('clients/js/edit-user.js')}}"></script>
@endsection