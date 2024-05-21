@extends('student.main')
@section('contentStudent')
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Sinh Viên đăng kí đề tài.
                    <small class="float-right">Date: {{ $formattedDateTime }}</small>
                </h4>
            </div>
        </div>
        <!-- info row -->
        @if ($now < $registration_start_date)
            <div class="d-flex justify-content-center">
                <div>
                    <h1 class="text-center display-4 font-weight-bold"
                        style="color: #FF6B6B; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                        Chưa tới ngày đăng kí
                    </h1>
                    <p class="text-center display-5 font-italic" style="color: #2980B9;">
                        Vui lòng quay lại vào ngày:
                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $registration_start_date)->format('d-m-Y') }}
                    </p>
                </div>
            </div>
        @elseif ($now > $registration_end_date)
            <div class="d-flex justify-content-center">
                <div>
                    <h1 class="text-danger text-center display-4">Đã hết thời gian đăng kí đề xuất.</h1>
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
                            <th>Tên đề tài</th>
                            <th>Loại đề tài</th>
                            <th>Tình trạng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topic as $data)
                            <tr>
                                <td>{{ ($topic->currentPage() - 1) * $topic->perPage() + $loop->iteration }}</td>
                                <td style="width:700px">{!! htmlspecialchars_decode($data->name_proposal) !!}</td>
                                <td>{{ $data->name_subject }}</td>
                                <td class="{{ $data->status == 0 ? 'text-danger' : 'text-success' }}">
                                    {{ $data->status == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</td>
                                <td>
                                    <a href="/lecturer/proposal/edit/{{ $data->proposal_form_id }}"
                                        class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="/lecturer/proposal/detail/{{ $data->proposal_form_id }}"
                                        class="btn btn-info"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-12">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $topic->appends(request()->except('page'))->links() }}
                        {{-- {{ $data->render('vendor.pagination.custom') }} --}}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
