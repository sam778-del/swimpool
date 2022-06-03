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

    .btn {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }

    .btn-primary {
        border-radius: 16px
    }
	</style>
  <center>
    <img src=https://www.gorizianuoto.cloud/images/logo.png  /><center>
        <fieldset style="width:90%;border-radius:20px;">
            <legend><h3>{{ $data['start_date'] }} - {{ date('d/m/Y', strtotime($data['end_date'])) }}</h3> </legend>
            <table style=width:90%;>
                @php
                    $total_price = 0;
                    $begin = new \DateTime( date('Y-m-d', strtotime($data['start_date']) ));
                    $end = new DateTime( date('Y-m-d', strtotime($data['end_date'])) );
                    $end = $end->modify( '+1 day' );
                    $interval = new \DateInterval('P1D');
                    $daterange = new \DatePeriod($begin, $interval ,$end);
                @endphp


                <?php $final_amount = 0 ?>
                @foreach($daterange as $date)
                    @php
                        $ConverDate = date("l", strtotime($date->format('Y-m-d')));
                        $ConverDateTomatch = strtolower($ConverDate);
                        if(($ConverDateTomatch == "saturday" )|| ($ConverDateTomatch == "sunday")){
                            $weekend = true;
                        } else {
                            $weekend = false;
                        }
                    @endphp
                    <?php
                        $total_amount = 0;
                    ?>

                    <tr>
                        @if(isset($_GET['price_type']) && $_GET['price_type'] == 1)
                            <td colspan=3 style="{{ $weekend == true ? 'padding:10px;background:orange;color:white;' : 'padding:10px;background:grey;color:white;' }}">Venerd&igrave; {{ $date->format('d.m.Y') }} <font><br><i>&#187; Giornata intera 9:00-18:00</i></font>
                                @foreach (json_decode($data['map']) as $key => $item)
                                @php
                                    $accessory = \App\Models\Accesory::find($_GET['accesory_id'][$key]);
                                    $priceType = $_GET['price_type'];
                                    if($accessory)
                                    {
                                        $accessoryAmount = $accessory->amount;
                                    }else{
                                        $accessoryAmount = 0;
                                    }
                                    if($ConverDateTomatch == "saturday")
                                    {
                                        $price = $item->maps->saturday_price  + $accessoryAmount;
                                    }elseif($ConverDateTomatch == "sunday"){
                                        $price = $item->maps->sunday_price  + $accessoryAmount;
                                    }else{
                                        if($priceType == 1)
                                        {
                                            $price = $item->maps->full_day_price + $accessoryAmount;
                                        }
                                        else if($priceType == 2){
                                            $price = $item->maps->morning_price + $accessoryAmount;
                                        }
                                        else if($priceType == 3){
                                            $price = $item->maps->afternoon_price + $accessoryAmount;
                                        }
                                    }
                                    $final_amount += $price;
                                @endphp
                                    <tr>
                                        <td style=padding:20px;><img src="{{ asset('images/ico-lettino.png') }}" style=width:30px; /> {{ $item->type }} {{ $item->lettini_number }} {{ !empty($accessory->name) ? 'Con '.$accessory->name  : '' }}</td>
                                        <td style=padding:20px; >&euro; {{ $price }}</td>
                                    </tr>
                                @endforeach
                            </td>
                        @elseif(isset($_GET['price_type']) && $_GET['price_type'] == 2)
                            <td colspan=3 style="{{ $weekend == true ? 'padding:10px;background:orange;color:white;' : 'padding:10px;background:grey;color:white;' }}">Venerd&igrave; {{ $date->format('d.m.Y') }} <font><br><i>&#187; MATTINA 9:00-13:00</i></font>
                                @foreach (json_decode($data['map']) as $key => $item)
                                @php
                                    $accessory = \App\Models\Accesory::find($_GET['accesory_id'][$key]);
                                    $priceType = $_GET['price_type'];
                                    if($accessory)
                                    {
                                        $accessoryAmount = $accessory->amount;
                                    }else{
                                        $accessoryAmount = 0;
                                    }
                                    if($ConverDateTomatch == "saturday")
                                    {
                                        $price = $item->maps->saturday_price  + $accessoryAmount;
                                    }elseif($ConverDateTomatch == "sunday"){
                                        $price = $item->maps->sunday_price  + $accessoryAmount;
                                    }else{
                                        if($priceType == 1)
                                        {
                                            $price = $item->maps->full_day_price + $accessoryAmount;
                                        }
                                        else if($priceType == 2){
                                            $price = $item->maps->morning_price + $accessoryAmount;
                                        }
                                        else if($priceType == 3){
                                            $price = $item->maps->afternoon_price + $accessoryAmount;
                                        }
                                    }
                                    $final_amount += $price;
                                @endphp
                                    <tr>
                                        <td style=padding:20px;><img src="{{ asset('images/ico-lettino.png') }}" style=width:30px; /> {{ $item->type }} {{ $item->lettini_number }} {{ !empty($accessory->name) ? 'Con '.$accessory->name  : '' }}</td>
                                        <td style=padding:20px; >&euro; {{ $price }}</td>
                                    </tr>
                                @endforeach
                            </td>
                        @elseif(isset($_GET['price_type']) && $_GET['price_type'] == 3)
                            <td colspan=3 style="{{ $weekend == true ? 'padding:10px;background:orange;color:white;' : 'padding:10px;background:grey;color:white;' }}">Venerd&igrave; {{ $date->format('d.m.Y') }} <font><br><i>&#187; POMERIGGIO 13:30-18:00</i></font>
                                @foreach (json_decode($data['map']) as $key => $item)
                                @php
                                    $accessory = \App\Models\Accesory::find($_GET['accesory_id'][$key]);
                                    $priceType = $_GET['price_type'];
                                    if($accessory)
                                    {
                                        $accessoryAmount = $accessory->amount;
                                    }else{
                                        $accessoryAmount = 0;
                                    }
                                    if($ConverDateTomatch == "saturday")
                                    {
                                        $price = $item->maps->saturday_price  + $accessoryAmount;
                                    }elseif($ConverDateTomatch == "sunday"){
                                        $price = $item->maps->sunday_price  + $accessoryAmount;
                                    }else{
                                        if($priceType == 1)
                                        {
                                            $price = $item->maps->full_day_price + $accessoryAmount;
                                        }
                                        else if($priceType == 2){
                                            $price = $item->maps->morning_price + $accessoryAmount;
                                        }
                                        else if($priceType == 3){
                                            $price = $item->maps->afternoon_price + $accessoryAmount;
                                        }
                                    }
                                    $final_amount += $price;
                                @endphp
                                    <tr>
                                        <td style=padding:20px;><img src="{{ asset('images/ico-lettino.png') }}" style=width:30px; /> {{ $item->type }} {{ $item->lettini_number }} {{ !empty($accessory->name) ? 'Con '.$accessory->name  : '' }}</td>
                                        <td style=padding:20px; >&euro; {{ $price }}</td>
                                    </tr>
                                @endforeach
                            </td>
                        @endif
                    </tr>
                @endforeach
                <tr style=padding:20px; ><th style="padding:20px;"   ><b>Totale</b>
                    <td style="padding:20px;background:green;color:white;" colspan=100% ><b>&euro; {{ $final_amount }}</b></table>     <br><br>
                </tr>
            </table>
            <br>
            <a class="btn btn-primary" href="{{ route('stripe.payment') }}?accesory_id={{ json_encode($_GET['accesory_id']) }}&numerodipersone={{ $_GET['numerodipersone'] }}&price_type={{ $_GET['price_type'] }}&map_id={{ json_encode($_GET['map_id']) }}&from={{ $_GET['from'] }}&to={{ $_GET['to'] }}&final_amount={{ $final_amount }}">Pay With Stripe</a>
        </fieldset>
</body>
</html>
