@extends('admin.main')

@section('content')
    <div class="card card-primary mt-3" >
        <div class="card-header">
            <h3>Thông báo</h3>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('send.notification') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title">Tiêu đề:</label><br>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <select name="recipient" class="form-control w-50">
                                <option value="student">Học sinh</option>
                                <option value="lecturer">Giảng viên</option>
                              </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="content">Nội dung:</label><br>
                            <textarea id="content" class="form-control" name="content" rows="5" required>
                            </textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Gửi thông báo</button>
            </form>
        </div>
    </div>

    <script>
         ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
@endsection
