@extends('layouts.app')
@section('page-title', !empty($_GET['arrivo']) ? 'SITUAZIONE DEL '.date('d/m', strtotime($_GET['arrivo'])) : '' )
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
	background-color: #e4c61c;
	/* Green */
}
</style> @endpush @section('page-content')
<div class="row align-items-center" style="width: 100%">
    <div class="card" style="color:#000099; width:95%;  z-index:1; padding:5px;background:yellow; " >
        <center>
            <h3>Giorno {{ date('d.m', strtotime($_GET['arrivo'])) }} - Seleziona i tuoi posti... poi clicca sul pulsante in basso per prenotare</h3>
        </center>
    </div>
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="container-fluid">
            @php
                $tweleve_map = \DB::table('maps')->where('position', 12)->get();
                $twentyfour_map = \DB::table('maps')->where('position', 24)->get();
                $fourty_map = \DB::table('maps')->where('position', 42)->get();
                $ten_map = \DB::table('maps')->where('position', 10)->get();
                $six_map = \DB::table('maps')->where('position', 6)->limit(6)->get();
                $one_map = \DB::table('maps')->where('position', 1)->limit(1)->get();
                $seven_map = \DB::table('maps')->where('position', 7)->limit(7)->get();
            @endphp
            <form method=get action="{{ url('aggiungiprenotazione1bisdaombrellonecliente') }}" target=_self >
                <input type=hidden name="arrivo" class=mac readonly value="{{ date('d/m/Y', strtotime($_GET['arrivo'])) }}"  >
                <input type=hidden name="partenza" class=mac readonly value="{{ date('d/m/Y', strtotime($_GET['partenza'])) }}" >
                <div class="row">
                    <div class="col-4">
                        <div class="dd card fieldset border border-primary mb-5">
                            <div class="project-members mb-4">
                                @foreach($tweleve_map as $key => $item)
                                    <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                                    <span style="background:#00CCCC;">
                                        <input type="image" style="background:transparent;" src="{{ asset('images/ico-ombrellone.png') }}" width="50px" height="49px">
                                        <input type="checkbox" name="id" value="{{ $item->id }}">
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-2" style="background-image: url('images/passerella.png'); border:0px;">
                    </div>
                    <div class="col-6">
                        <div class="dd card fieldset border border-primary mb-5">
                            <div class="project-members mb-4">
                                @foreach($twentyfour_map as $key => $item)
                                <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                                <span style="background:#00CCCC;">
                                <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="56px" height="49px" title="45">
                                <input type="checkbox" name="{{ $item->id }}"></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-11" style="background-image: url('images/passerella.png'); border:0px;">
                    </div>
                    <div class="col-1">
                        <div class="dd card fieldset border border-primary mb-5">
                            <div class="project-members mb-2">
                                @foreach($one_map as $key => $item)
                                <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                                <span style="background:#00CCCC;">
                                <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="45px" height="49px" title="45">
                                <input type="checkbox" name="{{ $item->id }}"></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="dd card fieldset border border-primary mb-5">
                            <div class="project-members mb-4">
                                @foreach($fourty_map as $key => $item)
                                <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                                <span style="background:#00CCCC;">
                                <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="50px" height="49px" title="45">
                                <input type="checkbox" name="{{ $item->id }}"></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-6" style="background-image: url('images/sfondoacquapiscina.jpg'); border:0px;">
                        {{-- <td style="background-image: url('images/sfondoacquapiscina.jpg'); border:0px;"></td> --}}
                    </div>
                    <div class="col-1">
                        <div class="dd card fieldset border border-primary mb-5">
                            <div class="project-members mb-2">
                                @foreach($ten_map as $key => $item)
                                <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                                <span style="background:#00CCCC;">
                                <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="56px" height="49px" title="45">
                                <input type="checkbox" name="{{ $item->id }}"></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="dd card fieldset border border-primary mb-5">
                            <div class="project-members mb-2">
                                @foreach($six_map as $key => $item)
                                <font style="font-size:10px;">GAZEBO {{ $item->gazebo_number }}</font>
                                <span style="background:#00CCCC;">
                                <input type="image" style="background:transparent;" src="images/ico-gazebo.png" width="45px" height="49px" title="45">
                                <input type="checkbox" name="{{ $item->id }}"></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <center>
                        <div class="col-5 text-center">
                            <div class="dd card fieldset border border-primary mb-5">
                                <div class="project-members mb-4">
                                    @foreach($seven_map as $key => $item)
                                    <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                                    <span style="background:#00CCCC;">
                                    <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="50px" height="49px" title="45">
                                    <input type="checkbox" name="{{ $item->id }}"></span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                <center>
                    <br><br>
                    <input type="submit" value="PRENOTA" style="height:100px; width:300px;font-size:40px;">
                </center>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>

    </script>
@endpush
