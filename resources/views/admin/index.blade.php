@extends('admin.main')
<link rel="stylesheet" href="/template/css/admin/index.css">

@section('content')
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Danh sách Giảng Viên.
                    <small class="float-right">Date: {{ $formattedDateTime }}</small>
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
            <div class="col-sm-12 invoice-col">
                <div class="row">
                    <div class="button_add">
                        <a href='/admin/lecturer/add' class="btn btn-success"><i class="fas fa-user-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table row -->
        <div class="row mt-2">
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
                        @php
                            $i = 1;
                        @endphp
                            <tr>
                                @foreach ($data as $dt)
                                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                                <td>{{ $dt->name }}</td>
                                <td>{{ $dt->degree }}</td>
                                <td>{{ $dt->telephone }}</td>
                                <td>{{ $dt->name_department }}</td>
                                <td><img style="width:60px; height:60px" src="/avatar/{{ $dt->image }}" alt="">
                                </td>
                                <td>
                                    <a href="/admin/lecturer/edit/{{ $dt->id }} " class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="{{ route('destroyLecturer', ['user_id' => $dt->user_id]) }}"
                                        class="btn btn-danger" onclick="return confirmDelete()"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-12">
                    {{ $data->links() }}
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <script>
            function confirmDelete() {
                return confirm("Bạn có chắc chắn muốn xóa giảng viên này?");
            }
        </script>
    @endsection