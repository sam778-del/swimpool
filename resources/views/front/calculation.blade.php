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
            <legend><h3>{{ date('d/m/Y', strtotime($data['start_date'])) }} - {{ date('d/m/Y', strtotime($data['end_date'])) }}</h3> </legend>
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
                        <td colspan=3 style="{{ $weekend == true ? 'padding:10px;background:orange;color:white;' : 'padding:10px;background:grey;color:white;' }}">{!! \App\Models\Specification::getDay($date->format('d.m.Y'), $_GET['price_type'], $ConverDate) !!}</font>
                            @foreach ($data['map'] as $key => $item)
                                @php
                                    $accessory = \App\Models\Accesory::find($_GET['accesory_id'][$key]);
                                    if($accessory)
                                    {
                                        $accessoryAmount = $accessory->amount;
                                    }else{
                                        $accessoryAmount = 0;
                                    }
                                    $price = \App\Models\Specification::getPrice($item->type, $date->format('Y-m-d'), $_GET['price_type']);
                                    $final_amount += $price + $accessoryAmount;
                                @endphp
                                <tr>
                                    <td style=padding:20px;><img src="{{ asset('images/ico-lettino.png') }}" style=width:30px; /> {{ $item->type }} {{ $item->spec_id }} {{ !empty($accessory->name) ? 'Con '.$accessory->name  : '' }}</td>
                                    <td style=padding:20px; >&euro; {{ $price + $accessoryAmount }}</td>
                                </tr>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                <tr style=padding:20px; ><th style="padding:20px;"   ><b>Totale</b>
                    <td style="padding:20px;background:green;color:white;" colspan=100% ><b>&euro; {{ $final_amount }}</b></table>     <br><br>
                </tr>
            </table>
            <br>
            @if($final_amount > 0.0)
                <a class="btn btn-primary" href="{{ route('stripe.payment') }}?accesory_id={{ implode(",",$_GET['accesory_id']) }}&numerodipersone={{ $_GET['numerodipersone'] }}&price_type={{ $_GET['price_type'] }}&map_id={{ json_encode($_GET['map_id']) }}&from={{ $_GET['from'] }}&to={{ $_GET['to'] }}&final_amount={{ $final_amount }}">Pay With Stripe</a>
            @endif
        </fieldset>
</body>
</html>
