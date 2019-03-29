<?php
// session_start(); ya lo tengo en el fw. Si lo vuelvo a poner me tira error
/*if(!isset($_SESSION['logingym'])){
	header("location: logingym.php");
}
NOTA: ACA NO VA
*/ ?>
<!DOCTYPE html>
<html> 
<head>
	<title> Envio correcto</title>

	<style type="text/css">
		
			#background{
			width:110%;
			height: 110%;
			z-index: -1;
			position: absolute; top:-10px; left:-10px;
			position: fixed;
		
		}
	</style>

</head>

<body>

<img id="background" src="../html/login.jpg" alt="fondo">

<a style="position:absolute; top:10px; right:20px ;color:white; font-weight: bold; font-size: 20px;"  href="logoutgym.php"> Cerrar sesión</a>
<h3 style="color: red; font-weight: bold; font-size: 25px; background-color: black; display: inline; position:absolute; margin-top: 20px" > Los datos fueron enviados correctamente. Ha sido registrado</h3>
<br/><br/><br/>
<a href="logingym.php" style="color: red; font-weight: bold; font-size: 20px; background-color: black"> Volver </a>

</body>
</html>