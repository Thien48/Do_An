@extends('admin.main')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3>Thêm Bộ Môn</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('addDepartment') }}" method="POST">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="group-form">
                            <label for="department_id">Mã bộ môn mới</label>
                            <input type="text" class="form-control" name="department_id" id="department_id"
                                placeholder="Tên bộ môn mới" required>
                        </div>
                        <div class="group-form">
                            <label for="name_department">Tên bộ môn mới</label>
                            <input type="text" class="form-control" name="name_department" id="name_department"
                                placeholder="Tên bộ môn mới" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer mt-3">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary ">Thêm bộ môn</button>
                            <a href="/admin/department/home" class="btn btn-danger ml-2">Quay lại</a>
                        </div>
                    </div>
                </div>
                @csrf
        </form>
    </div>
@endsection
