
<!DOCTYPE html>
<html> 
<head>
	<title> Practica profesional supervisada</title>
	<style type="text/css">
		 
		body{
			text-align: center;
			background: url('../html/gym2.jpg');
		}

		h1{
			background-image: url("../html/madera.jpg");;
			font-size: 50px;
			width: 500px;
			border: 8px solid black;
			margin-right:auto; 
			margin-left:auto;
		}

		#imagen1{
			margin-left:auto;
			margin-right:100px;
			width: 200px;
			height: 200px;
		}
	
		#imagen2{
			background-image: url("../html/maderaprof.jpg");
			width: 200px;
			height: 200px;	
		}

		#imagen3{
			width: 200px;
			height: 200px;
			margin-left:100px;
			margin-right: auto;
		}

		#imagen1:hover, #imagen2:hover, #imagen3:hover, .subimagenes1:hover, .subimagenes2:hover, .subimagenes3:hover{
			box-shadow: 8px 8px 12px #800040, 4px 4px 10px black;
		}

		#imagen4{
			margin-right: 100px;
			position: relative;
			z-index: 1;
			display:none;
		}
		#imagen5{
			margin-right: 0px; /*margin-right: -150px*/
			position: relative;
			z-index: 1;
			display:none;		
		}
		#imagen6{
			/*margin-left:0px;
			margin-right: 0px;*/	
			position: relative;
			z-index: 3;
			display:none;
		}
		#imagen7{
			margin: 70px;	
			position: relative;
			z-index: 3;
			display:none;	
		}
		#imagen8{
			/*margin-left: 0px;
			right: 0px;*/
			position: relative;
			z-index: 3;
			display:none;
		}
		#imagen9{
			margin-left: 0px /*margin-left: -150px*/
		}
		#imagen10{
			margin-left: 100px
		}
		
		/*.subimagenes1{
			position: relative;
			z-index: 1;
			display:none;
		}

		.subimagenes2{
			position: relative;
			z-index: 3;
			display:none;
		}

		.subimagenes3{
			position: relative;
			z-index: 2;
			display:none;
		}*/

		.isDisabled {
		  cursor: not-allowed;
		  opacity: 0.5;
		  color: currentColor;
		  pointer-events: none;
		  text-decoration: none;
		}

	</style>
</head>


<body>

<h1> Gestión a desarrolar</h1> 

<a style="position:absolute; top:10px; right:20px ;color:white; font-weight: bold; font-size: 20px; background-image: url('madera.jpg');"  href="../Controllers/logoutgym.php"> Cerrar sesión</a>


<?php foreach ($this->cargo as $key => $value) {
	$cargo_id= $value;
} ?>

<br/>
<input type="image" name="botonimagen1" src="../html/maderaprof.jpg" alt="Imagen de desarrolo" id="imagen1">
<input type="image" name="botonimagen2" src="../html/maderaacti.jpg" alt="Imagen de desarrolo" id="imagen2">
<input type="image" name="botonimagen3" src="../html/maderainfo.jpg" alt="Imagen de desarrolo" id="imagen3">
<br/><br/><br/><br/><br/>

<?php if($cargo_id==1) { //profesor ?>
<a id="imagen4" class="isDisabled" href="crearprofesor.php"><img width="150" height="150" src ="../html/maderaprofalta.jpg"></a>
<a id="imagen5" class="isDisabled" href="bajarprofesor.php"><img width="150" height="150" src ="../html/maderaprofbaja.jpg"></a>

<a id="imagen6" class="isDisabled" href="altaobaja_actividad.php"><img width="150" height="150" src ="../html/maderaactialtabaja.jpg"></a>
<a id="imagen7" href="registrar_asistencia_ausencia.php"><img width="150" height="150" src ="../html/maderaactiasistencia.jpg"></a>
<a id="imagen8" href="consultasprofesor.php"><img width="150" height="150" src ="../html/maderaacticonsulta.jpg"></a>

<a id="imagen9"   href="informar_falla_maquinaria.php"><img width="150" height="150" src ="../html/maderainfomaqui.jpg"></a>
<a id="imagen10"  href="informar_rotura_faltante_producto.php"><img width="150" height="150" src ="../html/maderainfoelemen.jpg"></a>
<?php } ?>

