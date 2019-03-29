<?php

require '../fw/fw.php';
require '../Models/Profesor.php';
require '../Views/BajaProfesorOk.php';


if(!isset($_SESSION['logingym'])){ //debe ir luego de los require porque del require fw.php proviene el session_start()
	header("location: logingym.php");
}

foreach ($_SESSION['id_cargousuario'] as $key => $value) {
	$cargo_id= $value;
}

if($cargo_id!=6){
	header("location: paginainicio.php");		
}

//----------------------------------------------------------------------------------------------



if(isset($_GET['cuit'])){
	if(!isset($_GET['cuit'])) die("error1");


	$cuit= $_GET['cuit'];
	$p= new Profesor;
	$p->desactivarProf($cuit);
	//pantalla de confirmacion
	$ok= new BajaProfesorOk;
	$ok->render();
	//fin pantalla de confirmacion
	exit;
}
