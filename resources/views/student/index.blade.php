@extends('student.main')
@section('contentStudent')
    <div class="invoice p-3 mb-3" >
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
        <div class="row invoice-info">
            <!-- /.col -->
            <div class="col-sm-12 invoice-col">
                
            </div>
        </div>
    @endsection
