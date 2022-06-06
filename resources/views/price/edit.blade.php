@extends('layouts.app')

@section('page-title', __('Crea cliente') )

@push('stylesheets')
<link rel="stylesheet" href="{{ asset("/css/dropify.min.css") }}">
@endpush

@section('page-content')
<div class="row g-3 row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open(["route" => ["price.update", $price->id], "method" => "PATCH", "id" => "submit-form", "enctype" => "multipart/form-data"]) !!}
                {{-- <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Nome') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::text('nome', $price->type, ["class" => "form-control form-control-lg"]) !!}
                    </div>
                </div> --}}
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Fullday Amount') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::number('fullday_amount', $price->fullday_amount, ["class" => "form-control form-control-lg"]) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Morning Amount') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::number('morning_amount', $price->morning_amount, ["class" => "form-control form-control-lg"]) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Tel:') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::number('afternoon_amount', $price->afternoon_amount, ["class" => "form-control form-control-lg"]) !!}
                    </div>
                </div>

                <div class="row">
                    <table class="table align-middle mb-0 card-table" cellspacing="0">
                        <div class="col-12">
                            <thead>
                                <div class="col-xl-3 col-sm-3">
                                    <th>{{ __('Date')  }}</th>
                                </div>
                                <div class="col-xl-3 col-sm-3">
                                    <th>{{ __('Nome') }}</th>
                                </div>
                                <div class="col-xl-3 col-sm-3">
                                    <th>{{ __('Amount') }}</th>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <th class="text-center">Action</th>
                                </div>
                            </thead>
                        </div>
                        <div class="col-12">
                            <tbody>
                                @forelse ($extraprice as $item)
                                    <tr class="item-row">
                                        <td class="text-center">
                                            <div class="col-xl-12 col-sm-12">
                                                {!! Form::date('date[]', $item->date, ["class" => "form-control form-control-lg"]) !!}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="row">
                                                <div class="col-xl-12 col-sm-12">
                                                    {!! Form::text('order_name[]', $item->order_name, ["class" => "form-control form-control-lg"]) !!}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="row">
                                                <div class="col-xl-12 col-sm-12">
                                                    {!! Form::number('amount[]', $item->amount, ["class" => "form-control form-control-lg"]) !!}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button href="javascript:void(0);" type="button"  onclick="addButton();" class="btn btn-link btn-lg color-400"><i class="fa fa-plus-circle"></i></button>
                                            <button href="javascript:void(0);" type="button" onclick="removeButton(this)" class="btn btn-link btn-lg color-400"><i class="fa fa-minus-circle"></i></button>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr class="item-row">
                                            <td class="text-center">
                                                <div class="col-xl-12 col-sm-12">
                                                    {!! Form::date('date[]', null, ["class" => "form-control form-control-lg"]) !!}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="row">
                                                    <div class="col-xl-12 col-sm-12">
                                                        {!! Form::text('order_name[]', null, ["class" => "form-control form-control-lg"]) !!}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="row">
                                                    <div class="col-xl-12 col-sm-12">
                                                        {!! Form::number('amount[]', null, ["class" => "form-control form-control-lg"]) !!}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button href="javascript:void(0);" type="button"  onclick="addButton();" class="btn btn-link btn-lg color-400"><i class="fa fa-plus-circle"></i></button>
                                                <button href="javascript:void(0);" type="button" onclick="removeButton(this)" class="btn btn-link btn-lg color-400"><i class="fa fa-minus-circle"></i></button>
                                            </td>
                                        </tr>
                                @endforelse
                            </tbody>
                        </div>
                    </table>
                </div>
                <br>
                <div class="row">
                    <label class="col-xl-2 col-sm-3 col-form-label"></label>
                    <div class="col-sm-8">
                        <button class="btn btn-lg bg-secondary text-light text-uppercase" type="submit">{{ __('Creare') }}</button>
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

    function addButton()
    {
        $(document).ready(function() {
            $(".item-row:last").after('                                        <tr class="item-row">                                            <td class="text-center">                                                <div class="col-xl-12 col-sm-12">                                                    {!! Form::date('date[]', null, ["class" => "form-control form-control-lg"]) !!}                                                </div>                                            </td>                                            <td class="text-center">                                                <div class="row">                                                    <div class="col-xl-12 col-sm-12">                                                        {!! Form::text('order_name[]', null, ["class" => "form-control form-control-lg"]) !!}                                                    </div>                                                </div>                                            </td>                                            <td class="text-center">                                                <div class="row">                                                    <div class="col-xl-12 col-sm-12">                                                        {!! Form::number('amount[]', null, ["class" => "form-control form-control-lg"]) !!}                                                    </div>                                                </div>                                            </td>                                            <td class="text-center">                                                <button href="javascript:void(0);" type="button"  onclick="addButton();" class="btn btn-link btn-lg color-400"><i class="fa fa-plus-circle"></i></button>                                                <button href="javascript:void(0);" type="button" onclick="removeButton(this)" class="btn btn-link btn-lg color-400"><i class="fa fa-minus-circle"></i></button>                                            </td>                                        </tr>'); //add input box
        });
    }
    function removeButton(ele)
    {
        $(document).ready(function() {
            $(ele).parents('.item-row').remove();
        })
    }
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