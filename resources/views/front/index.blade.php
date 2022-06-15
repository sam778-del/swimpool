@extends('layouts.layout')

@section('content')
<div class="container pt-5 pb-4">
	<div class="row">
	   <div class="col-md-6 col-lg-6 col-xl-6 mx-auto">
		  <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
			 <form id="postForm" method="POST" action="{{ url('calcolaprezzocliente') }}">
				@csrf
				 <div class="col-md-4 col-lg form-group">
					 <label>Numero di persone:</label>
					 <select class="form-control" name=numerodipersone>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				 </div>
				 <input type=hidden name="price_type" value="{{ $data['giorbata'] }}" />
				 <input type="hidden" name="map_id" value="{{ $map_id }}" />
				 <input type=hidden name="from" value="{{ $data['arrivo'] }}" />
				 <input type=hidden name="to" value="{{ $data['partenza'] }}" />
				<button class="btn btn-primary btn-block my-4" type="submit">PROCEDI</button>
			 </form>
		  </div>
	   </div>
	</div>
 </div>
@endsection

@push('scripts')
	
@endpush