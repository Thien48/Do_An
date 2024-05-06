@extends('lecturer.main')
<link rel="stylesheet" href="/template/css/admin/index.css">
@section('content')
    <div class="invoice p-3 mb-3 mt-2">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Chào mừng {{ $name->name }}.
                    <small class="float-right">Ngày: {{ $formattedDateTime }}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <form action="" method="GET">
            <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                    <div class="row">
                        <div class="col-2">
                            <label for="msgv">Mã số</label>
                            <input type="text" name="msgvSR" id="msgv" class="form-control"
                                placeholder="Tìm kiếm...">
                        </div>
                        <div class="col-3">
                            <label for="name">Họ và tên</label>
                        </div>
                        <div class="col-2">
                            <label for="degreeSR">Học Vị</label>
                            <select name="degreeSR" class="form-control" id="degreeSR">
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="name">Bộ Môn</label>
                            <select name="name_departmentSR" id="departmentSelect" class="form-control">
                                <option value=""></option>

                            </select>
                        </div>
                        <div class="col-2">
                            <label for="gender">Giới Tính</label>
                            <div class="form-check col-6">
                                <input id="gender" value="" class="form-check-input" type="radio" name="genderSR"
                                    {{ request('genderSR') === '' ? 'checked' : '' }}>
                                <label for="gender" class="form-check-label">Không</label>
                            </div>
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
                <div class="col-sm-12 col-12 invoice-col d-flex justify-content-end">
                    <div class="input-group justify-content-end">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary rounded"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="button_add ml-2">
                            <a href='/lecturer/proposal/add' class="btn btn-success"><i class="fas fa-user-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Table row -->
        <div class="row mt-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ngày Đăng</th>
                        <th>Tên</th>
                        <th>Loại đề tài</th>
                        <th>Tình trạng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($proposal instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        @foreach ($proposal as $data)
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{{ $data->proposed_date }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->subject_id == 1 ? 'Đồ án' : 'Chuyên đề' }}</td>
                            <td>{{ $data->status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</td>
                            <td>{!! htmlspecialchars_decode($data->content) !!}</td>
                        @endforeach
                    @else
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($proposal as $data)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->proposed_date }}</td>
                                <td>{!! htmlspecialchars_decode($data->name) !!}</td>
                                <td>{{ $data->subject_name }}</td>
                                <td>{{ $data->status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</td>
                                <td>
                                    <a href="/proposal/edit/{{ $data->proposal_form_id }} " class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('destroyProposal', ['id' => $data->proposal_form_id]) }}"
                                        onclick="return confirmDelete()" class="btn btn-danger"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            @if ($proposal instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="col-12">
                <div class="col-12 d-flex justify-content-center">
                    {{ $data->appends(request()->except('page'))->links() }}
                    {{-- {{ $data->render('vendor.pagination.custom') }} --}}
                </div>
            </div>
            @else
                
            @endif
            <!-- /.col -->
        </div>
    </div>
    <!-- /.row -->
    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa đề tài này?");
        }
    </script>
@endsection
