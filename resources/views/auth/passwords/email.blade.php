<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" type="{{asset('clients/text/css" href="css/magnific-popup.css')}}">
    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="{{asset('clients/css/hover-min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('clients/style.css')}}">
    <!-- For IE -->
    <link rel="stylesheet" type="text/css" href="{{asset('clients/css/ie-only.css')}}" />
    <!-- Modernizr Js -->
    <script src="{{asset('clients/js/modernizr-2.8.3.min.js')}}"></script>
    <title>NewsFlash | Đăng nhập</title>
</head>

<body>
    <div class="modal fade show" id="myModal" role="dialog" style="display:block">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="card-header">{{ __('Đổi lại mật khẩu') }}</div>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <label>{{ __('Nhập địa chỉ email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <button type="submit" class="btn btn-primary">
                                {{ __('Gửi mailtrap') }}
                            </button> <br />
                            <label class="lost-password">
                                <a href="{{url('/')}}" class="btn btn-link">{{ __('Quay lại trang chủ') }}</a>
                            </label>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <!-- Modal End-->
    <script>
    $(document).ready(function() {
        $(".form-register").click(function() {
            window.location.href = "/register";
        })
    })
    </script>
</body>

</html>