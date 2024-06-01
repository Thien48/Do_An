@extends('admin.main')

@section('content')
    <div class="card card-primary mt-2">
        <div class="card-header">
            <h2 >Danh sách đề xuất đề tài</h2>
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
                            <th>Tên giảng viên</th>
                            <th>Ngày đề xuất</th>
                            <th>Học Kì</th>
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
                                <td>{{ $data->name }}</td>
                                <td>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->proposed_date)->format('d-m-Y') }}
                                </td>
                                <td>{{  $data->year }}</td>
                                <td style="width:600px">{!! htmlspecialchars_decode($data->name_proposal) !!}</td>
                                
                                <td>{{ $data->name_subject }}</td>
                                <td class="{{ $data->status == 0 ? 'text-danger' : 'text-success' }}">{{ $data->status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</td>
                                <td>
                                    <a href="/admin/proposal/detail/{{ $data->proposal_form_id }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-12 mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $proposal->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </form>
    </div>

    <!-- /.row -->
    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa đề tài này?");
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
