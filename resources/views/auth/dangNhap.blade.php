<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Roboto', sans-serif;
        }

        .login-box {
            width: 400px;
            margin: 80px auto;
        }

        .login-logo b {
            color: #007bff;
            font-size: 24px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .input-group-text {
            background-color: #007bff;
            color: #fff;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .text-center img {
            width: 150px;
            height: 150px;
        }

        .login-footer {
            margin-top: 20px;
        }

        .toggle-password {
            cursor: pointer;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Trang đăng nhập</b>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="text-center mb-4">
                    <img src="/images/logo_ntu.jpg" alt="Logo NTU">
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Mật Khẩu" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <button type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1 text-center">
                    <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                </p>
                <p class="mb-0 text-center login-footer">
                    Bạn chưa có tài khoản? <a href="{{ route('student.register') }}">Đăng ký</a>
                </p>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.classList.toggle("fa-eye-slash");
    });
</script>
</html>
