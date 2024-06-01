@extends('admin.main')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cập nhập sinh viên</h3>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST" enctype="multipart/form-data">
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
                            <label for="mssv">Mã sinh viên</label>
                            <input type="number" value="{{$student->mssv}}" class="form-control" name="mssv" id="mssv"
                                placeholder="Mã  sinh viên" required>
                        </div>
                        <div class="group-form">
                            <label for="name">Họ và Tên</label>
                            <input type="text" name="name" value="{{$student->name}}" class="form-control" id="name" placeholder=""
                                required>
                        </div>
                        <div class="group-form">
                            <label for="class">Lớp</label>
                            <input type="text" name="class" value="{{$student->class}}" class="form-control" id="class" placeholder=""
                                required>
                        </div>
                        <div class="group-form">
                            <label for="telephone">Số điện thoại</label>
                            <input type="number"  value="{{$student->telephone}}" name="telephone" class="form-control" id="telephone" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="group-form">
                            <label for="gender">Giới Tính</label>
                            <div class="form-check col-6">
                                <input id="gender" value="0" class="form-check-input" type="radio" name="gender"
                                {{ $student->gender = 0 ? 'checked=""' : '' }}>
                                <label for="gender" class="form-check-label">Nữ</label>
                            </div>
                            <div class="form-check col-6">
                                <input id="gender" value="1" class="form-check-input" type="radio" name="gender"
                                {{ $student->gender = 1 ? 'checked=""' : '' }}>
                                <label for="gender" class="form-check-label">Nam</label>
                            </div>
                        </div>
                        <div class="group-form">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{$user->email}}" class="form-control" id="email"
                                placeholder="name@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div>
                                <img style="width:60px; height:60px"
                                    src="/avatar/{{ $student->image }}" alt="">
                            </div>
                            <input type="file" class="form-control" id="image" value="{{$newImage}}" name="image" placeholder="">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary ">Cập nhập sinh viên</button>
                            <a href="/admin/student/list" class="btn btn-danger ml-2">Quay lại</a>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <script>
        // Select the input element
        const mssvInput = document.getElementById('mssv');
        // Add input event listener  
        mssvInput.addEventListener('input', function() {
            // Get input value
            let value = this.value;
            // Check if value length is greater than 10
            if (value.length > 10) {
                // Slice value to first 10 characters
                value = value.slice(0, 10);
                // Update input value
                this.value = value;
            }
        });
    </script>
@endsection
