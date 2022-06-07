<html>
   <head>
      <title>RICERCA</title>
      <link href="https://fonts.googleapis.com/css?family=Raleway" type="text/css" rel="stylesheet">
      <meta name="web_author" content="Falcione Gianluca">
      <link rel="shortcut icon" type="image/png" href="./favicon.ico"/>
      <link href="/style.css" rel="stylesheet" type="text/css">
      <script type="text/javascript" src="/javascript.js"></script>
      <META HTTP-EQUIV="Expires" CONTENT="0">
      <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
      <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
      <title>::  ::</title>
      <style type="text/css">
         @media print{  /*Regola dedicata alla visualizzazione su carta*/
         .nascondistampa{
         display:none;
         }
         body{ background:white; }
         table  th{background:white; color:black;}
         table tr,td{background:white !important; color:black !important;}
         }
      </style>
      <style>
         input[type=checkbox] + label {
         display: block;
         margin: 0.2em;
         cursor: pointer;
         padding: 0.2em;
         margin-top:-30px;
         z-index:2;
         }
         input[type=checkbox] {
         display: none;
         }
         input[type=checkbox] + label:before {
         content: "\2714";
         border: 0.1em solid transparent;
         border-radius: 5.0em;
         display: inline-block;
         width: 3em;
         height: 3em;
         padding-left: 0.2em;
         padding-bottom: 0.3em;
         margin-right: 0.2em;
         vertical-align: bottom;
         color: transparent;
         transition: .7s;
         }
         input[type=checkbox] + label:active:before {
         transform: scale(0);
         }
         input[type=checkbox]:checked + label:before {
         background-color: MediumSeaGreen;
         border-color: MediumSeaGreen;
         color: #fff;
         }
         input[type=checkbox]:disabled + label:before {
         transform: scale(1);
         border-color: transparent;
         }
         input[type=checkbox]:checked:disabled + label:before {
         transform: scale(1);
         background-color: #bfb;
         border-color: transparent;
         }
      </style>
   </head>
   <body style="background:#33CCCC;margin:0px;padding:0px;">
      <div style="color:#000099; width:95%;  z-index:1; padding:1px;background:transparent; " >
         <center>
            <h3>Dal <font style=color:white; >{{ date('d.m.Y', strtotime($_GET['arrivo'])) }}</font>  al <font style=color:white; >{{ date('d.m.Y', strtotime($_GET['partenza'])) }}</font>. Seleziona i tuoi posti... poi clicca sul pulsante in basso per prenotare</h3>
         </center>
      </div>
      <center>
         <h3 style=color:#000099; >
            Lettini liberi per il periodo selezionato:<br><br>
            Mattina: {{ count($data['mattina']) }} Lettini liberi<br>
            Pomeriggio: {{ count($data['pomeriggio']) }} Lettini liberi<br>
            Giornata intera: {{ count($data['giornata']) }} Lettini liberi<br>
         </h3>
      </center>
      <form method=get action="{{ url('aggiungiprenotazione1bisdaombrellonecliente') }}" target=_self >
         <input type=hidden name="arrivo" class="mac" readonly value="{{ $_GET['arrivo'] }}"  >
         <input type=hidden name="partenza" class="mac" readonly value="{{ $_GET['partenza'] }}" >
         <center>
         <H1 style=color:#270099; ><img src=./images/logo.png style=width:100px; />&nbsp;&nbsp;SOLARIUM PIANO SUPERIORE</H1>
         <table  style="margin-left:30px;border-collapse:collapse;width:90%;" >
            @php
                $counter = 0;   
            @endphp
            @foreach($data['column'] as $key => $column)
                <tr>
                    @foreach($data['row'] as $key => $row)
                        @php
                            $counter++;   
                            $sp = \App\Models\Specification::getOuterSpec($counter, $data['data']);     
                        @endphp
                        @if(!empty($sp))
                            @if($sp->type == 'lettino')
                                <td align="CENTER" style=" background:#FFFF99;border-radius:0px 80px 0px 0px;color:blue; padding-left:0px; border:0px;   margin:0px; border-width:0; padding:2px;">
                                    <center>
                                        <font style="font-size:10px;float:left;"> <span style="background:transparent;">
                                        <img style="background:transparent;" src="images/ico-lettino.png" width="20px" height="20px" title="{{ $sp->spec_id }}" onclick="document.getElementById('{{ $sp->spec_id}}').click(); ">
                                        <br>{{ $sp->spec_id }}<br><input type="checkbox" style="width:20px;height:20px;" value="{{ $sp->id }}" name="map_id[]" id="{{ $sp->id }}">
                                        <label for="{{ $sp->id }}"></label></span>
                                        </font>
                                    </center>
                                </td>
                            @elseif($sp->type == 'ombrellone')
                            <td align="CENTER" style=" background:#66CC66;border-radius:0px 80px 0px 0px;color:white; padding-left:0px; border:0px;   margin:0px; border-width:0; padding:2px;"><center><font style="font-size:10px;float:left;"> <span style="background:transparent;">
                                <img style="background:transparent;" src="images/ico-gazebo.png" width="30px" height="30px" title="77" onclick="document.getElementById('93').click(); ">
                                <br>77<br><input type="checkbox" style="width:20px;height:20px;" name="93" id="93">
                                    <label for="93"></label></span>
                            
                            </font></center></td>
                            @elseif($sp->type == '-')
                            <td align="CENTER" style="height:40px; background:#33CCCC; padding-left:0px; border:0px; MIN-WIDTH:20PX;border-radius:0px 0px 0px 0px;  margin:0px; border-width:0; padding:2px;">
                                <center><font style="font-size:10px;"></font></center>
                            </td>
                            @elseif($sp->type == '-1')
                                <td align="CENTER" style="height:40px; background:#33CCCC; padding-left:0px; border:0px; MIN-WIDTH:20PX;border-radius:0px 0px 0px 0px;  margin:0px; border-width:0; padding:2px;">
                                    <center><font style="font-size:10px;"></font></center>
                                </td>
                            @elseif($sp->type == 'gazebo')
                                <td align="CENTER" style=" background:#66CC66;border-radius:0px 80px 0px 0px;color:white; padding-left:0px; border:0px;   margin:0px; border-width:0; padding:2px;">
                                    <center><font style="font-size:10px;float:left;"> <span style="background:transparent;">
                                    <img style="background:transparent;" src="images/ico-lettino.png" width="30px" height="30px" title="77" onclick="document.getElementById('{{ $sp->id }}').click(); ">
                                    <br>{{ $sp->spec_id }}<br><input type="checkbox" style="width:20px;height:20px;" name="map_id[]" value="{{ $sp->id }}" id="{{ $sp->id }}">
                                    <label for="{{ $sp->id }}"></label></span>
                                    </font>
                                    </center>
                                </td>
                            @else
                                <td align="CENTER" style="height:40px; background:transparent; padding-left:0px; border:0px; MIN-WIDTH:20PX; background: transparent url(images/passerella.png) top left;border-radius:0px 0px 0px 0px;  margin:0px; border-width:0; padding:2px;">
                                    <center><font style="font-size:10px;"></font></center>
                                </td>
                            @endif
                        @else
                            <td align="CENTER" style=" background:red;border-radius:0px 80px 0px 0px;color:red; padding-left:0px; border:0px;   margin:0px; border-width:0; padding:2px;">
                                <center><font style="font-size:10px;float:left;"> <span style="background:transparent;">
                                <img style="background:transparent;" src="images/ico-lettino.png" width="30px" height="30px">
                                </font>
                                </center>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
        <input type=hidden name="price_type" value="{{ $_GET['giornata'] }}" />
         <input type=submit value=PRENOTA style="height:100px; width:300px;font-size:40px;" />
    </body>
</html>
