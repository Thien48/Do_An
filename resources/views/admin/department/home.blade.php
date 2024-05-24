@extends('admin.main')
<link rel="stylesheet" href="/template/css/admin/index.css">
@section('content')
<div class="card card-primary mt-2" >
    <div class="card-header">
        <h3> Danh sách Bộ Môn.
            <small class="float-right">Date: {{ $formattedDateTime }}</small>
        </h3>
        
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="card-body">
        <div class="d-flex justify-content-end">
            <div class=" button_add">
                <a href='/admin/department/add' class="btn btn-success">Thêm bộ môn</i></a>
            </div>
        </div>
        <div class="row mt-2">
            @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
            @endif
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên bộ môn</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach ($departments as $data)
                            <tr>
                                
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->name_department }}</td>
                                <td>
                                    <a href="/admin/department/edit/{{$data->id}} " class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" onclick="removeRow({{$data->id}}, '/admin/department/destroy')"
                                        class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>

    </div>
</div>
    @endsection
