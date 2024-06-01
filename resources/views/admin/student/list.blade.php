@extends('admin.main')
@section('content')
<div class="card card-primary mt-2">
    <div class="card-header">
        <h3 > Danh sách sinh viên.
            <small class="float-right">Date: {{ $formattedDateTime }}</small></h3>
    </div>
    <div class="card-body">
        <form action="{{route('searchStudent')}}" method="GET">
            <div class="row invoice-info ">
                <div class="col-sm-12 invoice-col">
                    <div class="row">
                        <div class=" col-3">
                            <label for="name">Mã số</label>
                            <input type="text" name="mssvSR" id="mssvSR"  value="{{ request('mssvSR') }}" class="form-control"
                                placeholder="Tìm kiếm...">
                        </div>
                        <div class=" col-3">
                            <label for="name">Họ và tên</label>
                            <input type="text" name="nameSR" value="{{ request('nameSR') }}" class="form-control" placeholder="Tìm kiếm...">
                        </div>
                        <div class=" col-3">
                            <label for="classSR">Lớp</label>
                            <input type="text" name="classSR" value="{{ request('classSR') }}" class="form-control" placeholder="Tìm kiếm...">
                        </div>
                        <div class="col-2">
                            <label for="gender">Giới Tính</label>
                            <div class="form-check col-3">
                                <input id="nam" value="1" class="form-check-input" type="radio" name="genderSR"
                                    {{ request('genderSR') === '1' ? 'checked' : '' }}>
                                <label for="nam" class="form-check-label">Nam</label>
                            </div>
                            <div class="form-check col-3">
                                <input id="nu" value="0" class="form-check-input" type="radio" name="genderSR"
                                    {{ request('genderSR') === '0' ? 'checked' : '' }}>
                                <label for="nu" class="form-check-label">Nữ</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-12 col-12 invoice-col">
                    <div class="input-group justify-content-end">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary rounded"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="button_add ml-2">
                            <a href='/admin/student/add' class="btn btn-success"><i class="fas fa-user-plus"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <div class="row mt-2">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã số</th>
                            <th>Tên Sinh Viên</th>
                            <th>Lớp</th>
                            <th>Giới Tính</th>
                            <th>Ảnh</th>
                            <th>Số điện thoại</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $data)
                            <tr>
                                <td>{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}</td>
                                <td>{{ $data->mssv }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->class }}</td>
                                <td>{{ $data->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                                <td><img style="width:50px; height:50px" src="/avatar/{{ $data->image }}" alt="">
                                </td>
                                <td>{{ $data->telephone }}</td>
                                <td>
                                    <a href="/admin/student/edit/{{ $data->id }} " class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="{{ route('destroyStudent', ['user_id' => $data->user_id]) }}"
                                        class="btn btn-danger" onclick="return confirmDelete()"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <div class="col-12">
            <div class="col-12 d-flex justify-content-center">
                {{ $students->appends(request()->except('page'))->links() }}
                {{-- {{ $data->render('vendor.pagination.custom') }} --}}
            </div>
        </div>
    </div>
</div>
    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa sinh viên này?");
        }
        const msgvInput = document.getElementById('mssv');

        // Add input event listener  
        msgvInput.addEventListener('input', function() {

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
