@extends('layouts.app')

@section('page-title', __('Crea cliente') )

@push('stylesheets')
<link rel="stylesheet" href="{{ asset("/css/dropify.min.css") }}">
@endpush

@section('page-toolbar')
<div class="row mb-3 align-items-center">
    <div class="col">
       <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="{{ url("/") }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item"><a class="text-secondary" href="{{ route("client.index") }}">{{ __('Cliente') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Create') }}</li>
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
                {!! Form::open(["route" => ["client.store"], "method" => "POST", "id" => "submit-form", "enctype" => "multipart/form-data"]) !!}
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Cognome') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::text('first_name', null, ["class" => "form-control form-control-lg"]) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Nome:') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::text('last_name', null, ["class" => "form-control form-control-lg"]) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Email:') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::email('email', null, ["class" => "form-control form-control-lg"]) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Tel:') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::number('mobile_number', null, ["class" => "form-control form-control-lg"]) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Documento:') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::text('document', null, ["class" => "form-control form-control-lg"]) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Residenza:') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        {!! Form::text('residence', null, ["class" => "form-control form-control-lg"]) !!}
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Provincia:') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        <select name="province" class="form-control">
                            <option value="" selected>---SCEGLI PROVINCIA---</option>
                            <option value="AG">Agrigento</option>
                            <option value="AL">Alessandria</option>
                            <option value="AN">Ancona</option>
                            <option value="AO">Aosta</option>
                            <option value="AR">Arezzo</option>
                            <option value="AP">Ascoli Piceno</option>
                            <option value="AT">Asti</option>
                            <option value="AV">Avellino</option>
                            <option value="BA">Bari</option>
                            <option value="BL">Belluno</option>
                            <option value="BN">Benevento</option>
                            <option value="BG">Bergamo</option>
                            <option value="BI">Biella</option>
                            <option value="BO">Bologna</option>
                            <option value="BZ">Bolzano</option>
                            <option value="BS">Brescia</option>
                            <option value="BR">Brindisi</option>
                            <option value="CA">Cagliari</option>
                            <option value="CL">Caltanissetta</option>
                            <option value="CB">Campobasso</option>
                            <option value="CE">Caserta</option>
                            <option value="CT">Catania</option>
                            <option value="CZ">Catanzaro</option>
                            <option value="CH">Chieti</option>
                            <option value="CO">Como</option>
                            <option value="CS">Cosenza</option>
                            <option value="CR">Cremona</option>
                            <option value="KR">Crotone</option>
                            <option value="CN">Cuneo</option>
                            <option value="EN">Enna</option>
                            <option value="FE">Ferrara</option>
                            <option value="FI">Firenze</option>
                            <option value="FG">Foggia</option>
                            <option value="FO">Forl&igrave; - Cesena</option>
                            <option value="FR">Frosinone</option>
                            <option value="GE">Genova</option>
                            <option value="GO">Gorizia</option>
                            <option value="GR">Grosseto</option>
                            <option value="IM">Imperia</option>
                            <option value="IS">Isernia</option>
                            <option value="SP">La Spezia</option>
                            <option value="AQ">L'Aquila</option>
                            <option value="LT">Latina</option>
                            <option value="LE">Lecce</option>
                            <option value="LC">Lecco</option>
                            <option value="LI">Livorno</option>
                            <option value="LO">Lodi</option>
                            <option value="LU">Lucca</option>
                            <option value="MC">Macerata</option>
                            <option value="MN">Mantova</option>
                            <option value="MS">Massa Carrara</option>
                            <option value="MT">Matera</option>
                            <option value="ME">Messina</option>
                            <option value="MI">Milano</option>
                            <option value="MO">Modena</option>
                            <option value="NA">Napoli</option>
                            <option value="NO">Novara</option>
                            <option value="NU">Nuoro</option>
                            <option value="OR">Oristano</option>
                            <option value="PD">Padova</option>
                            <option value="PA">Palermo</option>
                            <option value="PR">Parma</option>
                            <option value="PV">Pavia</option>
                            <option value="PG">Perugia</option>
                            <option value="PS">Pesaro</option>
                            <option value="PE">Pescara</option>
                            <option value="PC">Piacenza</option>
                            <option value="PI">Pisa</option>
                            <option value="PT">Pistoia</option>
                            <option value="PN">Pordenone</option>
                            <option value="PZ">Potenza</option>
                            <option value="PO">Prato</option>
                            <option value="RG">Ragusa</option>
                            <option value="RA">Ravenna</option>
                            <option value="RC">Reggio Calabria</option>
                            <option value="RE">Reggio Emilia</option>
                            <option value="RI">Rieti</option>
                            <option value="RN">Rimini</option>
                            <option value="RM">Roma</option>
                            <option value="RO">Rovigo</option>
                            <option value="SA">Salerno</option>
                            <option value="SS">Sassari</option>
                            <option value="SV">Savona</option>
                            <option value="SI">Siena</option>
                            <option value="SR">Siracusa</option>
                            <option value="SO">Sondrio</option>
                            <option value="TA">Taranto</option>
                            <option value="TE">Teramo</option>
                            <option value="TR">Terni</option>
                            <option value="TO">Torino</option>
                            <option value="TP">Trapani</option>
                            <option value="TN">Trento</option>
                            <option value="TV">Treviso</option>
                            <option value="TS">Trieste</option>
                            <option value="UD">Udine</option>
                            <option value="VA">Varese</option>
                            <option value="VE">Venezia</option>
                            <option value="VB">Verbania-Cusio-Ossola</option>
                            <option value="VC">Vercelli</option>
                            <option value="VR">Verona</option>
                            <option value="VV">Vibo Valentia</option>
                            <option value="VI">Vicenza</option>
                            <option value="VT">Viterbo</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Gruppo Amici') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        <select name="friend_group" class="form-control form-control-lg">
                            <option value="" >---SCEGLI GRUPPO AMICI---</option>
                            <option value="parenti  50% + FREE BAR" > parenti  50% + FREE BAR </option>
                            <option value="soci club  -30% escluso mese di Agosto" > soci club  -30% escluso mese di Agosto </option>
                            <option value="tour operator  -10% se viaggio organizzato" > tour operator  -10% se viaggio organizzato </option>
                            <option value="abituali  prima fila garantita" > abituali  prima fila garantita </option>                                             
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Tipo:') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        <input  type=radio name="guy" value="Giovane" >Giovane<br>
                        <input  type=radio name="guy" value="Adulto" >Adulto<br>
                        <input  type=radio name="guy" value="Anziano" >Anziano
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Numero figli:') }} *</label>
                    <div class="col-xl-8 col-sm-9">
                        <select name="number_of_children" class="form-control" >
                            <option value=0 >0</option>
                            <option value=1 >1</option>
                            <option value=2 >2</option>
                            <option value=3 >3</option>
                            <option value=4 >4</option>
                            <option value=5 >5</option>
                            <option value=6 >6</option>
                            <option value=7 >7</option>
                            <option value=8 >8</option>
                            <option value=9 >9</option>
                            <option value=10 >10</option>
                        </select>
                    </div>
                </div>
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