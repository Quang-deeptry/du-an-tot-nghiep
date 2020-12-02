@extends('layouts.master')
@section('title', 'Quản lí tài khoản')
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
                    <h1>Tài khoản</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin-newsflash/trang-chu')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Tài khoản</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i
                            class="fas fa-user-plus"></i> Tạo tài khoản </button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-default" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tạo tài khoản mới</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tài khoản</label>
                            <input type="text" class="form-control" name="username">
                            <code class="error_username"></code>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email">
                            <code class="error_email"></code>
                        </div>
                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input type="password" class="form-control" name="password">
                            <code class="error_password"></code>

                        </div>
                        <div class="form-group">
                            <label for="">Phân quyền</label>
                            <select name="role" class="form-control role">
                                @foreach ($roles as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <code class="error_role"></code>
                        </div>

                        <div class="response-mess">

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary created_account"><i class="fas fa-plus"></i> Thêm
                            tài
                            khoản</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin tài khoản & cập nhật</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-md-6">
                                            <div class="responveRemove">
                                                @if (\Session::has('remove_success'))
                                                <div class="alert alert-success message">
                                                    {!! \Session::get('remove_success') !!}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="response_remove">
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
                                                        Tài khoản</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        Email(s)</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Quyền
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Ngày
                                                        tạo
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">Chức
                                                        năng
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $key => $item)
                                                <tr role="row" class="odd">
                                                    <td><input class="changes_checked" type="checkbox" name="checked[]"
                                                            value="{{$item->id}}">
                                                    <td tabindex="0" class="sorting_1">{{$key + 1}}</td>
                                                    <td>{{$item->username}} </td>
                                                    <td>{{$item->email}} </td>
                                                    <td>{{$item->roles->name}} </td>
                                                    <td>{{$item->created_at}} </td>
                                                    <td><a class="btn btn-info btn-sm"
                                                            href="{{url('/admin-newsflash/manager-accounts/editer')}}/{{$item->id}}/{{$item->username}}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                            Chỉnh sửa
                                                        </a>
                                                        <a class="btn btn-danger btn-sm click-remove confirmation"
                                                            href="{{url('/admin-newsflash/manager-accounts/delete')}}/{{$item->id}}">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            Xóa tài khoản
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
<script src="{{asset('admin/main/managers/checkbox-deletes-account.js')}}"></script>

<script>
    setTimeout(function(){
        $(".message").delay(1500).fadeOut('slow');
    }, 0);
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
<script src="{{asset('/admin/main/created-account.js')}}"></script>
@endsection