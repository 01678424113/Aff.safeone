@extends('layouts.app-2')
@section('content')
    <style>
        .dataTables_filter {
            width: auto !important;
        }
    </style>
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats" style="background: #66BAB7;">
                <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                <h3>REGISTER</h3>
                <div class="count">220</div>
                <p>+ 50%</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats" style="background: #4183D7 ">
                <div class="icon"><i class="fa fa-comments-o"></i></div>
                <h3>REGISTER</h3>
                <div class="count">220</div>
                <p>+ 50%</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats" style="background: #00AA90">
                <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                <h3>REGISTER</h3>
                <div class="count">220</div>
                <p>+ 50%</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats" style="background: #F4B350;">
                <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                <h3>REGISTER</h3>
                <div class="count">220</div>
                <p>+ 50%</p>
            </div>
        </div>
    </div>
    <div class="row">
    </div>
@endsection
@push('script_default')
    <script>
        setTimeout(function () {
            $('#autoPopup').modal('show')
        }, 5000);
    </script>
@endpush
