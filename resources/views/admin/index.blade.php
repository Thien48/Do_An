@extends('admin.main')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3> Danh sách giảng viên
                <small class="float-right">Date: {{ $formattedDateTime }}</small>
            </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">
            <div class="row invoice-info m-2">
                <div class="col-sm-12 invoice-col">
                    <form action="{{ route('lecturer.search') }}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-2">
                                <label for="msgv">Mã số</label>
                                <input type="text" name="msgvSR" id="msgv" class="form-control"
                                    placeholder="Tìm kiếm..." value="{{ request('msgvSR') }}">
                            </div>
                            <div class="col-3">
                                <label for="name">Họ và tên</label>
                                <input type="text" name="nameSR" class="form-control" placeholder="Tìm kiếm..."
                                    value="{{ request('nameSR') }}">
                            </div>
                            <div class="col-2">
                                <label for="degreeSR">Học Vị</label>
                                <select name="degreeSR" class="form-control" id="degreeSR">
                                    <option value=""></option>
                                    <option value="Tiến Sĩ" {{ request('degreeSR') == 'Tiến Sĩ' ? 'selected' : '' }}>Tiến Sĩ
                                    </option>
                                    <option value="Thạc Sĩ" {{ request('degreeSR') == 'Thạc Sĩ' ? 'selected' : '' }}>Thạc Sĩ
                                    </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="name">Bộ Môn</label>
                                <select name="name_departmentSR" id="departmentSelect" class="form-control">
                                    <option value=""></option>
                                    @foreach ($deparmentOPT as $item)
                                        <option value="{{ $item->department_id }}"
                                            {{ request('name_departmentSR') == $item->department_id ? 'selected' : '' }}>
                                            {{ $item->name_department }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="gender">Giới Tính</label>
                                <div class="form-check col-3">
                                    <input id="nam" value="1" class="form-check-input" type="radio"
                                        name="genderSR" {{ request('genderSR') === '1' ? 'checked' : '' }}>
                                    <label for="nam" class="form-check-label">Nam</label>
                                </div>
                                <div class="form-check col-3">
                                    <input id="nu" value="0" class="form-check-input" type="radio"
                                        name="genderSR" {{ request('genderSR') === '0' ? 'checked' : '' }}>
                                    <label for="nu" class="form-check-label">Nữ</label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-12 col-12 invoice-col d-flex justify-content-end">
                    <div class="input-group justify-content-end">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary rounded"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="button_add ml-2">
                            <a href='/admin/lecturer/add' class="btn btn-success"><i class="fas fa-user-plus"></i></a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã số</th>
                        <th>Tên</th>
                        <th>Học vị</th>
                        <th>Số điện thoại</th>
                        <th>Bộ môn</th>
                        <th>Giới tính</th>
                        <th>Ảnh đại diện</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($data as $dt)
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{{ $dt->msgv }}</td>
                            <td>{{ $dt->name }}</td>
                            <td>{{ $dt->degree }}</td>
                            <td>{{ $dt->telephone }}</td>
                            <td>{{ $dt->name_department }}</td>
                            <td>{{ $dt->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                            <td><img style="width:50px; height:50px" src="/avatar/{{ $dt->image }}" alt="">
                            </td>
                            <td>
                                <a href="/admin/lecturer/edit/{{ $dt->lecturer_id }} " class="btn btn-primary"><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ route('destroyLecturer', ['user_id' => $dt->user_id]) }}"
                                    class="btn btn-danger" onclick="return confirmDelete()"><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-foorter">
            <div class="row">
                <div class="col-12">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $data->appends(request()->except('page'))->links() }}
                            {{-- {{ $data->render('vendor.pagination.custom') }} --}}
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa giảng viên này?");
        }
        // Select the input element
        const msgvInput = document.getElementById('msgv');

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
