@extends('lecturer.main')
<link rel="stylesheet" href="/template/css/admin/index.css">
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h2>Thông tin người dùng</h2>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <div class="image-container">
                        <div class="content">
                            <img src="/avatar/{{ $name->image }}" style="height: 500px" alt="">
                            <h2 class="mt-2"><strong>{{$name->name}}</strong></h2>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="row">
                        <div class="col-12">
                            <h3><label for="msgv">MSGV</label></h3>
                            <h3>{{ $name->msgv }}</h3>
                        </div>

                        <div class="col-12">
                            <h3><label for="mssv">Giới tính</label></h3>
                            <h3><p>{{ $name->gender == 0 ? 'Nữ' : 'Nam' }}</p></h3>
                        </div>
                        <div class="col-12">
                            <h3><label for="gender">Chức Vụ</label></h3>
                            <h3><p>{{ $name->degree }}</p></h3>
                        </div>
                        <div class="col-12">
                            <h3><label for="mssv">Email</label></h3>
                            <h3><p>{{ $user->email }}</p></h3>
                        </div>
                        <div class="col-12">
                            <h3><label for="mssv">Số điện thoại</label></h3>
                            <h3><p>{{ $name->telephone }}</p></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="/lecturer" class="btn btn-primary">Quay lại</a>
            <a  href="/lecturer/change-password" class="btn btn-success">Đổi mật khẩu</a>
        </div>
</div>
@endsection
