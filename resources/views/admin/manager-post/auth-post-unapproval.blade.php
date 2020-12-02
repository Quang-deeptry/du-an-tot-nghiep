@extends('layouts.master')
@section('title', 'Bài viết đang chờ duyệt')
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
                    <h1>Bài viết chưa duyệt</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin-newsflash/trang-chu')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Bài viết chưa duyệt</li>
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
                            <h3 class="card-title">Thông tin bài viết & cập nhật</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-md-6">
                                            @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="response_remove">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="responveRemove">
                                                @if (\Session::has('remove_success'))
                                                <div class="alert alert-success message">
                                                    {!! \Session::get('remove_success') !!}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <button class="btn btn-danger mb-4" id="delete_post">Xóa bài đã
                                            chọn</button>
                                        <table id="example1"
                                            class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th><input type="checkbox" name="delete_all" id="checkAll"></th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column descending">
                                                        ID</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Thể loại</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        Tiêu đề</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Engine version: activate to sort column ascending">
                                                        Mô tả ngắn</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Ảnh
                                                        hiển thị
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Nội
                                                        dung
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Lượt
                                                        xem
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Trạng
                                                        thái
                                                    </th>

                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Chức
                                                        năng
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($unapproval_articles as $key => $item)
                                                <tr role="row" class="odd">
                                                    <td><input class="changes_checked" type="checkbox" name="checked[]"
                                                            value="{{$item->id}}">
                                                    <td tabindex="0" class="sorting_1">{{$key + 1}}</td>
                                                    <td>{{$item->category->category}} </td>
                                                    <td>{!! Str::limit($item->title, 20, '...') !!} </td>
                                                    <td>{!! Str::limit($item->description, 20, '...')!!} </td>
                                                    <td><img src="{{url('/')}}{{$item->image}}" alt="" width="80px">
                                                    </td>
                                                    <td class="post-content">
                                                        {!! $item->content !!}
                                                    </td>
                                                    <td>{{number_format($item->views_count)}} </td>
                                                    <td>
                                                        <span class="badge badge-danger">Đang chờ duyệt...</span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{url('/admin-newsflash/auth-posts-unapproval/editer')}}/{{$item->id}}/{{$item->slug}}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                            Chỉnh sửa
                                                        </a>
                                                        <a class="btn btn-danger btn-sm click-remove confirmation"
                                                            href="{{url('/admin-newsflash/auth-posts-unapproval/delete')}}/{{$item->id}}">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            Xóa bài viết
                                                        </a>
                                                    </td>
                                                </tr>
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
<script src="{{asset('admin/main/managers/checkbox-deletes-auth-unapproval.js')}}"></script>

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