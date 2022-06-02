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
  <center>
    <img src=https://www.gorizianuoto.cloud/images/logo.png  /><center>
        <fieldset style="width:90%;border-radius:20px;">
            <legend><h3>{{ $data['start_date'] }} - {{ date('d/m/Y', strtotime($data['end_date'])) }}</h3> </legend>
            <table style=width:90%;>
                @php
                    $total_price = 0;
                    $begin = new \DateTime(date('Y-m-d', strtotime($data['start_date'])));
                    $end = new DateTime( '2022-06-05' );
                    $end = $end->modify( '+1 day' ); 
                    $interval = new \DateInterval('P1D');
                    $daterange = new \DatePeriod($begin, $interval ,$end);
                @endphp

                {{-- @foreach (json_decode($data['map']) as $key => $item)
                    @php
                        $accessory = \App\Models\Accesory::find($_GET['accesory_id'][$key]);
                        
                        $priceType = $_GET['price_type'];
                        if($accessory)
                        {
                            $accessoryAmount = $accessory->amount;
                        }else{
                            $accessoryAmount = 0;
                        }

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

                        $total_price += $price;
                    @endphp      
                @endforeach --}}

                @foreach($daterange as $date)
                    <tr>
                        <td colspan=3 style="padding:10px;background:grey;color:white;">Venerd&igrave; {{ $date->format('d.m.Y') }} <font><br><i>&#187; Giornata intera 9:00-18:00</i></font>
                            @foreach (json_decode($data['map']) as $key => $item)
                                <tr>
                                    <td style=padding:20px;><img src="{{ asset('images/ico-lettino.png') }}" style=width:30px; /> Lettino 73</td>
                                    <td style=padding:20px; >&euro; 10</td>
                                </tr>
                            @endforeach
                        </td>
                    </tr>  
                @endforeach   
            </table>
        </fieldset>
</body>
</html>