<?php

//session_start(); ya lo tengo en el fw


require '../fw/fw.php';
require '../Views/FormaAltaProfesor.php'; 
require '../Models/Profesor.php'; 
require '../Views/AltaProfesorOk.php'; 

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

$v= new FormaAltaProfesor;
$v->mailporusuario=$_SESSION['emailusuario'];

if(isset($_POST['elsubmit'])){
	if(!isset($_POST['cuitprof'])) die("error1");
	if(!isset($_POST['nombreprof'])) die("error2");
	if(!isset($_POST['apellidoprof'])) die("error3");
	if(!isset($_POST['sexoprof'])) die("error4");
	if(!isset($_POST['tipodocprof'])) die("error5");
	if(!isset($_POST['nrodocprof'])) die("error6");
	if(!isset($_POST['direprof'])) die("error7");
	if(!isset($_POST['celprof'])) die("error8");
	if(!isset($_POST['mailprof'])) die("error9");
	if(!isset($_POST['fechanacprof'])) die("error10");

	$p = new Profesor;
	if($p->existeProf_Activo($_POST['cuitprof'])) die("Error. El profesor que intenta dar de alta ya está inscripto en la base de datos");
	
	if($p->existeProf_Inactivo($_POST['cuitprof'])) $p->activarProf($_POST['cuitprof']);
	else $p->altaProfesor($_POST['cuitprof'],$_POST['nombreprof'],$_POST['apellidoprof'],$_POST['sexoprof'],$_POST['tipodocprof'],$_POST['nrodocprof'],$_POST['direprof'],$_POST['celprof'],$_POST['mailprof'],$_POST['fechanacprof']);


	$ok= new AltaProfesorOk;
	$ok->render();
	exit;
}



$v->render();