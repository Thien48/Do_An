@extends('admin.main')
<link rel="stylesheet" href="/template/css/admin/index.css">

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
        <form action="" method="POST">
            @csrf
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ngày Đăng</th>
                            <th>Tên</th>
                            <th>Loại đề tài</th>
                            <th>Tình trạng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposal as $data)
                            <tr>
                                <td>{{ ($proposal->currentPage() - 1) * $proposal->perPage() + $loop->iteration }}</td>
                                <td>{{ $data->proposed_date }}</td>
                                <td style="width:700px">{!! htmlspecialchars_decode($data->name) !!}</td>
                                <td>{{ $data->subject_name }}</td>
                                <td>{{ $data->status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</td>
                                <td>
                                    <a href="/lecturer/proposal/edit/{{ $data->proposal_form_id }}" class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="/lecturer/proposal/detail/{{ $data->proposal_form_id }}" class="btn btn-info"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('destroyProposal', ['id' => $data->proposal_form_id]) }}"
                                        onclick="return confirmDelete()" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-12 mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $proposal->appends(request()->except('page'))->links() }}
                        {{-- {{ $data->render('vendor.pagination.custom') }} --}}
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </form>
    </div>

    <!-- /.row -->
    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa giảng viên này?");
        }
        // Select the input element
        const msgvInput = document.getElementById('msgv');

        // Add input event listener  
        msgvInput.addEventListener('input', function() {

            // Get input value
            let value = this.value;

            // Check if value length is greater than 10
            if (value.length > 10) {

                // Slice value to first 10 characters
                value = value.slice(0, 10);

                // Update input value
                this.value = value;

            }

        });
    </script>
@endsection
