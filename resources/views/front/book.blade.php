<html>

<head>
	<title>:: Gorizia Nuoto ::</title>
	<link rel="stylesheet" href="{{ asset('front/jquery-ui.css') }}">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	//$.noConflict();
	jQuery(function() {
		var pickerOpts = {
			dateFormat: "dd/mm/yy",
			firstDay: 1,
			numberOfMonths: 3,
			minDate: 0,
			monthNames: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
			dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab']
		};
		jQuery("#datepicker").datepicker(pickerOpts);
		jQuery("#datepicker2").datepicker(pickerOpts);
		jQuery("#datepicker3").datepicker(pickerOpts);
	});

	function cercadisponibilita() {
		var dal = document.getElementById('datepicker').value;
		var al = document.getElementById('datepicker2').value;
		var idombrellone = document.getElementById('idombrellonejava').value;
		window.open("verificadisponibilitacabine.php?dal=" + dal + "&al=" + al + "&idombrellone=" + idombrellone, "_self", "top=20, left=20, width=400, height=450, status=no, menubar=no, toolbar=no, scrollbars=no");
	}

	function cambiadata() {
		var scelta = document.getElementById('datepicker').value;
		document.getElementById('datepicker2').value = scelta;
	}
	</script>
	<style type="text/css">
	::-webkit-scrollbar {
		width: 32px;
		height: 32px;
	}

	::-webkit-scrollbar-button {
		width: 22px;
		height: 22px;
	}

	::-webkit-scrollbar-thumb {
		background: #e1e1e1;
		border: 0px none #ffffff;
		border-radius: 50px;
	}

	::-webkit-scrollbar-thumb:hover {
		background: #c26016;
	}

	::-webkit-scrollbar-thumb:active {
		background: #ed6d10;
	}

	::-webkit-scrollbar-track {
		background: #666666;
		border: 0px none #ffffff;
		border-radius: 18px;
	}

	::-webkit-scrollbar-track:hover {
		background: #666666;
	}

	::-webkit-scrollbar-track:active {
		background: #333333;
	}

	::-webkit-scrollbar-corner {
		background: white;
	}
	</style>
	<script type="text/javascript">
	function controllatesto(xxx) {
		var iChars = "\n.-@1234567890�����QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm";
		var temp = "";
		for(var i = 0; i < xxx.value.length; i++) {
			if(iChars.indexOf(xxx.value.charAt(i)) < 0) {
				xxx.style.background = 'orange';
				xxx.focus();
				//return false;
				temp += " ";
				continue;
			}
			temp += xxx.value.charAt(i);
		}
		xxx.value = temp;
	}
	</script>
</head>

<body>
	<center>
		<center>



			<fieldset  style="width:80%;padding:20px;border-radius:6px;background:transparent url('images/frecce-destra.png')bottom right no-repeat;">
					<legend style="background:white;border-radius:60px;padding:20px;margin-left:-50px;font-family:arial;" >PRENOTAZIONE ONLINE</LEGEND> 
			  <form method=get action="{{ url('vistagiornoricercacliente') }}" id="submit-form" target=_self >
				 <table style="background:transparent;border:0px;">
				   <tr >
				   <td align=right  style="background:transparent;border:0px;">
				   <font style="float:right;" >DAL: </font>
				   
											 <td align=left style="background:transparent;border:0px;">
													   <input type=date required name=arrivo  onchange="document.getElementById('partenza').value=this.value;" style="width:300px;height:50px;font-size:20px;"  value="2022-06-02" />
											 
				   
					<tr >
				   <td align=right  style="background:transparent;border:0px;">
				   <font style="float:right;" >AL: </font>
				   
						   <td  align=left style="background:transparent;border:0px;">
								 <input type=date  required name=partenza style="width:300px;height:50px;font-size:20px;" id=partenza  value="2022-06-02" />
				   
				   
					<tr><td align=right  style="background:transparent;border:0px;">
				   <font style="float:right;" ></font>
				   
						   <td  align=left style="background:transparent;border:0px;">
							<br><select name=giornata  style="width:300px;height:50px;font-size:20px;" >
								 <option value=1 >GIORNATA INTERA 9:00-18:00</option>
								 <option value=2 >MATTINA 9:00-13:00</option>
								 <option value=3 >POMERIGGIO 13:30-18:00</option>
						   </select>
						   </center>
				   
				   <tr><td style="background:transparent;border:0px;height:50px;">&nbsp;
				  
				   <tr><td style="background:transparent;border:0px;"> 
				  <input type=checkbox name="gdpr" id="myCheck" required style="width:30px;height:30px;float:right;" />
				   <td colspan=3 style="background:transparent;border:0px;">
				   <font style="color:blue;font-size:16px;color:grey;font-family:'Arial';">
				   <a href=https://www.olimpiasport.it/privacy-policy/ target=_blank 
					 style="text-decoration:none;color:grey;" >Ho letto ed accetto il regolamento prenotazioni on line e l'informativa sulla privacy,
					 <br>ed acconsento al trattamento 
					 dei dati personali.
					</a></font>
				  
				  
				  
				  <tr><td colspan=3 >
				  <font style="color:blue;font-size:16px;color:grey;font-family:'Arial';">
				   <a href="#" target=_blank 
					 style="text-decoration:none;color:grey;" ><center>Leggi l'informativa sulla Privacy</center></a></font>
				  
				  
				  
				  <tr><td colspan=4 style="background:transparent;border:0px;">
				   <br> <br><br><center><a href=# id="checkMap" 
												 style="text-decoration:none;background:#3A8DD1;font-size:20px;color:white;border-radius:10px;padding:15px;">PRENOTA ONLINE</a> 
			   
				</table>
			   </form>
			   
			  
			   <br>
	</fieldset> 
    </center>

	<script>
		$('#checkMap').on('click', function(e) {
			e.preventDefault();
			if($('input[name="gdpr"]').is(':checked'))
			{
				var arrivo = $('input[name="arrivo"]').val();
				var partenza = $('input[name="partenza"]').val();
                $('#submit-form').submit();
				console.log(arrivo, partenza)
			 //window.location.href = '{{ url('/') }}';
			}else
			{
				alert('Per proseguire accettare la privacy');
			}
		});
	</script>
</body>
</html>

