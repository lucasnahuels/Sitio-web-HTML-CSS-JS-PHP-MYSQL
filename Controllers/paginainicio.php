<?php


require '../fw/fw.php';
require '../Views/VistaInicio.php';

if(!isset($_SESSION['logingym'])){ //debe ir luego de los require porque del require fw.php proviene el session_start()
	header("location: logingym.php");
}
//---------------------------------------------------------------
$v = new VistaInicio;

$v->cargo= $_SESSION['id_cargousuario'];

$v->render();