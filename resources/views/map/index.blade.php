@extends('layouts.app')

@section('page-title', __('Elenco operatori') )

@push('stylesheets')
    <link href="https://fonts.googleapis.com/css?family=Raleway" type="text/css" rel="stylesheet">
    <style>
        #note {
            text-align: center;
        }

        .btn {
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 16px;
        }

        .btn-danger {
            background-color: #e4c61c; /* Green */
        }
    </style>
@endpush

@section('page-content')
<div class="card" style="color:#000099; width:100%;  z-index:1; padding:5px;background:yellow; " id="note" >
    <div class="card-body border-bottom">
        <div class="row align-items-center">
            <div class="col-6">
                <a href="{{ url('/home') }}" class="btn btn-primary">
                    {{ __('Pannello di controllo') }}
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route("operator.create") }}" class="btn btn-primary">
                    {{ __('Mantieni l\'ordine') }}
                </a>
            </div>
        </div>
    </div>
</div> 
<div class="row">

</div>
@endsection