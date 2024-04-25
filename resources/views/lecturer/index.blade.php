@extends('lecturer.main')
    <link rel="stylesheet" href="/template/css/admin/index.css">

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
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
          <input type="" class="form-control" name="name" id="">
        </div>
        <div class="form-group">
          <label for="editor">Mục tiêu</label>
          <textarea name="" id="editor" class="form-control" cols="30" rows="5"></textarea>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('editor');
</script>
@endsection
