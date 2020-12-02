@extends('layouts.master')
@section('title', 'Trang chủ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard v2</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="far fa-calendar-times"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Số bài viết chưa được duyệt</span>
                            <span class="info-box-number">{{$count_unapproval}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="far fa-calendar-check"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Số bài viết được duyệt</span>
                            <span class="info-box-number">{{$count_posts}} </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Số lượng thành viên</span>
                            <span class="info-box-number">{{$count_users}} </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="far fa-comment"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Số lượt bình luận</span>
                            <span class="info-box-number">
                                {{$count_comments}}
                                <small> <i class="far fa-comment"></i></small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Thống kê bài viết </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">{{$count_posts}}</span>
                                    <span>Số bài viết</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    @if($count_month_current > 0)
                                    <span class="text-success">
                                        {{$count_month_current}} <i class="fas fa-arrow-up"></i>
                                    </span>
                                    @else
                                    <span class="text-danger">
                                        {{$count_month_current}} <i class="fas fa-arrow-down"></i>
                                    </span>
                                    @endif

                                    <span class="text-muted">Số bài viết tháng này so với tháng trước</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <div id="chartContainer" style="height: 375px; width: 100%;"></div>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-black"></i> Cột biểu thị số bài viết được đăng trong
                                    tháng
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
<script src="{{asset('admin/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light",
            animationEnabled: false,
            title: {
                text: "Số lượt đăng bài trong 12 tháng",
            },
            data: [
                {
                    type: "column",
                    dataPoints: [
                        { label: "Tháng 1", y: {{$countMonth[0]}} },
                        { label: "Tháng 2", y: {{$countMonth[1]}} },
                        { label: "Tháng 3", y: {{$countMonth[2]}} },
                        { label: "Tháng 4", y: {{$countMonth[3]}} },
                        { label: "Tháng 5", y: {{$countMonth[4]}} },
                        { label: "Tháng 6", y: {{$countMonth[5]}} },
                        { label: "Tháng 7", y: {{$countMonth[6]}} },
                        { label: "Tháng 8", y: {{$countMonth[7]}} },
                        { label: "Tháng 9", y: {{$countMonth[8]}} },
                        { label: "Tháng 10", y: {{$countMonth[9]}} },
                        { label: "Tháng 11", y: {{$countMonth[10]}} },
                        { label: "Tháng 12", y: {{$countMonth[11]}} },
                    ],
                },
            ],
        });
        chart.render();
    };
</script>
@endsection