@extends('lecturer.main')
<link rel="stylesheet" href="/template/css/admin/index.css">
@section('content')
    <div class="invoice p-3 mb-3 mt-2">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Chào mừng {{ $name->name }}.
                    <small class="float-right">Ngày: {{ $formattedDateTime }}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <form action="{{ route('searchProposal') }}" method="GET">
            <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                    <div class="row">
                        <div class="col-2">
                            <label for="nameSR">Tên đề tài</label>
                            <input type="text" name="nameSR" id="nameSR" class="form-control"
                                placeholder="Tìm kiếm...">
                        </div>
                        <div class="col-3">
                            <label for="subjectSR">Loại đề tài</label>
                            <select name="subjectSR" id="subjectSR" class="form-control">
                                <option value=""></option>
                                @foreach ($subjectOTP as $item)
                                <option value="{{ $item->id }}"
                                    {{ request('subjectSR') == $item->id ? 'selected' : '' }}>
                                    {{ $item->subject_name }}</option>
                            @endforeach
                            </select>
                        </div> 
                    </div>
                </div>
                <div class="col-sm-12 col-12 invoice-col d-flex justify-content-end">
                    <div class="input-group justify-content-end">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary rounded"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="button_add ml-2">
                            <a href='/lecturer/proposal/add' class="btn btn-success"><i class="fas fa-user-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Table row -->
        <div class="row mt-2">
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
            <div class="col-12">
                <div class="col-12 d-flex justify-content-center">
                    {{ $proposal->appends(request()->except('page'))->links() }}
                    {{-- {{ $data->render('vendor.pagination.custom') }} --}}
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa đề tài này?");
        }
    </script>
@endsection
