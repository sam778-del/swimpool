@extends('layouts.app') @section('page-title', __('Elenco operatori') ) @push('stylesheets')
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
<div class="card" style="color:#000099; width:100%;  z-index:1; padding:5px;background:yellow; " id="note">
	<div class="card-body border-bottom">
		<div class="row align-items-center">
			<div class="col-6"> <a href="{{ url('/home') }}" class="btn btn-primary">
                    {{ __('Pannello di controllo') }}
                </a> </div>
			<div class="col-6"> <a href="{{ route("operator.create") }}" class="btn btn-primary">
                    {{ __('Mantieni l\'ordine') }}
                </a> </div>
		</div>
	</div>
</div>
<div class="row align-items-center">
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
        <div class="container-fluid">
            @php
                $tweleve_map = \DB::table('maps')->where('position', 12)->get();
                $twentyfour_map = \DB::table('maps')->where('position', 24)->get();
                $fourty_map = \DB::table('maps')->where('position', 42)->get();
            @endphp
            <div class="row">
                <div class="col-4">
                    <div class="dd card fieldset border border-primary mb-5">
                        <div class="project-members mb-4">
                            @foreach($tweleve_map as $key => $item)
                            <font style="font-size:10px;">45</font>
                            <span style="background:#00CCCC;">
                            <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="50px" height="49px" title="45">
                            <input type="checkbox" name="187"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-2">
                </div>
                <div class="col-6">
                    <div class="dd card fieldset border border-primary mb-5">
                        <div class="project-members mb-4">
                            @foreach($twentyfour_map as $key => $item)
                            <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                            <span style="background:#00CCCC;">
                            <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="56px" height="49px" title="45">
                            <input type="checkbox" name="187"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4">
                    <div class="dd card fieldset border border-primary mb-5">
                        <div class="project-members mb-4">
                            @foreach($fourty_map as $key => $item)
                            <font style="font-size:10px;">45</font>
                            <span style="background:#00CCCC;">
                            <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="50px" height="49px" title="45">
                            <input type="checkbox" name="187"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-2">
                </div>
                <div class="col-6">
                    <div class="dd card fieldset border border-primary mb-5">
                        <div class="project-members mb-4">
                            @foreach($twentyfour_map as $key => $item)
                            <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                            <span style="background:#00CCCC;">
                            <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="56px" height="49px" title="45">
                            <input type="checkbox" name="187"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection