@extends('admin.main')

@section('head')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3>Thông tin đề tài</h3>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('feedbackProposalPort', ['id' => $proposal->id]) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name_proposal">Tên đề tài</label>
                    <div class="pl-2">{!! $proposal->name_proposal !!}</div>
                </div>
                <div class="form-group">
                    <label for="target">Mục đích</label>
                    <div>{!! $proposal->target !!}</div>
                </div>
                <div class="form-group">
                    <label for="request">Yêu cầu</label>
                    <div>{!! $proposal->request !!}</div>
                </div>
                <div class="form-group">
                    <label for="references">Tài liệu tham khảo</label>
                    <div>{!! $proposal->references !!}</div>
                </div>
                <div class="form-group">
                    <label for="name_proposal">Giảng viên hướng dẫn</label>
                    <div class="pl-2">{{ $lecturer->name }}</div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class=" col-3">
                            <div> <strong>Email:</strong> {{ $lecturer->user->email }}</div>
                        </div>
                        <div class="col-3">
                            <div> <strong>Phone:</strong> {{ $lecturer->telephone }}</div>
                        </div>
                    </div>
                </div>
                <div class="group-form">
                    <div class="row">
                        <div class="col-3">
                            <div> <strong>Loại đề tài:</strong> {{ $subject->name_subject }}</div>
                        </div>
                        <div class="col-3">
                            <div> <strong>Năm học:</strong> {{ $proposal->year }}</div>
                        </div>
                    </div>
                </div>

             
                @if ($proposal->status != 1)
                <div class="form-group my-2">
                    <label for="feedback">Góp ý(Nếu có)</label>
                    <textarea name="feedback" id="feedback" class="form-control" cols="30" rows="5">{{ $proposal->feedback }}</textarea>
                </div>
                @endif

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="/admin/proposal/listProposal" class="btn btn-danger">Quay Lại</a>
                @if ($proposal->status != 1)
                    <a href="{{ route('approveProposal', ['id' => $proposal->id]) }}" class="btn btn-success">Duyệt</a>
                    @if ($proposal->feedback == null)
                    <button class="btn btn-primary"class="btn btn-primary" type="submit">Thêm góp ý</button>
                @else
                    <button class="btn btn-primary"class="btn btn-primary" type="submit">Cập nhập góp ý</button>
                @endif
                @endif

                
            </div>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#feedback'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
