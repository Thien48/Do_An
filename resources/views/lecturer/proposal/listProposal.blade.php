@extends('lecturer.main')
@section('content')
<div class="card card-primary mt-2">
    <div class="card-header">
        <h3 >Danh sách đề tài
            <small class="float-right">Ngày: {{ $formattedDateTime }}</small></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="card-body">
            <!-- info row -->
            <form action="{{ route('searchProposalListProposal') }}" method="GET">
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
                                            {{ $item->name_subject }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12 invoice-col d-flex justify-content-end">
                        <div class="input-group justify-content-end">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary rounded"><i
                                        class="fas fa-search"></i></button>
                            </div>
                            <div class="button_add ml-2">
                                <a href='/lecturer/proposal/add' class="btn btn-success"><i
                                        class="fas fa-user-plus"></i></a>
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
                            <th>Giảng viên</th>
                            <th>Tên đề tài</th>
                            <th>Loại đề tài</th>
                            <th>Tình trạng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposal as $data)
                            <tr>
                                <td>{{ ($proposal->currentPage() - 1) * $proposal->perPage() + $loop->iteration }}
                                </td>
                                <td>
                                    {{$data->lecturer->name}}
                                </td>
                                <td style="width:700px">{!! htmlspecialchars_decode($data->name_proposal) !!} </td>
                                <td>{{ $data->name_subject }}</td>
                                <td class="{{ $data->status == 0 ? 'text-danger' : 'text-success' }}">
                                    {{ $data->status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</td>
                                <td>
                                    <a href="/lecturer/proposal/detail/{{ $data->topic_proposal_id }}"
                                        class="btn btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-12">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $proposal->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa đề tài này?");
        }
    </script>
@endsection
