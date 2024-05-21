@extends('admin.main')
 
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cập nhập</h3>
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
            <div class="col-6" style="padding: 10px">
                <div class="group-form">
                    <label for="registration_start_date">Ngày bắt đầu đăng kí đề xuất đề tài(Y-m-d H-i-s)</label>
                    <input type="text" name="registration_start_date" value=" {{ $duration->registration_start_date }}" class="form-control datepicker" id="registration_start_date" placeholder="" required>
                </div>
                <div class="group-form">
                    <label for="registration_end_date">Ngày kết thúc đăng kí đề xuất đề tài(Y-m-d H-i-s)</label>
                    <input type="text" name="registration_end_date" value="{{ $duration->registration_start_date }}"
                        class="form-control" id="registration_end_date" placeholder="" required>
                </div>
                <div class="group-form">
                    <label for="proposed_start_date">Ngày bắt đầu đăng kí đề tài(Y-m-d H-i-s)</label>
                    <input type="text" name="proposed_start_date" value="{{ $duration->proposed_start_date }}"
                        class="form-control" id="proposed_start_date" placeholder="" required>
                </div>
                <div class="group-form">
                    <label for="proposed_end_date">Ngày kết thúc đăng kí đề tài(Y-m-d H-i-s)</label>
                    <input type="text" name="proposed_end_date" value="{{ $duration->proposed_end_date }}"
                        class="form-control" id="proposed_end_date" placeholder="" required>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary ">Cập nhập</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(function () {
            $('#registration_start_date').datepicker({
                format: 'dd/mm/yyyy HH:ii:ss',
                todayBtn: 'linked',
                language: 'vi',
                autoclose: true
            });
        });
    </script>
@endsection
