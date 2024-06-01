@extends('admin.main')
@section('content')
    <div class="card card-primary mt-2">
        <div class="card-header">
            <h3> Danh sách đề tài đã đăng kí.
                <small class="float-right">Date: {{ $formattedDateTime }}</small>
            </h3>
        </div>
        <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>
@endsection
