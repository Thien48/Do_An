@extends('admin.main')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 >Thời gian</h3>
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
                <th>Ngày bắt đầu đăng kí đề xuất đề tài</th>
                <th>Ngày kết thúc đăng kí đề xuất đề tài</th>
                <th>Ngày bắt đầu đăng kí đề tài</th>
                <th>Ngày kết thúc đăng kí đề tài</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($duration as $data)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->registration_start_date)->format('H:i:s d-m-Y')}}</td>
                    <td> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->registration_end_date)->format('H:i:s d-m-Y')}}</td>
                    <td> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->proposed_start_date)->format('H:i:s d-m-Y')}}</td>
                    <td> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->proposed_end_date)->format('H:i:s d-m-Y')}}</td>
                    <td>
                        <a href="/admin/duration/edit/{{ $data->id }} " class="btn btn-primary"><i
                            class="fas fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
