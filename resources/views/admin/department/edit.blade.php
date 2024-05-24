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
                            <label for="name_department">Tên bộ môn</label>
                            <input type="text" class="form-control" name="name_department" id="name_department" value="{{ $id->name_department }}">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ">Cập Nhập </button>
                        </div>
                    </div>
                </div>
                @csrf
        </form>
    </div>
@endsection
