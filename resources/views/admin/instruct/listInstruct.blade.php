@extends('admin.main')
<link rel="stylesheet" href="/template/css/admin/index.css">
@section('content')
    <div class="card card-primary mt-2">
        <div class="card-header">
            <h3> Danh sách sinh viên.
                <small class="float-right">Date: {{ $formattedDateTime }}</small>
            </h3>
        </div>
        <div class="card-body">
            {{-- <form action="{{route('searchStudent')}}" method="GET">
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
        </form> --}}
            <div class="row mt-2">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="col-12">
                    <div class="d-flex justify-content-end">
                        <a href="{{Route('exportIntructDataExport')}}" class="btn btn-success"><i class="fas fa-file-excel"></i></a>
                    </div>
                </div>
                <div class="col-12 table-responsive mt-2">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Giảng viên</th>
                                <th>Tên đề tài</th>
                                <th>Tên sinh viên thực hiện</th>
                                <th>Loại đề tài</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instruct as $data)
                                <tr>
                                    <td>{{($instruct->currentPage() - 1) * $instruct->perPage() + $loop->iteration }}</td>
                                    <td>{{ $data->name_lecturer }}</td>
                                    <td style="width:700px">{!! htmlspecialchars_decode($data->name_proposal) !!}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->name_subject }}</td>
                                    <td>
                                        <a href="/student/proposal/detail/{{ $data->topic_id }}" class="btn btn-info"><i
                                                class="fas fa-eye"></i></a>
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
                    {{ $instruct->appends(request()->except('page'))->links() }}
                    {{-- {{ $data->render('vendor.pagination.custom') }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
