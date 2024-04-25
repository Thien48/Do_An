@extends('admin.main')
<link rel="stylesheet" href="/template/css/admin/index.css">
@section('content')
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Danh sách Bộ Môn.
                    <small class="float-right">Date: {{ $formattedDateTime }}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">

            </div>
            <!-- /.col -->
            <div class="col-sm-12 invoice-col">
                <div class="row">
                    <div class="button_add">
                        <a href='/admin/subject/add' class="btn btn-success"><i class="fas fa-user-plus"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <!-- Table row -->
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
                                <td>{{ $data->subject_name }}</td>
                                <td>
                                    <a href="/admin/subject/edit/{{$data->id}} " class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                            <a href="{{ route('destroySubject', ['id' => $data->id]) }}"
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
        <!-- /.row -->
        <script>
            function confirmDelete() {
                return confirm("Bạn có chắc chắn muốn xóa đề tài này?");
            }
        </script>
    @endsection
