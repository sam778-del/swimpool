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
		<fieldset style="width:400px;padding:20px;border-radius:15px 120px 15px 120px;background:transparent url('images/frecce-destra.png')bottom right no-repeat;">
			<legend style="background:white;border-radius:60px;padding:20px;margin-left:-50px;font-family:arial;">PRENOTA UN OMBRELLONE</LEGEND>
			<form method=get action=vistagiornoricercacliente.php target=_self>
				<table style="background:transparent;border:0px;">
					<tr>
						<td align=right style="background:transparent;border:0px;float:left;">
							<input type=text readonly name=arrivo class=mac id="datepicker" size=8 onchange="javascript:cambiadata();" value=02/06/2022 style="border-radius:40px;padding:10px;padding-left:80px;float:left;background:white url('./images/dal.png') top left no-repeat;">
							<input type=hidden readonly name=partenza class=mac id="datepicker2" size=8 value=02/06/2022 style="float:left;border-radius:40px;padding:10px;background:white url('./images/al.png') top left no-repeat;">
							<tr>
								<td colspan=4 style="background:transparent;border:0px;">
									<input type=checkbox name=gdpr id="myCheck" /><font style="color:blue;">Privacy art. 13 e 14 del GDPR - Regolamento UE 2016/679</font>
									<br>
									<input type=image height=40px src="https://www.gorizianuoto.cloud/images/vai.png" /> </table>
			</form>
			<br>
			<br>
			<fieldset style="padding:20px;border-radius:15px 120px 15px 120px;">
				<legend style="background:white;border-radius:60px;padding:20px;margin-left:-50px;font-family:arial;">VERIFICA PRENOTAZIONE</legend>
				<form method=post action="./paypal/verificamail.php">
					<input type=text name=lamail onchange="javascript:controllatesto(this);" style="margin-left:30px;float:left;border-radius:40px;padding:10px;padding-left:80px;background:white url('./images/emailinput.png') top left no-repeat; " />
					<input type=image height=40px src="https://www.gorizianuoto.cloud/images/vai.png" /> </form>
			</fieldset>
		</fieldset>
		<br>
    </center>
</body>
</html>

