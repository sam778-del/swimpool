@extends('layouts.app')

@section('page-title', __('Modifica Accessory') )

@push('stylesheets')
<link rel="stylesheet" href="{{ asset("/css/dropify.min.css") }}">
@endpush

@section('page-content')
<div class="row g-3 row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open(["route" => ["accessory.update", $accesory->id], "method" => "PATCH", "id" => "submit-form", "enctype" => "multipart/form-data"]) !!}
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Name') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::text('name', $accesory->name, ["class" => "form-control form-control-lg", "placeholder" => __('Name')]) !!}
                        {!! Form::hidden('system_id', $accesory->id, null) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Amount') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::number('amount', $accesory->amount, ["class" => "form-control form-control-lg", "placeholder" => __('Amount')]) !!}
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
