@extends('admin.main')
@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3 >Cập nhập loại đề tài</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="group-form">
                            <label for="name_subject">Tên loại đề mới</label>
                            <input type="text" class="form-control" name="name_subject" id="name_subject"
                                placeholder="Tên loại đề mới" value="{{ $subjects->name_subject }}" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer mt-3">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary ">Cập nhập loại đề tài</button>
                            <a href="/admin/subject/home" class="btn btn-danger ml-2">Quay lại</a>
                        </div>
                    </div>
                </div>
                @csrf
        </form>
    </div>
@endsection
