@extends('layouts.layout')

@section('content')
<div class="container pt-5 pb-4">
	<div class="row">
	   <div class="col-md-6 col-lg-6 col-xl-6 mx-auto">
		  <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
			 <form id="postForm" method="POST" action="{{ url('check-valid') }}">
				@csrf
				 <div class="col-md-4 col-lg form-group">
					 <label>DAL:</label>
					 <input id="startDate" name="arrivo" type="text" value="{{ date('d-m-Y') }}" class="form-control" required placeholder="DAL:" autocomplete="off">
				 </div>
				 <div class="col-md-4 col-lg form-group">
					<select class="form-control" name="day">
						<option value="soccer1" >Soccer 1</option>
						<option value="soccer2" >Soccer 2</option>
						<option value="tennis" >Tennis</option>
					</select>
				</div>
				 <div class="col-md-4 col-lg form-group">
					 <select class="form-control" name="day">
						 <option value="1" >GIORNATA INTERA 9:00-18:00</option>
						 <option value="2" >MATTINA 9:00-13:00</option>
						 <option value="3" >POMERIGGIO 13:30-18:00</option>
					 </select>
				 </div>
				<div class="row my-12">
				   <div class="col">
					  <div class="form-check text-2 custom-control custom-checkbox">
						 <input id="remember-me" name="remember" class="custom-control-input" type="checkbox">
						 <label class="custom-control-label" for="remember-me"><p>Ho letto ed accetto il regolamento prenotazioni on line e l'informativa sulla privacy,
							 <br>ed acconsento al trattamento
							 dei dati personali.
						   </p></label>
					  </div>
				   </div>
				</div>
				<button class="btn btn-primary btn-block my-4" type="submit">PRENOTA ONLINE</button>
			 </form>
		  </div>
	   </div>
	</div>
 </div>
@endsection

@push('scripts')
<script src="{{ asset('front/moment.min.js') }}"></script>
<script src="{{ asset('front/daterangepicker.js') }}"></script>
<script>

	$('#startDate').daterangepicker({
		singleDatePicker: true,
		autoApply: true,
		minDate: moment(),
		autoUpdateInput: false,
	}, function(chosen_date) {
		$('#startDate').val(chosen_date.format('DD-MM-YYYY'));
        $('#endDate').val(chosen_date.format('DD-MM-YYYY'));
	});

	$('#endDate').daterangepicker({
		singleDatePicker: true,
		autoApply: true,
		minDate: moment(),
		autoUpdateInput: false,
	}, function(chosen_date) {
		$('#endDate').val(chosen_date.format('DD-MM-YYYY'));
	});

	$('button[type="submit"]').click(function(e) {
		e.preventDefault();
		if($('#remember-me').prop("checked"))
		{
			if ( $('form')[0].checkValidity() ){
				$(this).html('Convalida della tua richiesta....');
				$(this).attr('disabled', 'disabled');
			}
			$('#postForm').submit();
		}else{
			alert("Per proseguire accettare la privacy");
		}
	});
</script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\BookRequest', '#postForm') !!}
@endpush
