@extends('admin.main')
@section('content')
    <div class="card card-primary mt-2">
        <div class="card-header">
            <h3> Danh sách loại đề tài
                <small class="float-right">Date: {{ $formattedDateTime }}</small>
            </h3>

        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div class="button_add">
                    <a href='/admin/subject/add' class="btn btn-success">Thêm loại đề tài</a>
                </div>
            </div>
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
                                <th>Tên đề tài</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach ($subjects as $data)
                                <tr>
    
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data->name_subject }}</td>
                                    <td>
                                        <a href="/admin/subject/edit/{{ $data->id }} " class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('destroySubject', ['id' => $data->id]) }}" class="btn btn-danger"
                                            onclick="return confirmDelete()"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
        <script>
            function confirmDelete() {
                return confirm("Bạn có chắc chắn muốn xóa đề tài này?");
            }
        </script>
    @endsection
