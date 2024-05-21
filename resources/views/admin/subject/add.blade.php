@extends('admin.main')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm Bộ Môn</h3>
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
                                placeholder="Tên loại đề mới">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary ">Thêm </button>
                        </div>
                    </div>
                </div>
                @csrf
        </form>
    </div>
@endsection
