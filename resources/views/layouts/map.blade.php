<html>
   <head>
      <title>RICERCA</title>
      <link href="https://fonts.googleapis.com/css?family=Raleway" type="text/css" rel="stylesheet">
      <meta name="web_author" content="Falcione Gianluca">
      <link rel="shortcut icon" type="image/png" href="./favicon.ico" />
      <link href="/style.css" rel="stylesheet" type="text/css">
      <script type="text/javascript" src="/javascript.js"></script>
      <META HTTP-EQUIV="Expires" CONTENT="0">
      <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
      <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
      <title>:: ::</title>
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
      <style>
        td {
            width: 30%
        }
        
         input[type=checkbox] + label {
         display: block;
         margin: 0.2em;
         cursor: pointer;
         padding: 0.2em;
         margin-top: -30px;
         z-index: 2;
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
        <center>
            <table style="margin-left:30px;border-collapse:collapse;width:90%;">
                @yield('content')
            </table>
        <center>
   </body>
</html>
