@extends('layouts.app')

@section('page-title', __('Modifica operatore') )

@push('stylesheets')
<link rel="stylesheet" href="{{ asset("/css/dropify.min.css") }}">
@endpush

@section('page-toolbar')
<div class="row mb-3 align-items-center">
    <div class="col">
       <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="{{ url("/") }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item"><a class="text-secondary" href="{{ route("operator.index") }}">{{ __('Operatore') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Modifica') }}</li>
       </ol>
    </div>
</div>
 <!-- .row end -->
@endsection

@section('page-content')
<div class="row g-3 row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open(["route" => ["operator.update", $operator->id], "method" => "PATCH", "id" => "submit-form", "enctype" => "multipart/form-data"]) !!}
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Customer Name') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::text('operator_name', $operator->name, ["class" => "form-control form-control-lg", "placeholder" => __('Operator Name')]) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Operator Email') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::email('operator_email', $operator->email, ["class" => "form-control form-control-lg", "placeholder" => __('Operator Email')]) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Confirm Operator Password') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        <select name="parent_id" class="form-control form-control-lg">
                            <option value="1" {{ $operator->id == 1 ? 'selected' : '' }}>Operator</option>
                            <option value="0" {{ $operator->id == 0 ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Operator Password') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::password('operator_password', ["class" => "form-control form-control-lg", "placeholder" => __('Operator Password')]) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Confirm Operator Password') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::password('confirm_operator_password', ["class" => "form-control form-control-lg", "placeholder" => __('Confirm Operator Password')]) !!}
                    </div>
                </div>
                <div class="row">
                    <label class="col-xl-2 col-sm-3 col-form-label"></label>
                    <div class="col-sm-8">
                        <button class="btn btn-lg bg-secondary text-light text-uppercase" type="submit">{{ __('Modifica') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset("/bundles/dropify.bundle.js") }}"></script>
<script>
    $(function() {
        $('.dropify').dropify();
        $('#dropify-event').dropify();
    });
</script>
<script>
    $('button[type="submit"]').on("click", function(e) {
        e.preventDefault();
        var myForm = document.getElementById('submit-form');
        $('button[type="submit"]').prop("disabled", true);
        myForm.submit();
    });
</script>
@endpush