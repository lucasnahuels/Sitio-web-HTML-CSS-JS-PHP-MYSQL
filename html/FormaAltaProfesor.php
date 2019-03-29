<!DOCTYPE html>
<html> 
<head>
	<title> Ingreso alta profesor</title>
	<style type="text/css">
		 

		body{
			text-align: left;
			background: url('../html/Crossfit-Wallpaper.jpg');
		}
		 
		h1{
			color:#efb810;
			font-weight: bold;
			font-size: 40px;	
			margin-left: 365px;
		}

		label{
			font-size: 18px;
			font-weight: bold;
			color: white;
			background-color: grey;
			margin-left: 600px;
		}
		
       p#sexoprof1{
			display: inline;
			color:white;
			font-weight: bold;
			background-color: grey;
			font-size: 18px;
			margin-left: 600px;
		}
		#divsexo label{
				margin-left: 0;
			}

		 #boton, #boton2{
        font-size:10px;
        font-family:Verdana,Helvetica;
        font-weight:bold;
        color:black;
        background:#efb810;
        border:4px solid black;
        width:100px;
        height:30px;
        display: inline;
        }

        #boton{
        	margin-left: 600px;
        	float:left;
        	margin-right:40px ; 
        }

        p {
        	color: white;
        	font-size: 18px;
        	font-weight: bold;
        	margin-left: 600px;
        	background-color: black;
        	display: inline;

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



	</style>
</head>

<body>

	<a style="position:absolute; top:10px; right:20px ;color:white; font-weight: bold; font-size: 20px"  href="../Controllers/logoutgym.php"> Cerrar sesión</a>

	<h1> Página de inscripción de profesor al gimnasio</h1>
	<br/>
		<form action="" method="post" name="ElFormulario" id="myform" onsubmit="return enviar()">
			
	<label for="a">Nombre: </label>
	<input type="text" name="nombreprof" size="30" maxlength="50" placeholder="Acepta solamente letras" id="a"> <br/><br/>

	<label for="b">Apellido: </label>
	<input type="text" name="apellidoprof" size="30" maxlength="50" placeholder="Acepta solamente letras" id="b"><br/><br/>

	<div id="divsexo"> 
		<p id="sexoprof1">Sexo:</p> 
			<label for="c1" style="margin-left: 5px">M</label> 
			<input type="radio" name="sexoprof" value="M" id="c1">
								
			<label for="c2">F</label> 
			<input type="radio" name="sexoprof" value="F" id="c2"><br/><br/> 
	</div>

	<label for="c">Fecha nacimiento: </label>
	<input type="text" name="fechanacprof" size="20" maxlength="15" placeholder="Forma dd/mm/aaaa" id="c"><br/><br/>

	<label for="d">Tipo de documento: </label><select name="tipodocprof" id="d"> 
													<option value="D.N.I.">D.N.I.</option>
													<option value="D.U.">D.U..</option>
													<option value="Pasaporte">Pasaporte</option>  </select><br/><br/>
	<label for="e">Número de documento: </label>
	<input type="text" name="nrodocprof" size="20" maxlength="15" placeholder="Acepta solamente números" id="e"><br/><br/>

	<label for="f">Dirección: </label>
	<input type="text" name="direprof" size="32" maxlength="50" placeholder="Calle y número (piso en caso de dpto)" id="f"><br/><br/>

	<label for="g">Teléfono celular: </label>
	<input type="text" name="celprof" size="15" maxlength="20" placeholder="número sin guiones" id="g"><br/><br/>

	<label for="h">C.U.I.T.: </label>
	<input type="text" name="cuitprof" size="20" maxlength="13" placeholder="forma xx-xxxxxxxx-x" id="h"><br/><br/>

	<label for="i">Correo electronico: </label>
	<input type="text" name="mailprof" value="<?= $this->mailporusuario ?>" size="30" maxlength="50" id="i"><br/><br/>

	<label for="j">Foto: </label>
	<input type="file" name="fotoprof" id="j"><br/><br/>

	<p>*Todos los campos son obligatorios</p>

	<br/><br/><br/>
	<input type="submit" name="elsubmit"  value="Enviar datos" id="boton">

		</form>

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
</html>