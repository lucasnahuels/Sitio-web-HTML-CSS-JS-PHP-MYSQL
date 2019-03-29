<!DOCTYPE html>
<html> 
<head>
	<title> Baja profesor</title>
	<style type="text/css">
		
		body{
			text-align: center;
			background: url('../html/Crossfit-Wallpaper.jpg');
		}

		h1{
			color:#efb810;
			font-weight: bold;
			font-size: 30px;	
			margin-left: 0px;
			background-color: black;
			display: inline;
			position: relative;
			top: 20px;
		}

		p {
			color: white;
			position: relative;
			top: 00px;
			font-size: 15px;
			font-weight: bold;
			background-color: black;
			display: inline;
		}

		label {
			font-weight: bold;
			color: white;
			background-color: black;
		}

		#botonbaja, #boton2{
			font-size:10px;
	        font-family:Verdana,Helvetica;
	        font-weight:bold;
	        color:black;
	        background:#efb810;
	        border:4px solid black;
	        width:100px;
	        height:30px;
		}

	</style>
</head>

<body>

<a style="position:absolute; top:10px; right:20px ;color:white; font-weight: bold; font-size: 20px"  href="../Controllers/logoutgym.php"> Cerrar sesión</a>

<h1> Página de baja a profesor del establecimiento</h1>
<br/><br/><br/><br/>
<p>Ingrese el nombre y apellido del profesor al que le quiere dar de baja en el establecimiento</p>
<br/><br/><br/><br/>
	<form action="" method="post" id="myform" onsubmit="return enviar()">

		<label for="a">Nombre: </label>
		<input type="text" name="nombreprof" size="30" maxlength="50" placeholder="Acepta solamente letras" id="a"> <br/><br/>

		<label for="b">Apellido: </label>
		<input type="text" name="apellidoprof" size="30" maxlength="50" placeholder="Acepta solamente letras" id="b"><br/><br/>
		
		<input type="submit" name="Enviar" id="botonbaja">
	</form>
<br/>
	<?php //<input type="button" name="volver" value="Volver sin enviar" id="boton2" style="width:130px;"> //PREGUNTAR POR ESTO?>
	<a href="../Controllers/paginainicio.php" id="boton2" style=" display:inline-block; text-align: center; height:21px" >Volver sin enviar</a>


<script type="text/javascript">
	
	function enviar(){	
		var pregunta=confirm('¿Esta seguro de que desea ENVIAR los registros seleccionados?');

		var formulario = document.getElementById("myform");	
		
	 
		if (pregunta){
			
			alert("Enviando el formulario");
			formulario.submit();
			return true;
		}
		 else {
			
			alert("No se envía el formulario");
			return false;
		}
	}

</script>
	
</body>