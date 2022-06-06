<html>

<head>
	<title> :: AGGIUNGI NUOVA PRENOTAZIONE :: </title>
	<link href="https://fonts.googleapis.com/css?family=Raleway" type="text/css" rel="stylesheet">
	<meta name="web_author" content="Falcione Gianluca">
	<link rel="shortcut icon" type="image/png" href="https://www.preventivoistantaneo.it/booking-engine/demo/images/favicon.png" />
	<link href="https://www.gorizianuoto.cloud/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="https://www.gorizianuoto.cloud/javascript.js"></script>
	<META HTTP-EQUIV="Expires" CONTENT="0">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
	<title>:: Gorizia Nuoto ::</title>
	<style type="text/css">
	@media print {
		/*Regola dedicata alla visualizzazione su carta*/
		.nascondistampa {
			display: none;
		}
		body {
			background: white;
		}
		table th {
			background: white;
			color: black;
		}
		table tr,
		td {
			background: white !important;
			color: black !important;
		}
	}
	</style>
	<form method=get action="{{ url('calcolaprezzocliente') }}">
		<center>
			<br>
			<br>
			<fieldset style="width:600px;border-radius:20px;padding-bottom:60px;background:transparent url('../images/frecce-destra.png')bottom right no-repeat;">
				<legend>
					<h2>Scelta di eventuali accessori</h2></legend>
					@foreach ($maps as $item)
						<br>Scegli accessori per {{ $item->type }} {{ $item->spec_id }}:
							<select class="mac" name="accesory_id[]">
								<option value="">Nessun accessorio</option>
								@foreach (\DB::table('accesories')->get(); as $item)
									<option value="{{ $item->id }}">{{ $item->name }}</option>
								@endforeach
							</select>
						<br>
					@endforeach
				<br><img src="https://www.gorizianuoto.cloud/images/ico-parcheggio-coperto.png" />
				<br>Numero di persone:
				<select name=numerodipersone>
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
				<br>
				<br>
				<BR>
				<input type=hidden name="price_type" value="{{ $_GET['price_type'] }}" />
				<input type="hidden" name="map_id" value="{{ $map_id }}" />
				<input type=hidden name="from" value="{{ $_GET['arrivo'] }}" />
				<input type=hidden name="to" value="{{ $_GET['partenza'] }}" />
				<input type=submit value="PROCEDI" style="padding:20px;font-size:40px;" /> 
			</form>
		</fieldset>
	</center>
</body>
</html>