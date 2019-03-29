<?php

require '../fw/fw.php';
require '../Views/FormaRegistroAsistenciaAusencia.php';
require '../Views/FormaRegistroAsistenciaAusencia_OK.php';
require '../Models/Registros.php';
require '../Models/Profesor.php';


if(!isset($_SESSION['logingym'])){ //debe ir luego de los require porque del require fw.php proviene el session_start()
	header("location: logingym.php");
}


foreach ($_SESSION['id_cargousuario'] as $key => $value) {
	$cargo_id= $value;
}

if($cargo_id!=1 && $cargo_id!=3){
	header("location: paginainicio.php");		
}

//----------------------------------------------------------------------------------------------

$v = new FormaRegistroAsistenciaAusencia;
$v_ok = new FormaRegistroAsistenciaAusencia_OK;

$r=new Registros;

$p= new Profesor;


$cuit_array= $p->getCuitProfesorPorUsuario($_SESSION['emailusuario']);
foreach ($cuit_array as $ca){ 		
	$cuit_profesor= $ca;
}
$v->cuit_preingresado = $cuit_profesor;

//$fechaOrdenador= getdate(); //no me tira la hora correcta
$fechaOrdenador= localtime(time(),true); //no me tira la hora correcta
$v->horaActual= $fechaOrdenador['tm_hour'] /*date("H") me tira hora incorrecta*/. ':' . date("i") . ':' . date("s");
$v->fechaActual= date("d") . '/' . date("m") . '/' . date("Y");

if(isset($_POST['submitAsistencia'])){
	if(!isset($_POST['CuitProfesor'])) die("error1");
	if(!isset($_POST['FechaAsistencia'])) die("error2");
	if(!isset($_POST['HoraClase'])) die("error3");
	if(!isset($_POST['HoraAsistencia'])) die("error4");
	
	$r->crear_AsistenciaProfesor($_POST['CuitProfesor'], $_POST['FechaAsistencia'], $_POST['HoraClase'], $_POST['HoraAsistencia']);

	$v_ok->render();
	exit;
}

if(isset($_POST['submitAusencia'])){
	if(!isset($_POST['CuitProfesor'])) die("error1");
	if(!isset($_POST['FechaAusencia'])) die("error2");
	if(!isset($_POST['HoraClase'])) die("error3");
	if(!isset($_POST['Motivo'])) die("error4");

	$r->crear_AusenciaProfesor($_POST['CuitProfesor'], $_POST['FechaAusencia'], $_POST['HoraClase'], $_POST['Motivo']);

	$v_ok->render();
	exit;
}


$v->render();