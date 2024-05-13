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
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('createPorposal') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Tên đề tài</label>
                    <textarea name="name" id="name" class="form-control"  cols="30" rows="5"></textarea>
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
                    <label for="request">Yêu cầu</label>
                    <textarea name="request" id="request" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="references">Tài liệu tham khảo</label>
                    <textarea name="references" id="references" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <div class="group-form">
                    <label for="subject_id">Loại đề tài</label>
                    <select name="subject_id" class="form-control" style="width:50%" id="subject_id" required>
                        <option value=""></option>
                        @foreach ($subject as $data)
                            <option value="{{ $data->id }}" >{{ $data->subject_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Năm học</label>
                    <select name="year"  class="form-control w-50" id="yearSelect">
                    </select>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm đề tài</button>
            </div>
        </form>
    </div>

    <script>
        // ClassicEditor
        //     .create(document.querySelector('#ckeditor'))
        //     .then(editor => {
        //         const nameInput = document.querySelector('#name');
        //         const nameInput = document.querySelector('#introduce');
        //         editor.model.document.on('change:data', () => {
        //             nameInput.value = editor.getData();
        //             introduce.value = editor.getData();
        //         });
        //     })
        //     .catch(error => {
        //         console.error(error);
        //     });

        const yearSelect = document.getElementById('yearSelect');
        const currentYear = new Date().getFullYear();

        for (let year = currentYear; year >= 2000; year--) {
            const option = document.createElement('option');
            option.value = `${year}-${year + 1}`;
            option.textContent = `${year}-${year + 1}`;
            yearSelect.appendChild(option);
        }
        // ClassicEditor
        //     .create(document.querySelector('#introduce'))
        //     .catch(error => {
        //         console.error(error);
        //     });
        // ClassicEditor
        //     .create(document.querySelector('#name'))
        //     .catch(error => {
        //         console.error(error);
        //     });
        // ClassicEditor
        //     .create(document.querySelector('#target'))
        //     .catch(error => {
        //         console.error(error);
        //     });
        // ClassicEditor
        //     .create(document.querySelector('#request'))
        //     .catch(error => {
        //         console.error(error);
        //     });
        // ClassicEditor
        //     .create(document.querySelector('#references'))
        //     .catch(error => {
        //         console.error(error);
        //     });
    </script>
@endsection
