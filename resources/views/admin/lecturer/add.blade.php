@extends('admin.main')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm Giảng Viên</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('createLecturer') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                            <input type="number" class="form-control" name="lecturers_id" id="lecturers_id"
                                placeholder="Mã Giảng Viên">
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
                            <input type="text" name="name" class="form-control" id="name" placeholder="">
                        </div>
                        <div class="group-form">
                            <label for="telephone">Số điện thoại</label>
                            <input type="number" name="telephone" class="form-control" id="telephone">
                        </div>
                        <div class="group-form">
                            <label for="degree">Học Vị</label>
                            <input type="text" name="degree" class="form-control" id="degree">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="group-form">
                            <label for="gender">Giới Tính</label>
                            <div class="form-check col-6">
                                <input id="gender" value="0" class="form-check-input" type="radio" name="gender">
                                <label for="gender" class="form-check-label">Nữ</label>
                            </div>
                            <div class="form-check col-6">
                                <input id="gender" value="1" class="form-check-input" type="radio" name="gender"
                                    checked="">
                                <label for="gender" class="form-check-label">Nam</label>
                            </div>
                        </div>
                        <div class="group-form">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="name@example.com" required>
                        </div>
                        <div class="group-form">
                            <label for="password" class="form-label">Mật Khẩu</label>
                            <input type="text" name="password" class="form-control" id="password" required>
                        </div>
                        {{-- <div class="group-form">
                            <label for="image">Image</label>
                            <input type="text" name="image" class="form-control" id="image">
                        </div> --}}
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ">Thêm giảng viên</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    {{-- <script>
        document.getElementById('image').addEventListener('change', function() {
            // Lấy tên file được chọn
            var fileName = this.files[0].name;
            // Cập nhật nội dung của label tùy chỉnh
            this.nextElementSibling.textContent = fileName;
        });
    </script> --}}
@endsection
