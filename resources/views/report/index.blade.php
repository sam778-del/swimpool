@extends('layouts.app')

@push('stylesheets')
<link rel="stylesheet" href="{{ asset('css/daterangepicker.min.css') }}">
@endpush

@section('page-content')
<div class="container-fluid">
    <div class="col-lg-12 col-md-12">
        <div class="card-body border-bottom">
            <div class="row align-items-center">
                <div class="col">
                </div>
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
                    <div class="input-group">
                        <input class="form-control" type="text" name="daterange">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Order Report</h6>
            </div>
            <div class="card-body">
                <div id="analytics"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#analytics').html('<center><span class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span></center>');
        });
    </script>
    <script src="{{ asset('bundles/daterangepicker.bundle.js') }}"></script>
    <script>
    // date range picker
        $(function() {
            $('input[name="daterange"]').daterangepicker({
            opens: 'left'
            }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        })
    </script>
@endpush