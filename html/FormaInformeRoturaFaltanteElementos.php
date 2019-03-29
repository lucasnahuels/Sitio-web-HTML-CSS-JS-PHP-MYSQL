
<!DOCTYPE html>
<html> 
<head>
	<title> Informe rotura o faltante de elementos</title>
	<style type="text/css">
		 
		 body{
			text-align: left;
			background: url('../html/fondo2.jpg');
			background-size: 60%;
		}

		#titulo{
			background-color: black;
			color:white;
			text-align: center;
			display: inline;
			margin-left: 440px;
			font-size: 40px;
		}

		label{
			margin-left: 600px;
			background-color: black;
			font-weight: bold;
			font-size: 18px;
			color: white;
		}

		input, textarea, select{
			background-color:#cb3234;
			font-weight: bold;
			border-color: black;
		}

		input::placeholder, textarea::placeholder{
			color: black;
			font-weight: lighter;
		}



		#submit{
			margin-left: 700px;
			background-color:#cb3234;
			border-color: black;
			font-weight: bold;
			padding-left: 10px;
			padding-right: 10px;
		}

	</style>
</head>

<body>

<h1 id="titulo"> Informe rotura o faltante de elementos </h1>

<a style="position:absolute; top:10px; left:20px ;color:red; font-weight: bold; font-size: 20px; background-color: black;"  href="paginainicio.php"> Volver ←</a>

<a style="position:absolute; top:10px; right:20px ;color:red; font-weight: bold; font-size: 20px; background-color: black;"  href="../Controllers/logoutgym.php"> Cerrar sesión</a>

<br/><br/><br/><br/>

<form action="" method="POST" id="myform" onsubmit="return enviar()">

<label for="a">Fecha informe: </label> <input type="text" id="a" name="FechaInforme" placeholder="formato dd/mm/aaaa"> <br/><br/>
<label for="b">Hora informe: </label> <input type="text" id="b" name="HoraInforme" placeholder="formato 00:00:00 segundos no obligatorios"> <br/><br/>
<label for="c">Nombre elemento: </label> <select name="CodigoProducto">
												<?php foreach($this->productos as $pr) { ?>
													<option value="<?= $pr['codigo_producto'] ?>"> <?= $pr['nombre'] ?> </option> 
												<?php } ?>
											</select> <br/><br/>
<label for="d">Detalle o novedad: </label> <textarea id="d" name="Detalle_Novedad" placeholder="Hasta 140 caracteres"  maxlength="140"> </textarea> <br/><br/><br/>
<input type="submit" id="submit" name="submitInforme">

</form>

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
</html>