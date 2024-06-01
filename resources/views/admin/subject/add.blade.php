@extends('admin.main')
@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3 >Thêm loại đề tài</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('addSubject') }}" method="POST">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="group-form">
                            <label for="name_subject">Tên loại đề mới</label>
                            <input type="text" class="form-control" name="name_subject" id="name_subject"
                                placeholder="Tên loại đề mới" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer mt-3">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary ">Thêm loại đề tài</button>
                            <a href="/admin/subject/home" class="btn btn-danger ml-2">Quay lại</a>

                        </div>
                    </div>
                </div>
                @csrf
        </form>
    </div>
@endsection
