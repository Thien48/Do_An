@extends('admin.main')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm Bộ Môn</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="group-form">
                            <label for="subject_name">Tên loại đề mới</label>
                            <input type="text" class="form-control" name="subject_name" id="subject_name"
                                placeholder="Tên loại đề mới" value="{{ $subjects->subject_name }}">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary ">Cập nhập </button>
                        </div>
                    </div>
                </div>
                @csrf
        </form>
    </div>
@endsection