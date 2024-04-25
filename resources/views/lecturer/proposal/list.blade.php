@extends('lecturer.main')
<link rel="stylesheet" href="/template/css/admin/index.css">

@section('content')
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Chào mừng {{ $name->name }}.
                    <small class="float-right">Date: {{ $formattedDateTime }}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">

            </div>
            <!-- /.col -->
            <div class="col-sm-12 invoice-col">
                <div class="row">
                </div>
            </div>
        </div>

        <!-- Table row -->
        <div class="row mt-2">
            <div class="col-12 table-responsive">

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <script>
            function confirmDelete() {
                return confirm("Bạn có chắc chắn muốn xóa đề tài này?");
            }
        </script>
    @endsection
