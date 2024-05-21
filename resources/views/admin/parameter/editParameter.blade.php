@extends('admin.main')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Cập nhập tham số</h3>
    </div>
    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    <!-- /.card-header -->
    <!-- form start -->
    <form action="" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="col-12" style="padding: 10px">
            <div class="group-form">
                <label for="name_parameters">Tên tham số</label>
                <input type="text" value="{{$parameter->name_parameters}}" class="form-control" name="name_parameters" id="name_parameters" disabled>
            </div>
            <div class="group-form">
                <label for="unit">Đơn vị tính</label>
                <input type="text" name="unit" value="{{$parameter->unit}}" class="form-control" id="unit" placeholder="" disabled>
            </div>
            <div class="group-form">
                <label for="value">Giá trị</label>
                <input type="number" name="value" value="{{$parameter->value}}" class="form-control" id="value" placeholder="" required>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary ">Cập nhập</button>
                    </div>
                </div>
            </div>
    </form>
</div>
@endsection