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
                $ten_map = \DB::table('maps')->where('position', 10)->get();
                $six_map = \DB::table('maps')->where('position', 6)->limit(6)->get();
                $one_map = \DB::table('maps')->where('position', 1)->limit(1)->get();
                $seven_map = \DB::table('maps')->where('position', 7)->limit(7)->get();
            @endphp
            <div class="row">
                <div class="col-4">
                    <div class="dd card fieldset border border-primary mb-5">
                        <div class="project-members mb-4">
                            @foreach($tweleve_map as $key => $item)
                                <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                                <span style="background:#00CCCC;" onclick="viewModalMap({{ $item->id }})">
                                    <input type="image" style="background:transparent;" src="{{ asset('images/ico-ombrellone.png') }}" width="50px" height="49px">
                                    <input type="checkbox" name="187">
                                </span>
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
                            <span style="background:#00CCCC;" onclick="viewModalMap({{ $item->id }})">
                            <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="56px" height="49px" title="45">
                            <input type="checkbox" name="187"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-11">
                </div>
                <div class="col-1">
                    <div class="dd card fieldset border border-primary mb-5">
                        <div class="project-members mb-2">
                            @foreach($one_map as $key => $item)
                            <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                            <span style="background:#00CCCC;" onclick="viewModalMap({{ $item->id }})">
                            <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="45px" height="49px" title="45">
                            <input type="checkbox" name="187"></span>
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
                            <span style="background:#00CCCC;" onclick="viewModalMap({{ $item->id }})">
                            <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="50px" height="49px" title="45">
                            <input type="checkbox" name="187"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-6">
                </div>
                <div class="col-1">
                    <div class="dd card fieldset border border-primary mb-5">
                        <div class="project-members mb-2">
                            @foreach($ten_map as $key => $item)
                            <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                            <span style="background:#00CCCC;" onclick="viewModalMap({{ $item->id }})">
                            <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="56px" height="49px" title="45">
                            <input type="checkbox" name="187"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <div class="dd card fieldset border border-primary mb-5">
                        <div class="project-members mb-2">
                            @foreach($six_map as $key => $item)
                            <font style="font-size:10px;">{{ $item->lettini_number }}</font>
                            <span style="background:#00CCCC;" onclick="viewGazeboModalMap({{ $item->id }})">
                            <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="45px" height="49px" title="45">
                            <input type="checkbox" name="187"></span>
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
                                <span style="background:#00CCCC;" onclick="viewModalMap({{ $item->id }})">
                                <input type="image" style="background:transparent;" src="images/ico-ombrellone.png" width="50px" height="49px" title="45">
                                <input type="checkbox" name="187"></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
    <div class="modal fade" id="CreateEvent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body custom_scroll p-lg-5">
                    <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row g-3 row-deck">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    {!! Form::open(["route" => ["table-map.store"], "method" => "POST", "id" => "submit-form", "enctype" => "multipart/form-data"]) !!}
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Lettini Number') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('lettini_number', null, ["class" => "form-control form-control-lg", "placeholder" => __('Lettini Number')]) !!}
                                            {!! Form::hidden('post_url', null, ["class" => "form-control form-control-lg", "placeholder" => __('Lettini Number')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Lettini Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('lettini_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Lettini Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Morning Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('morning_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Afternoon Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Afternoon Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('afternoon_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Afternoon Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Full Day Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('full_day_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Full Day Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Saturday Day Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('saturday_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Saturday Day Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Sunday Day Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('sunday_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Sunday Day Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Low Summer Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('low_summer_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Low Summer Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('High Summer Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('high_summer_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('High Summer Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-xl-2 col-sm-3 col-form-label"></label>
                                        <div class="col-sm-8">
                                            <button class="btn btn-lg bg-secondary text-light text-uppercase" type="submit">{{ __('Aggiornare') }}</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="CreateGazeboEvent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body custom_scroll p-lg-5">
                    <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row g-3 row-deck">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    {!! Form::open(["route" => ["table-map.store"], "method" => "POST", "id" => "submit-gazebo", "enctype" => "multipart/form-data"]) !!}
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Gazebo Number') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('gazebo_number', null, ["class" => "form-control form-control-lg", "placeholder" => __('Gazebo Number')]) !!}
                                            {!! Form::hidden('post_url', null, ["class" => "form-control form-control-lg", "placeholder" => __('Lettini Number')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Gazebo Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('gazebo_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Gazebo Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Morning Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('morning_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Afternoon Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Afternoon Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('afternoon_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Afternoon Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Full Day Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('full_day_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Full Day Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Saturday Day Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('saturday_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Saturday Day Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Sunday Day Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('sunday_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Sunday Day Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('Low Summer Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('low_summer_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('Low Summer Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-xl-2 col-sm-3 col-form-label">{{ __('High Summer Price') }} *</label>
                                        <div class="col-xl-8 col-sm-9">
                                            {!! Form::number('high_summer_price', null, ["class" => "form-control form-control-lg", "placeholder" => __('High Summer Price')]) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-xl-2 col-sm-3 col-form-label"></label>
                                        <div class="col-sm-8">
                                            <button class="btn btn-lg bg-secondary text-light text-uppercase" type="submit">{{ __('Aggiornare') }}</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function viewModalMap(id)
        {
            $.ajax({
                url: '{{ url('showMap') }}'+'?id='+id,
                type: "GET",
                cache: false,
                data: null,
                success: function(data) {
                    $('#submit-form').attr('action', '{{ url('updateMap') }}'+'?id='+id);
                    $('input[name="lettini_number"]').val(data[0].lettini_number);
                    $('input[name="lettini_price"]').val(data[0].lettini_price);
                    $('input[name="morning_price"]').val(data[0]['maps'].morning_price);
                    $('input[name="afternoon_price"]').val(data[0]['maps'].afternoon_price);
                    $('input[name="full_day_price"]').val(data[0]['maps'].full_day_price);
                    $('input[name="saturday_price"]').val(data[0]['maps'].saturday_price);
                    $('input[name="sunday_price"]').val(data[0]['maps'].sunday_price);
                    $('input[name="low_summer_price"]').val(data[0]['maps'].low_summer_price);
                    $('input[name="high_summer_price"]').val(data[0]['maps'].hight_summer_price);
                    $('#CreateEvent').modal('show');
                }
            });
        }

        function viewGazeboModalMap(id)
        {
            $.ajax({
                url: '{{ url('showMap') }}'+'?id='+id,
                type: "GET",
                cache: false,
                data: null,
                success: function(data) {
                    $('#submit-gazebo').attr('action', '{{ url('updateGazeboMap') }}'+'?id='+id);
                    $('input[name="gazebo_number"]').val(data[0].gazebo_number);
                    $('input[name="gazebo_price"]').val(data[0].gazebo_price);
                    $('input[name="morning_price"]').val(data[0]['maps'].morning_price);
                    $('input[name="afternoon_price"]').val(data[0]['maps'].afternoon_price);
                    $('input[name="full_day_price"]').val(data[0]['maps'].full_day_price);
                    $('input[name="saturday_price"]').val(data[0]['maps'].saturday_price);
                    $('input[name="sunday_price"]').val(data[0]['maps'].sunday_price);
                    $('input[name="low_summer_price"]').val(data[0]['maps'].low_summer_price);
                    $('input[name="high_summer_price"]').val(data[0]['maps'].hight_summer_price);
                    $('#CreateGazeboEvent').modal('show');
                }
            });
        }

        // $('button[type="submit"]').on('click', function(e) {
        //     e.preventDefault();
        //     var id = $('input[name="post_url"]').val();
        //     .submit();
        // });
    </script>
@endpush
