<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Newsflash | @yield('title') </title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('clients/img/favicon.png')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">

    @yield('scriptTop')

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{url('/admin-newsflash/trang-chu')}}" class="nav-link">Trang chủ</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{url('/')}}" class="nav-link">Trang chính</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Chức năng</span>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                        <a href="{{url('/auth-posts')}}/{{Auth::user()->id}}/{{Auth::user()->username}}"
                            class="dropdown-item dropdown-footer">Trang cá nhân</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{url('/logout')}}" class="dropdown-item dropdown-footer">Đăng xuất</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('/admin-newsflash/trang-chu')}}" class="brand-link">
                <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">NewsFlash</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{url('/admin-newsflash/trang-chu')}}" class="d-block">Admin</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-header">Quản lí</li>
                        @if(Auth::user()->role == 1)
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Quản lí tài khoản
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('/admin-newsflash/manager-accounts')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tài khoản</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin-newsflash/change-roles')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thay đổi quyền quản lí</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Quản lí bài viết
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('/admin-newsflash/auth-posts')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bài viết cá nhân</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin-newsflash/auth-posts-unapproval')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bài viết cá nhân chưa duyệt</p>
                                    </a>
                                </li>
                                @if(Auth::user()->role== 1 || Auth::user()->role == 2)
                                <li class="nav-item">
                                    <a href="{{url('/admin-newsflash/approval-articles')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bài viết đã duyệt</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/admin-newsflash/unapproval-articles')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bài viết đang chờ duyệt</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        </li>
                        <li class="nav-header">Quản lí bình luận</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Bình luận
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('/admin-newsflash/auth-posts-comments')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bình luận bài viết cá nhân</p>
                                    </a>
                                </li>
                                @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                                <li class="nav-item">
                                    <a href="{{url('/admin-newsflash/list-comments')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách bình luận</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-header">Thể loại bài viết</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Thể loại
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('/admin-newsflash/list-category')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm thể loại</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Bài viết</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Thêm bài viết
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('/admin-newsflash/create-post')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tạo bài viết mới</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">Thông tin quản lí</li>
                        @if(Auth::user()->role == 1)
                        <li class="nav-item">
                            <a href="{{url('/admin-newsflash/subscribe')}}" class="nav-link">
                                <i class="nav-icon far fa-circle text-success"></i>
                                <p>Email đăng kí </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{url('/admin-newsflash/admin-info')}}" class="nav-link">
                                <i class="nav-icon far fa-circle text-info"></i>
                                <p>Thông tin quản trị viên</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')
        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020 - 2025 <a href="{{url('/')}}">News Flash</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.5
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script type="text/javascript">
        var elems = document.getElementsByClassName('confirmation');
        var confirmIt = function (e) {
            if (!confirm('Bạn có muốn xóa ?')) e.preventDefault();
        };
        for (var i = 0, l = elems.length; i < l; i++) {
            elems[i].addEventListener('click', confirmIt, false);
        }
    </script>
    @yield('script')
    <script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin/dist/js/adminlte.js')}}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{asset('admin/dist/js/demo.js')}}"></script>

    <script>
        $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    </script>
</body>

</html>