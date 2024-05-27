@extends('lecturer.main')
<link rel="stylesheet" href="/template/css/admin/index.css">
@section('content')
<div class="card card-primary mt-2">
    <div class="card-header">
        <h3 >Chào mừng {{ $name->name }}.
            <small class="float-right">Ngày: {{ $formattedDateTime }}</small></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="card-body">
        @if ($now < $registrationStartTime)
        <div class="d-flex justify-content-center">
            <div>
                <h1 class="text-center display-4 font-weight-bold" style="color: #FF6B6B; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                    Chưa tới ngày đăng kí
                </h1>
                <p class="text-center display-5 font-italic" style="color: #2980B9;">
                    Vui lòng quay lại vào ngày: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $registrationStartTime)->format('d-m-Y')  }}
                </p>
            </div>
        </div>
        @elseif ($now > $registrationEndTime)
            <div class="d-flex justify-content-center">
                <div>
                    <h1 class="text-danger text-center display-4">Đã hết thời gian đăng kí đề xuất đề tài </h1>
                    <h3 class="text-center display-5 font-italic" style="color: #2980B9;">
                        Giảng viên  vui lòng liên hệ admin để thêm
                    </h3>
                </div>
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
                            <th>Ngày đề xuất</th>
                            <th>Ngày duyệt</th>
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
                                <td>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->proposed_date)->format('d-m-Y') }}
                                </td>
                                <td>
                                    @if ($data->approval_date != null)
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->approval_date)->format('d-m-Y') }}
                                    @endif
                                </td>
                                <td style="width:700px">{!! htmlspecialchars_decode($data->name_proposal) !!}</td>
                                <td>{{ $data->name_subject }}</td>
                                <td class="{{ $data->status == 0 ? 'text-danger' : 'text-success' }}">
                                    {{ $data->status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</td>
                                <td>
                                    
                                    <a href="/lecturer/proposal/detail/{{ $data->proposal_form_id }}"
                                        class="btn btn-info"><i class="fas fa-eye"></i></a>
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
        @else
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
                            <th>Ngày đề xuất</th>
                            <th>Ngày duyệt</th>
                            <th>Tên</th>
                            <th>Loại đề tài</th>
                            <th>Tình trạng</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposal as $data)
                            <tr>
                                <td>{{ ($proposal->currentPage() - 1) * $proposal->perPage() + $loop->iteration }}
                                    @if ($data->feedback != null)
                                    <span class="badge badge-warning" title="Có phản hồi mới">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                @endif
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->proposed_date)->format('d-m-Y') }}
                                </td>
                                <td>
                                    @if ($data->approval_date != null)
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->approval_date)->format('d-m-Y') }}
                                    @endif
                                </td>
                                <td style="width:700px">{!! htmlspecialchars_decode($data->name_proposal) !!} </td>
                                <td>{{ $data->name_subject }}</td>
                                <td class="{{ $data->status == 0 ? 'text-danger' : 'text-success' }}">
                                    {{ $data->status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</td>
                                <td>
                                    <a href="/lecturer/proposal/edit/{{ $data->proposal_form_id }}"
                                        class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="/lecturer/proposal/detail/{{ $data->proposal_form_id }}"
                                        class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('destroyProposal', ['id' => $data->proposal_form_id]) }}"
                                        onclick="return confirmDelete()" class="btn btn-danger"><i
                                            class="fas fa-trash"></i></a>
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
        @endif
    </div>

    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa đề tài này?");
        }
    </script>
@endsection
