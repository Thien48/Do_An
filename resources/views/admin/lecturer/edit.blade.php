@extends('admin.main')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Sửa Giảng Viên</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="group-form">
                            <label for="lecturers_id">Mã giảng viên</label>
                            <input type="number" class="form-control" value="{{ $lecturer->lecturers_id }}"
                                name="lecturers_id" id="lecturers_id" placeholder="Mã Giảng Viên">
                        </div>
                        <div class="group-form">
                            <label for="department_id">Bộ Môn</label>
                            <select name="department_id" class="form-control" id="department_id">
                                @foreach ($departments as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->name_department }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="group-form">
                            <label for="name">Họ và Tên</label>
                            <input type="text" name="name" class="form-control" value="{{ $lecturer->name }}"
                                id="name" placeholder="">
                        </div>
                        <div class="group-form">
                            <label for="telephone">Số điện thoại</label>
                            <input type="number" name="telephone" value="{{ $lecturer->telephone }}" class="form-control"
                                id="telephone">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="group-form">
                            <label for="gender">Giới Tính</label>
                            <div class="form-check col-6">
                                <input id="gender" value="0" class="form-check-input" type="radio" name="gender"
                                    {{ $lecturer->degree = 0 ? 'checked=""' : '' }}>
                                <label for="gender" class="form-check-label">Nữ</label>
                            </div>
                            <div class="form-check col-6">
                                <input id="gender" value="1" class="form-check-input" type="radio" name="gender"
                                    {{ $lecturer->degree = 1 ? 'checked=""' : '' }}>
                                <label for="gender" class="form-check-label">Nam</label>
                            </div>
                        </div>
                        <div class="group-form">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image <img style="width:60px; height:60px"
                                    src="/avatar/{{ $lecturer->image }}" alt=""></label>

                            <input type="file" class="form-control" id="image" name="image" placeholder="">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer mt-4">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ">Sửa giảng viên</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
@endsection
