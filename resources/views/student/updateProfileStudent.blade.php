@extends('student.main')

@section('contentStudent')
    <div class="card card-primary">
        <div class="card-header">
            <h3>{{ __('Cập nhập thông tin cá nhân') }}</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ Route('updateProfileStudent') }}" enctype="multipart/form-data">
                @csrf
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email"
                            value="{{ $name->user->email }}" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="mssv" class="col-md-4 col-form-label text-md-right">{{ __('MSSV') }}</label>

                    <div class="col-md-6">
                        <input id="mssv" type="text" class="form-control" name="mssv" value="{{ $name->mssv }}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tên') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $name->name }}"
                            required>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Lớp') }}</label>

                    <div class="col-md-6">
                        <input id="class" type="text" class="form-control" name="class" value="{{ $name->class }}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Giới tính') }}</label>

                    <div class="col-md-6">
                        <select id="gender" class="form-control" name="gender" required>
                            <option value="1" {{ $name->gender ? 'selected' : '' }}>Nam</option>
                            <option value="0" {{ !$name->gender ? 'selected' : '' }}>Nữ</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Số điện thoại') }}</label>

                    <div class="col-md-6">
                        <input id="telephone" type="tel" class="form-control" name="telephone"
                            value="{{ $name->telephone }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Ảnh đại diện') }}</label>

                    <div class="col-md-6">
                        <input id="image" type="file" class="form-control-file" name="image"
                            value="{{ $newImage }}">
                        <img src="{{ asset('avatar/' . $name->image) }}" alt="Avatar" style="max-width: 100px;">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Cập nhật') }}
                        </button>
                        <a href="{{Route('profileStudent')}}" class="btn btn-danger">Quay lại</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
