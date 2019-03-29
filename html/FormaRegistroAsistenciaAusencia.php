
<!DOCTYPE html>
<html> 
<head>
	<title> Registro asistencia/ausencia </title>
	<style type="text/css">
		 
		 body{
			text-align: left;
			background: url('../html/imagenParaAsistencia.jpg');
		}

		#linkasistencia{
			margin-left: 550px;
		}

		.link{
			font-weight: bold;
			font-size: 20px;
			margin-left: 60px;
			color:#efb810;
		}

		label{
			font-weight: bold ;
			color: white;	
			text-align: left;
			margin-left: 600px;
		}

		.submit{
			background-color:#cb3234;
			font-weight: bold;
			margin-left: 700px;
		}

		input, textarea{
			background-color:#8a9597;
			border-color: black;
			font-weight: bold;
		}

		input::placeholder, textarea::placeholder{
			color: white;
			font-weight: lighter;
		}


	</style>
</head>

<body>

<a style="position:absolute; top:10px; left:20px ;color:red; font-weight: bold; font-size: 20px; background-color: black;"  href="paginainicio.php"> Volver ←</a>

<a style="position:absolute; top:10px; right:20px ;color:red; font-weight: bold; font-size: 20px; background-color: black;"  href="../Controllers/logoutgym.php"> Cerrar sesión</a>

<a href="#" id="linkasistencia" class="link" >Registrar asistencia</a>

<a href="#" id="linkausencia" class="link" >Registrar ausencia</a>

<br/><br/><br/><br/><br/>

<form id="idAsistencia" method="post" action="" onsubmit="return enviarAsistencia()">
<label for="a">Cuit del profesor: </label> <input type="text" id="a" name="CuitProfesor" placeholder="formato xx-xxxxxxxx-x" value="<?= $this->cuit_preingresado ?>"> <br/><br/>
<label for="b">Fecha: </label> <input type="text" id="b" name="FechaAsistencia"  placeholder="formato dd/mm/aaaa" value="<?= $this->fechaActual ?>"> <br/><br/>
<label for="c">Hora estipulada de clase: </label> <input type="text" id="c" name="HoraClase" placeholder="formato 00:00:00 segundos no obligatorios"> <br/><br/>
<label for="d">Hora de llegada: </label> <input type="text" id="d" name="HoraAsistencia" placeholder="formato 00:00:00 segundos no obligatorios" value="<?= $this->horaActual ?>"> <br/><br/><br/>

<input type="submit" class="submit" value="Enviar" name="submitAsistencia">
</form>

<form id="idAusencia" method="post" action="" onsubmit="return enviarAusencia()">
<label for="a">Cuit del profesor: </label> <input type="text" id="a" name="CuitProfesor" placeholder="formato xx-xxxxxxxx-x" value="<?= $this->cuit_preingresado ?>"> <br/><br/>
<label for="b">Fecha: </label> <input type="text" id="b" name="FechaAusencia" placeholder="formato dd/mm/aaaa"> <br/><br/>
<label for="c">Hora estipulada de clase: </label> <input type="text" id="c" name="HoraClase" placeholder="formato 00:00:00 segundos no obligatorios"> <br/><br/>
<label for="d">Motivo: </label> <textarea id="d" name="Motivo" placeholder="Hasta 140 caracteres"  maxlength="140"> </textarea> 
<br/><br/><br/>

<input type="submit" class="submit" value="Enviar" name="submitAusencia">
</form>



<script type="text/javascript">
	 document.getElementById("idAsistencia").style.display = "none";
	 document.getElementById("idAusencia").style.display = "none";

	  document.getElementById("linkasistencia").onclick = mostrarasistencia; 
	function mostrarasistencia(){
	 document.getElementById("idAsistencia").style.display = "block";
	 document.getElementById("idAusencia").style.display = "none";
	 }

	document.getElementById("linkausencia").onclick = mostrarausencia; 
	function mostrarausencia(){
	 document.getElementById("idAusencia").style.display = "block";
	 document.getElementById("idAsistencia").style.display = "none";
	 }


	 function enviarAsistencia(){	
		var pregunta=confirm('¿Esta seguro de que desea ENVIAR los registros seleccionados?');

		var formulario = document.getElementById("idAsistencia");	
		
	 
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

	 function enviarAusencia(){	
		var pregunta=confirm('¿Esta seguro de que desea ENVIAR los registros seleccionados?');

		var formulario = document.getElementById("idAusencia");	
		
	 
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