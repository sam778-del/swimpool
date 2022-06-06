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
            <h3>Dal <font style=color:white; >10.06.2022</font>  al <font style=color:white; >10.06.2022</font>. Seleziona i tuoi posti... poi clicca sul pulsante in basso per prenotare</h3>
         </center>
      </div>
      <center>
         <h3 style=color:#000099; >
            Lettini liberi per il periodo selezionato:<br><br>
            Mattina: 165 Lettini liberi<br>
            Pomeriggio: 165 Lettini liberi<br>
            Giornata intera: 165 Lettini liberi<br>
         </h3>
      </center>
      <form method=get action=insert/aggiungiprenotazione1bisdaombrellonecliente.php target=_self >
         <input type=hidden name=arrivo class=mac readonly value=10/06/2022  >
         <input type=hidden name=partenza class=mac readonly value=10/06/2022 >
         <center>
         <H1 style=color:#270099; ><img src=./images/logo.png style=width:100px; />&nbsp;&nbsp;SOLARIUM PIANO SUPERIORE</H1>
         <table  style="margin-left:30px;border-collapse:collapse;width:90%;" >
            @foreach($data['column'] as $key => $column)
                <tr style="border:0px;  " >
                    @foreach($data['row'] as $key => $row)
                        @if($row->type == 'lettino')

                        @elseif ($row->type == 'ombrellone')

                        @elseif ($row->type == '-1' || $row->type == '-')

                        @elseif ($row->type == 'gazebo')
                            <td ALIGN=CENTER  style="height:40px; background:transparent;; padding-left:0px; border:0px;   margin:0px; border-width:0; padding:2px;" >
                                <center><font style="font-size:10px;"> <span style="background:transparent;">
                                    <img  style="background:transparent;" src=images/ico-gazebo.png width=30px height=30px style="  " title="555"
                                        onclick="document.getElementById('224').click(); "    />
                                    <br>555<br><input type=checkbox style="width:20px;height:20px;" name=224 id="224" />
                                    <label for="224" ></label></span>
                                    </font>
                                </center>
                            </td>
                        @elseif($row->type == 'passerella' && $column->type == 'passerella')
                            <td align="CENTER" style="height:40px; background:transparent; padding-left:0px; border:0px; MIN-WIDTH:20PX; background: transparent url(images/passerella.png) top left;border-radius:0px 0px 0px 0px;  margin:0px; border-width:0; padding:2px;">
                                <center><font style="font-size:10px;"></font></center>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    </body>
</html>
