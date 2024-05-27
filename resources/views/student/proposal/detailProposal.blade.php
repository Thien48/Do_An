@extends('student.main')
@section('head')
    <link rel="stylesheet" href="/template/css/admin/index.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
@endsection

@section('contentStudent')
    <div class="card card-primary">
        <div class="card-header">
            <h3 >Thông tin đề tài</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="GET">
            <div class="card-body">
                <div class="form-group" >
                    <label for="name_proposal">Tên đề tài</label>
                    <div><?php echo $proposal->name_proposal; ?></div>
                </div>
                <div class="form-group">
                    <label for="target">Mục đích</label>
                    <div><?php echo $proposal->target; ?></div>
                </div>
                <div class="form-group">
                    <label for="request">Yêu cầu</label>
                    <div><?php echo $proposal->request; ?></div>
                </div>
                <div class="form-group">
                    <label for="references">Tài liệu tham khảo</label>
                    <div><?php echo $proposal->references; ?></div>
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
        </form>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="/student" class="btn btn-danger">Quay Lại</a>
            </div>
        
    </div>
    <script>

    </script>
@endsection
