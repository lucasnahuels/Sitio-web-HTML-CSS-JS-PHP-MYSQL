<!DOCTYPE html>
<html>
<head>
	<title> Login gym</title>
	<style type="text/css">
		
		#background{
			width:110%;
			height: 110%;
			z-index: -1;
			position: absolute; top:-10px; left:-10px;
			position: fixed;
		}

		label, h4{
			color:white;
			font-weight: bold;
			font-size: 16px;
		}

		div#formlogin{
			display: none;
		}

		#botonaqui, #botonocultar{
			background: transparent;
			color: white;
			font-weight: bold;
			font-size: 14px;
		}

	</style>
</head>
<body>

	<img id="background" src="../html/login.jpg" alt="fondo">



	<form action="" method="POST">
		<label for="inputmail">Ingrese su mail</label>
		<input type="text" id="inputmail" name="email" size="35" maxlength="50"> <br/> <br/>		
		<label for="inputcontra">Ingrese su contraseña</label>
		<input type="password" id="inputcontra" name="password" size="25" maxlength="50"><br/> <br/>	
		<input type="submit" name="Submitingreso" value="Iniciar sesion">
	</form>
	<br/> <br/> <br/>
	
	
	<?php if($this->huboerror==true){ ?>
			<h4> El mail o la contraseña fueron mal ingesados. Intente nuevamente </h4> <img style="height: 200px; width: 250px;" src="../html/error.jpg" alt="error">	<br/><br/>
	<?php } ?>


	<h4> Si no se ha regitstrado, presione <input type="button" name="botonaqui" id="botonaqui" value="aquí"> </h4> <br/>

<div id="formlogin">
	<form action="" method="POST" id="myform" onsubmit="return enviar()">
		<p style="color: white;">Ingrese los siguientes datos para loguearse</p>
		
		<label for="inputmaillog">Ingrese su E-mail</label>
		<input type="text" id="inputmaillog" name="emaillog" size="35" maxlength="50"> <br/> <br/>		
		
		<label for="inputcontralog">Ingrese su contraseña</label>
		<input type="password" id="inputcontralog" name="passwordlog" size="25" maxlength="50"><br/> <br/>	
		
		<label for="inputconfirmacionlog">Confrime su contraseña</label>
		<input type="password" id="inputconfirmacionlog" name="psswdconfirmacionlog" size="25" maxlength="50"> <img id="imagentilde" onload="validarContrasenia()" style="display: none; height: 15px; width: 15px;" src="../html/tilde.png"><br/> <br/>	

		<label for="tipousuario"> Ingrese su rol en el gimnasio:</label>
		<select id="tipousuario" name="tipousuario">
			<?php foreach ($this->cargos as $c) { ?>
			<option value="<?= $c['cargo_id'] ?>"><?= $c['nombre_cargo'] ?></option>
			<?php } ?>
		</select>
		<br/><br/><br/>

		<input type="submit" name="Submitregistro" value="Loguearme">
	</form>

<br/><br/><input type="button" name="botonocultar" id="botonocultar" value="Ocultar formulario">
</div>




<script type="text/javascript">

document.getElementById("botonaqui").onclick = mostrar; 
function mostrar(){
	 document.getElementById("formlogin").style.display = "block";	
}

document.getElementById("botonocultar").onclick = ocultar; 
function ocultar(){
	 document.getElementById("formlogin").style.display = "none";	
}

document.getElementById("inputcontralog").onkeyup= validarContrasenia;
 document.getElementById("inputconfirmacionlog").onkeyup= validarContrasenia;
function validarContrasenia(){
	if (document.getElementById("inputcontralog").value == document.getElementById("inputconfirmacionlog").value){
		document.getElementById("imagentilde").style.display = "inline";	
	}
	else{
		document.getElementById("imagentilde").style.display = "none";	
	}
}

	
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