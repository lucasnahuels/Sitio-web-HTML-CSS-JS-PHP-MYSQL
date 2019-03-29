
<!DOCTYPE html>
<html> 
<head>
	<title> Alta/baja profesor activiad de profesor</title>
	<style type="text/css">
		
		body{
			text-align: center;
			background: url('../html/fondogris.jpg');
			background-size: 30%;
		}

		#background{
			position: absolute;
			position: fixed;
			z-index: -1;				
			width: 100%;
			height: 100%;
			margin: 0;
			margin-top: 0px;
		}

		.link{
			font-weight: bold;
			font-size: 20px;
			margin-left: 60px;
			display: inline;
			color:#572364;
		}
		.link:hover{
			background-color: red;
		}

		.inputstexto{
			background-color: #E76372;
			border: 4px solid black;
			border-radius: 5px;
			font-weight: bold;
		}

		label{
			font-weight: bold ;
		}

	
	</style>
</head>

<body>

<a style="position:absolute; top:10px; left:20px ;color:red; font-weight: bold; font-size: 20px; background-color: black;"  href="paginainicio.php"> Volver ←</a>

<a style="position:absolute; top:10px; right:20px ;color:red; font-weight: bold; font-size: 20px; background-color: black;"  href="../Controllers/logoutgym.php"> Cerrar sesión</a>

<a href="#" id="linkalta" class="link" >Dar de alta a profesor en determinada actividad</a>

<a href="#" id="linkbaja" class="link" >Dar de baja a profesor en determinada actividad</a>

<br/><br/><br/><br/><br/>


<form id="formaltaacti" action="" method="post" onsubmit="return enviarAlta()">
	<label for="a">Ingrese el c.u.i.t. del profesor </label><input type="text" id="a" class="inputstexto" name="cuitalta" maxlength="20" length="20" placeholder="Forma xx-xxxxxxxx-x">
	<br/><br/><br/>
	
	<label for="b">Ingrese la actividad en la que se quiere dar de alta</label>
	<select name="actividadalta" id="b" class="inputstexto">
		<?php foreach($this->actividades as $a){ ?>
		<option value="<?= $a['nombre_actividad'] ?>"><?= $a['nombre_actividad'] ?></option>
		<?php } ?>
	</select>
	<br/><br/><br/>

	<input type="submit" name="Elsubmit" value="Dar de alta" id="botonSubmitAlta">
</form>



<form action="" method="post" id="formbajaacti">
	<label for="c">Ingrese el c.u.i.t. del profesor </label><input type="text" id="c" class="inputstexto" name="cuitparabaja" maxlength="20" length="20" placeholder="Forma xx-xxxxxxxx-x">
		<br/><br/>
	<input type="submit" value="Ver actividades en las que estoy inscripto">
</form>



<?php if($this->mostrarPaso2) { //Esto pregunta si mostrarPaso2 es true?>
<form action="" method="post" id="formbajaacti2" onsubmit="return enviarBaja()">
	<input type="hidden" name="cuitbaja" value="<?=$_POST['cuitparabaja']?>">
	<select name="actividades_inscriptas" class="inputstexto">
		<?php foreach ($this->actividades_inscriptas as $ai) { 
				//if($ai['cuit_profesor']== $this->cuitdebaja) { Realicé unos cambios que provocan que esta linea sea inútil. Agregarla tampoco arruinaria el programa. Seguiria funcionando tal cual ?>
					<option value="<?= $ai['nombre_actividad'] ?>"><?= $ai['nombre_actividad'] ?></option>
		<?php //  } 
			  } ?>
	</select>
	
	<br/><br/>
	<input type="submit" name="Elsubmit" value="Dar de baja" id="botonSubmitBaja">

	<br/><br/>
	<input type="button" name="boton_retroceder" id="boton_retroceder" value="Volver a ingresar el C.U.I.T">
	
</form>
<?php } ?>


<script type="text/javascript">
	 document.getElementById("formaltaacti").style.display = "none";
	 document.getElementById("formbajaacti").style.display = "none";

	 document.getElementById("linkalta").onclick = mostraralta; 
	function mostraralta(){
		 document.getElementById("formaltaacti").style.display = "block";
		 document.getElementById("formbajaacti").style.display = "none";
		 document.getElementById("formbajaacti2").style.display = "none";
	}

	document.getElementById("linkbaja").onclick = mostrarbaja; 
	document.getElementById("boton_retroceder").onclick = mostrarbaja; 
	function mostrarbaja(){
		 document.getElementById("formbajaacti").style.display = "block";
		 document.getElementById("formaltaacti").style.display = "none";
		 document.getElementById("formbajaacti2").style.display = "none";
	}


	function enviarAlta(){	
		var pregunta=confirm('¿Esta seguro de que desea ENVIAR los registros seleccionados?');

		var formulario = document.getElementById("formaltaacti");	
	
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

	function enviarBaja(){	
		var pregunta=confirm('¿Esta seguro de que desea ENVIAR los registros seleccionados?');

		var formulario = document.getElementById("formbajaacti2");	
	
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