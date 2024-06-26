<!DOCTYPE html>
<html lang="en">

<head>
    @include('student.head')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @if (Session::has('successLogin'))
                <li class="nav-item">
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('successLogin') }}
                    </div>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Đăng Xuất</button>
                    </form>
                </li>
            </ul>
        </nav>
        @include('student.sidebar')
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    @include('admin.alert')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            @yield('contentStudent')
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer text-center bg-secondary">
            <p class="m-0">Trường Đại Học Nha Trang (Nha Trang University)</p>
            <p class="m-0">Số 02 Nguyễn Đình Chiểu - Nha Trang - Khánh Hòa</p>
            <p class="m-0"> Tel : 0583 831 149 Fax: 0583 831 147</p>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('student.footer')
</body>

</html>