<?php if($cargo_id==6) { //Persona de administracion?>
<a id="imagen4" href="crearprofesor.php"><img width="150" height="150" src ="../html/maderaprofalta.jpg"></a>
<a id="imagen5" href="bajarprofesor.php"><img width="150" height="150" src ="../html/maderaprofbaja.jpg"></a>

<a id="imagen6" href="altaobaja_actividad.php"><img width="150" height="150" src ="../html/maderaactialtabaja.jpg"></a>
<a id="imagen7" class="isDisabled" href="registrar_asistencia_ausencia.php"><img width="150" height="150" src ="../html/maderaactiasistencia.jpg"></a>
<a id="imagen8" class="isDisabled" href="consultasprofesor.php"><img width="150" height="150" src ="../html/maderaacticonsulta.jpg"></a>

<a id="imagen9"  class="isDisabled" href="informar_falla_maquinaria.php"><img width="150" height="150" src ="../html/maderainfomaqui.jpg"></a>
<a id="imagen10" class="isDisabled" href="informar_rotura_faltante_producto.php"><img width="150" height="150" src ="../html/maderainfoelemen.jpg"></a>
<?php } ?>

<?php if($cargo_id==3) { //empleado?>
<a id="imagen4" class="isDisabled" href="crearprofesor.php"><img width="150" height="150" src ="../html/maderaprofalta.jpg"></a>
<a id="imagen5" class="isDisabled" href="bajarprofesor.php"><img width="150" height="150" src ="../html/maderaprofbaja.jpg"></a>

<a id="imagen6" class="isDisabled" href="altaobaja_actividad.php"><img width="150" height="150" src ="../html/maderaactialtabaja.jpg"></a>
<a id="imagen7" href="registrar_asistencia_ausencia.php"><img width="150" height="150" src ="../html/maderaactiasistencia.jpg"></a>
<a id="imagen8" class="isDisabled" href="consultasprofesor.php"><img width="150" height="150" src ="../html/maderaacticonsulta.jpg"></a>

<a id="imagen9"  class="isDisabled" href="informar_falla_maquinaria.php"><img width="150" height="150" src ="../html/maderainfomaqui.jpg"></a>
<a id="imagen10" class="isDisabled" href="informar_rotura_faltante_producto.php"><img width="150" height="150" src ="../html/maderainfoelemen.jpg"></a>
<?php } ?>

<?php if($cargo_id!=1 & $cargo_id!=3 & $cargo_id!=6) { //socio, proveedor, dueño del gym?>
<a id="imagen4" class="isDisabled" href="crearprofesor.php"><img width="150" height="150" src ="../html/maderaprofalta.jpg"></a>
<a id="imagen5" class="isDisabled" href="bajarprofesor.php"><img width="150" height="150" src ="../html/maderaprofbaja.jpg"></a>

<a id="imagen6" class="isDisabled" href="altaobaja_actividad.php"><img width="150" height="150" src ="../html/maderaactialtabaja.jpg"></a>
<a id="imagen7" class="isDisabled" href="registrar_asistencia_ausencia.php"><img width="150" height="150" src ="../html/maderaactiasistencia.jpg"></a>
<a id="imagen8" class="isDisabled" href="consultasprofesor.php"><img width="150" height="150" src ="../html/maderaacticonsulta.jpg"></a>

<a id="imagen9"  class="isDisabled" href="informar_falla_maquinaria.php"><img width="150" height="150" src ="../html/maderainfomaqui.jpg"></a>
<a id="imagen10" class="isDisabled" href="informar_rotura_faltante_producto.php"><img width="150" height="150" src ="../html/maderainfoelemen.jpg"></a>
<?php } ?>


<script type="text/javascript">


document.getElementById("imagen1").onclick = mostrar1; 
function mostrar1(){
	 document.getElementById("imagen4").style.display = "inline";	
	 document.getElementById("imagen5").style.display = "inline";	
	 document.getElementById("imagen6").style.display = "none";
	 document.getElementById("imagen7").style.display = "none";	
	 document.getElementById("imagen8").style.display = "none";
	 document.getElementById("imagen9").style.display = "none";	
	 document.getElementById("imagen10").style.display = "none";	
}	


document.getElementById("imagen2").onclick = mostrar2; 
function mostrar2(){
	 document.getElementById("imagen4").style.display = "none";	
	 document.getElementById("imagen5").style.display = "none";	
	 document.getElementById("imagen6").style.display = "inline";
	 document.getElementById("imagen7").style.display = "inline";	
	 document.getElementById("imagen8").style.display = "inline";
	 document.getElementById("imagen9").style.display = "none";	
	 document.getElementById("imagen10").style.display = "none";	
}	


document.getElementById("imagen3").onclick = mostrar3; 
function mostrar3(){
	 document.getElementById("imagen4").style.display = "none";	
	 document.getElementById("imagen5").style.display = "none";	
	 document.getElementById("imagen6").style.display = "none";
	 document.getElementById("imagen7").style.display = "none";	
	 document.getElementById("imagen8").style.display = "none";
	 document.getElementById("imagen9").style.display = "inline";	
	 document.getElementById("imagen10").style.display = "inline";	
	 	
}

	
</script>

</body>
</html>