@extends('admin.main')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3>Cập nhập bộ môn</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="group-form">
                            <label for="department_id">Mã bộ môn</label>
                            <input type="text" class="form-control" name="department_id" id="department_id" value="{{ $id->department_id }}">
                        </div>
                        <div class="group-form">
                            <label for="name_department">Tên bộ môn</label>
                            <input type="text" class="form-control" name="name_department" id="name_department" value="{{ $id->name_department }}">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ">Cập nhập bộ môn</button>
                            <a href="/admin/department/home" class="btn btn-danger ml-2">Quay lại</a>
                        </div>
                    </div>
                </div>
                @csrf
        </form>
    </div>
@endsection
