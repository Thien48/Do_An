@extends('admin.main')
<link rel="stylesheet" href="/template/css/admin/index.css">
@section('content')
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Danh sách Giảng Viên.
                    <small class="float-right">Date: {{  $formattedDateTime }}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">

            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Học vị</th>
                            <th>Số điện thoại</th>
                            <th>Bộ môn</th>
                            <th>Ảnh đại diện</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lecturers as $lecturer)
                            <tr>
                                <td>{{ $lecturer->lecturers_id }}</td>
                                <td>{{ $lecturer->name }}</td>
                                <td>{{ $lecturer->degree }}</td>
                                <td>{{ $lecturer->telephone }}</td>
                                @if ($lecturer->department_id == 2)
                                     <td>Thông Tin quản Lí </td>
                                @else
                                     <td>Công Nghệ Thông Tin</td>
                                @endif
                                <td><img style="width:60px; height:60px" src="/avatar/{{$lecturer->image}}" alt=""></td>
                                <td>
                                    <a href='{{asset ("/admin/lecturer/add")}}' class="btn btn-success"><i class="fas fa-user-plus"></i></a>
                                    <a href='{{asset ("admin/lecturer/edit/{id}")}}' class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href='{{asset ("/admin/lecturer/edit")}}' onclick="removeRow('. $lecturer->lecturers_id . ', \'/admin/lecturer/edit')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    @endsection
