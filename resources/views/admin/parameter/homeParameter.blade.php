@extends('admin.main')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tham số</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Tham số</th>
                    <th>Đơn vị tính</th>
                    <th>Giá trị</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($parameter as $data)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$data->name_parameters }}</td>
                        <td>{{$data->unit }}</td>
                        <td>{{$data->value }}</td>
                        <td>
                            <a href="/admin/parameters/edit/{{ $data->id }} " class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
