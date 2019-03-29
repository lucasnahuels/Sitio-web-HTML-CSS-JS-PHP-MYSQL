<?php

require '../fw/fw.php';
require '../Views/FormaInformeRoturaFaltanteElementos.php';
require '../Views/FormaInformeRoturaFaltanteElementos_OK.php';
require '../Models/Informes.php';
require '../Models/Profesor.php';


if(!isset($_SESSION['logingym'])){ //debe ir luego de los require porque del require fw.php proviene el session_start()
	header("location: logingym.php");
}


foreach ($_SESSION['id_cargousuario'] as $key => $value) {
	$cargo_id= $value;
}

if($cargo_id!=1){
	header("location: paginainicio.php");		
}

//----------------------------------------------------------------------------------------------

$v = new FormaInformeRoturaFaltanteElementos;
$v_ok = new FormaInformeRoturaFaltanteElementos_OK;

$v->horaActual= date("H") . ':' . date("i") . ':' . date("s");
$v->fechaActual= date("d") . '/' . date("m") . '/' . date("Y");

$i=new Informes;

$v->productos=$i->getTodosLosProductos();


if(isset($_POST['submitInforme'])){
	if(!isset($_SESSION['emailusuario'])) die("error1");
	if(!isset($_POST['FechaInforme'])) die("error2");
	if(!isset($_POST['HoraInforme'])) die("error3");
	if(!isset($_POST['CodigoProducto'])) die("error4");
	if(!isset($_POST['Detalle_Novedad'])) die("error5");

	$p= new Profesor;
	$cuit_array= $p->getCuitProfesorPorUsuario($_SESSION['emailusuario']);
	
	foreach ($cuit_array as $ca) {	
		$cuit_profesor= $ca;
	}

	$i->crearInforme_RoturaFaltanteProductos($_POST['FechaInforme'], $_POST['HoraInforme'], $_POST['CodigoProducto'], $_POST['Detalle_Novedad'], $cuit_profesor);
	$v_ok->render();
	exit;
}


$v->render();