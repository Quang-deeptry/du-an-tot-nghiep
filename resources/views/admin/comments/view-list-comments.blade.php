@extends('layouts.master')
@section('title', 'Chi tiết bình luận')
@section('scriptTop')
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin-newsflash/trang-chu')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Chi tiết bình luận</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Chi tiết bình luận</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-danger mb-4" id="delete_post">Xóa bình luận đã
                                            chọn</button>
                                        <div class="response_remove col-sm-4">
                                        </div>
                                        <table id="example1"
                                            class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th><input type="checkbox" name="delete_all" id="checkAll"></th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        ID </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Tên tài khoản </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Nội dung bình luận </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Chức
                                                        năng
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($comments as $key => $item ) --}}
                                                @foreach($post_comment->comment as $key => $item)
                                                @if(count($post_comment->comment) > 0)
                                                <tr role="row" class="odd">
                                                    <td><input class="changes_checked" type="checkbox" name="checked[]"
                                                            value="{{$item->id}}">
                                                    </td>
                                                    <td>{{$post_comment->user->username}}</td>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$item->comment}}</td>
                                                    <td>
                                                        <a href="{{url('/posts')}}/{{$post_comment->id}}/{{$post_comment->slug}}"
                                                            class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Xem
                                                            bài viết </a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="col-md-10">
                <div class="responveRemove">
                    @if (\Session::has('success'))
                    <div class="alert alert-success message">
                        {!! \Session::get('success') !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<!-- DataTables -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/main/deleCheckbox_view_list.js')}}"></script>
<script>
    setTimeout(function(){
        $(".message").delay(1500).fadeOut('slow');
    }, 0);

    var content = $(".post-content").text();
    if(content.length > 20){
        $('.post-content').text(content.substring(0,100) + " ...");
    }
    
</script>
<script>
    $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection