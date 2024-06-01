@extends('admin.main')
 
@section('content')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3 >Cập nhập thời gian</h3>
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
            <div class="d-flex p-2">
                <div class="col-6" style="padding: 10px">
                    <div class="group-form">
                        <label for="registration_start_date">Ngày bắt đầu đăng kí đề tài</label>
                        <input type="text" name="registration_start_date" value=" {{ \Carbon\Carbon::parse($duration->registration_start_date)->format('H:i:s d-m-Y') }}" class="form-control datepicker" id="registration_start_date" placeholder="" required>
                    </div>
                    <div class="group-form">
                        <label for="registration_end_date">Ngày kết thúc đăng kí đề tài</label>
                        <input type="text" name="registration_end_date" value="{{ \Carbon\Carbon::parse($duration->registration_end_date)->format('H:i:s d-m-Y') }}"
                            class="form-control" id="registration_end_date" placeholder="" required>
                    </div>
                    <div class="group-form">
                        <label for="proposed_start_date">Ngày bắt đầu đăng kí đề xuất đề tài</label>
                        <input type="text" name="proposed_start_date" value="{{ \Carbon\Carbon::parse($duration->proposed_start_date)->format('H:i:s d-m-Y') }}"
                            class="form-control" id="proposed_start_date" placeholder="" required>
                    </div>
                    <div class="group-form">
                        <label for="proposed_end_date">Ngày kết thúc đăng kí đề xuất đề tài</label>
                        <input type="text" name="proposed_end_date" value="{{ \Carbon\Carbon::parse($duration->proposed_end_date)->format('H:i:s d-m-Y') }}"
                            class="form-control" id="proposed_end_date" placeholder="" required>
                    </div>
                    <div class="group-form">
                        <label for="instruct_start_date">Ngày bắt đầu hướng dẫn</label>
                        <input type="text" name="instruct_start_date" value="{{ \Carbon\Carbon::parse($duration->instruct_start_date)->format('H:i:s d-m-Y') }}"
                            class="form-control" id="instruct_start_date" placeholder="" required>
                    </div>
                    <div class="group-form">
                        <label for="instruct_end_date">Ngày kết thúc hướng dẫn</label>
                        <input type="text" name="instruct_end_date" value="{{ \Carbon\Carbon::parse($duration->instruct_end_date)->format('H:i:s d-m-Y') }}"
                            class="form-control" id="instruct_end_date" placeholder="" required>
                    </div>
                    <!-- /.card-body -->
                    
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary ">Cập nhập</button>
                        <a href="/admin/duration" class="btn btn-danger ml-2">Quay lại</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
