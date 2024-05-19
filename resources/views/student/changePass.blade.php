@extends('student.main')

@section('contentStudent')
    <div class="card card-primary">
        <div class="card-header">
            <h3>Đổi mật khẩu</h3>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('changePasswordStudent') }}" method="POST">
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="current_password">Mật khẩu hiện tại:</label>
                    <input type="password" name="current_password" id="current_password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="new_password">Mật khẩu mới:</label>
                    <input type="password" name="new_password" id="new_password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Xác nhận mật khẩu mới:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
                <a href="/student/profile" class="btn btn-danger">Quay lại</a>
            </div>
        </form>
    @endsection
