@extends('lecturer.main')


@section('head')
    <link rel="stylesheet" href="/template/css/admin/index.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm đề tài</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Tên đề tài</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="introduce">Giới Thiệu</label>
                    <textarea name="introduce" id="introduce" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="target">Mục đích</label>
                    <textarea name="target" id="target" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="request">Tài liệu</label>
                    <textarea name="request" id="request" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="references">Người hướng dẫn</label>
                    <textarea name="" id="references" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="references">Năm học</label>
                    <input type="text" name="year" class="form-control" id="">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm đề tài</button>
            </div>
        </form>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#introduce'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#name'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#target'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#request'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#references'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
