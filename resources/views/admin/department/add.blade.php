@extends('admin.main')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm Bộ Môn</h3>
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
                            <label for="name_department">Tên bộ môn mới</label>
                            <input type="text" class="form-control" name="name_department" id="name_department"
                                placeholder="Tên bộ môn mới">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ">Thêm </button>
                        </div>
                    </div>
                </div>
                @csrf
        </form>
    </div>
@endsection
