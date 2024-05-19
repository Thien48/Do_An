@extends('admin.main')

@section('head')
    <link rel="stylesheet" href="/template/css/admin/index.css">
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thông tin đề tài</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="GET">
            <div class="card-body">

                <div class="form-group" >
                    <label for="name_proposal">Giảng viên</label>
                    <div class="pl-2">{{$lecturer->name}}</div>
                    <label for="name_proposal">Tên đề tài</label>
                    <div class="pl-2">{!!$proposal->name_proposal!!}</div>
                </div>
                <div class="form-group">
                    <label for="target">Mục đích</label>
                    <div>{!!$proposal->target!!}</div>
                </div>
                <div class="form-group">
                    <label for="request">Yêu cầu</label>
                    <div>{!!$proposal->request!!}</div>
                </div>
                <div class="form-group">
                    <label for="references">Tài liệu tham khảo</label>
                    <div>{!!$proposal->references!!}</div>
                </div>
                <div class="group-form">
                    <label for="subject_id">Loại đề tài</label>
                    <p>{{ $subject->name_subject }}</p>
                </div>
                <div class="form-group">
                    <label for="year">Năm học</label>
                    <p>{{$proposal->year}}</p>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="/admin/proposal/listProposal" class="btn btn-danger">Quay Lại</a>
            </div>
        </form>
    </div>
@endsection
