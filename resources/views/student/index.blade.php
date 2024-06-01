@extends('student.main')
@section('contentStudent')
    <div class="card card-primary mt-3">
        <div class="card-header">
            <h3> Sinh Viên đăng kí đề tài.
                <small class="float-right">Ngày: {{ $formattedDateTime }}</small>
            </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">
            @if ($now < $registration_start_date)
                <div class="d-flex justify-content-center">
                    <div>
                        <h3 class="text-center display-4 font-weight-bold"
                            style="color: #FF6B6B; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                            Chưa tới ngày đăng kí đề tài
                        </h3>
                        <h4 class="text-center display-5 font-italic" style="color: #2980B9;">
                            Vui lòng quay lại vào ngày:
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $registration_start_date)->format('d-m-Y') }}
                        </h4>
                    </div>
                </div>
            @elseif ($now > $registration_end_date)
                @if ($instruct != null)
                    <div class="d-flex justify-content-center">
                        <div>
                            <h3 class="text-danger text-center display-4">Đã hết thời gian đăng kí đề tài.</h3>

                            <h4 class="text-center display-5 font-italic" style="color: #2980B9;">
                                Thời gian làm đề tài từ ngày:
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $instruct_start_date)->format('d-m-Y') }}
                                Đến ngày:
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $instruct_end_date)->format('d-m-Y') }}
                            </h4>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Giảng viên</th>
                                <th>Tên đề tài</th>
                                <th>Tên sinh viên thực hiện</th>
                                <th>Loại đề tài</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $instruct->lecturer->name }}</td>
                                <td style="width:700px">{!! htmlspecialchars_decode($instruct->topic->topicProposal->name_proposal) !!}</td>
                                <td>{{ $instruct->student->name }}</td>
                                <td>{{ $instruct->topic->topicProposal->subjectType->name_subject }}</td>
                                <td>
                                    <a href="/student/proposal/detail/{{ $instruct->topic_id }}" class="btn btn-info"><i
                                            class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <div class="d-flex justify-content-center">
                        <div>
                            <h3 class="text-danger text-center display-4">Đã hết thời gian đăng kí đề tài.</h3>

                            <h4 class="text-center display-5 font-italic" style="color: #2980B9;">
                                Thời gian làm đề tài từ ngày:
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $instruct_start_date)->format('d-m-Y') }}
                                Đến ngày:
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $instruct_end_date)->format('d-m-Y') }}
                            </h4>
                        </div>
                    </div>
                @endif
            @else
                <!-- Info row -->
                <form action="" method="GET">
                    <div class="row invoice-info">
                        <div class="col-sm-12 invoice-col">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <div>
                                        <h3 class="text-center display-4 font-weight-bold"
                                            style="color: #FF6B6B; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                                            Thời hạn đăng kí
                                        </h3>
                                        <h4 class="text-center display-5 font-italic" style="color: #2980B9;">
                                            Từ ngày:
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $registration_start_date)->format('d-m-Y') }}
                                            Đến ngày:
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $registration_end_date)->format('d-m-Y') }}
                                        </h4>
                                    </div>
                                </div>
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
                <form action="" method="POST">
                    <div class="row mt-2">
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

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Giảng viên</th>
                                    <th>Tên đề tài</th>
                                    <th>Loại đề tài</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topic as $data)
                                    <tr>
                                        <td>{{ ($topic->currentPage() - 1) * $topic->perPage() + $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{!! htmlspecialchars_decode($data->name_proposal) !!}</td>
                                        <td>{{ $data->name_subject }}</td>
                                        <td>
                                            @if ($registeredTopics->contains('topic_id', $data->topic_id))
                                                <a href="{{ route('studentUnregister', ['topic_id' => $data->topic_id]) }}"
                                                    class="btn btn-danger">Hủy đăng ký</a>
                                            @elseif(!$hasRegisteredTopic  && !in_array($data->topic_id, $allRegisteredTopics))
                                                <a href="{{ route('studentRegister', ['topic_id' => $data->topic_id]) }}"
                                                    class="btn btn-success">Đăng ký</a>
                                            @endif
                                            <a href="/student/proposal/detail/{{ $data->topic_id }}"
                                                class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            @endif
        </div>
        <!-- /.card-body -->
        @if ($now > $registration_start_date && $now < $registration_end_date)
            <div class="card-footer">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $topic->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
