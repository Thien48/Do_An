@extends('lecturer.main')


@section('head')
    <link rel="stylesheet" href="/template/css/admin/index.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
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
                    <label for="name">Tên đề tài</label>
                    <textarea name="target"  class="form-control" id=""  cols="20" rows="5" disabled>{{$proposal->name}}</textarea>
                </div>
                <div class="form-group">
                    <label for="introduce">Giới Thiệu</label>
                    <textarea name="target"  class="form-control" id=""  cols="30" rows="5" disabled>{{$proposal->introduce}}</textarea>
                </div>
                <div class="form-group">
                    <label for="target">Mục đích</label>
                    {{-- <p>{!! htmlspecialchars_decode($proposal->target) !!}</p> --}}
                    <textarea name="target"  class="form-control" id=""  cols="30" rows="5" disabled>{{$proposal->target}}</textarea>
                </div>
                <div class="form-group">
                    <label for="request">Yêu cầu</label>
                    <textarea name="target"  class="form-control" id=""  cols="30" rows="5" disabled>{{$proposal->request}}</textarea>
                </div>
                <div class="form-group">
                    <label for="references">Tài liệu tham khảo</label>
                    <textarea name="target"  class="form-control" id=""  cols="30" rows="5" disabled>{{$proposal->references}}</textarea>
                </div>
                <div class="group-form">
                    <label for="subject_id">Loại đề tài</label>
                    <p>{{ $subject->subject_name }}</p>
                </div>
                <div class="form-group">
                    <label for="year">Năm học</label>
                    <p>{{$proposal->year}}</p>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="/lecturer" class="btn btn-danger">Quay Lại</a>
            </div>
        </form>
    </div>
@endsection
