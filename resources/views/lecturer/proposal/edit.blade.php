@extends('lecturer.main')


@section('head')
    <link rel="stylesheet" href="/template/css/admin/index.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm đề xuất đề tài</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="Post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Tên đề tài</label>
                    <textarea name="name" id="name" class="form-control" cols="30" rows="5">{{ $proposal->name }}</textarea>
                </div>
                <div class="form-group">
                    <label for="introduce">Giới Thiệu</label>
                    <textarea name="introduce" id="introduce" class="form-control" cols="30" rows="5">{{ $proposal->introduce }}</textarea>
                </div>
                <div class="form-group">
                    <label for="target">Mục đích</label>
                    <textarea name="target" id="target" class="form-control" cols="30" rows="5">{{ $proposal->target }}</textarea>
                </div>
                <div class="form-group">
                    <label for="request">Yêu cầu</label>
                    <textarea name="request" id="request" class="form-control" cols="30" rows="5">{!! htmlspecialchars_decode($proposal->request) !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="references">Tài liệu tham khảo</label>
                    <textarea name="references" id="references" class="form-control" cols="30" rows="5">{{ $proposal->references }}</textarea>
                </div>
                <div class="group-form">
                    <label for="subject_id">Loại đề tài</label>
                    <select name="subject_id" class="form-control" style="width:50%" id="subject_id" required>
                        @foreach ($subject as $data)
                            <option value="{{ $data->id }}" @if ($proposal->subject_id == $data->id) selected @endif>
                                {{ $data->subject_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Năm học</label>
                    <select name="year" class="form-control w-50" id="yearSelect">
                    </select>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="/lecturer" class="btn btn-danger">Quay Lại</a>
                <button type="submit" class="btn btn-success">Lưu</button>
            </div>
        </form>
    </div>

    <script>
        const yearSelect = document.getElementById('yearSelect');
        const currentYear = new Date().getFullYear();
        const savedYear = "{{ $proposal->year }}";

        for (let year = currentYear; year >= 2000; year--) {
            const option = document.createElement('option');
            const optionValue = `${year}-${year + 1}`;
            option.value = optionValue;
            option.textContent = optionValue;

            if (optionValue === savedYear) {
                option.selected = true; 
            }
            yearSelect.appendChild(option);
        }
    </script>
@endsection