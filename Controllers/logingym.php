<?php

require '../fw/fw.php';
require '../Views/FormaLoginGym.php';
require '../Views/GimnasioConfirmacionUsuario.php';
require '../Models/Usuarios.php';


//session_start(); Ya lo tengo en el fw. Si lo vuelvo a poner me tira error



$v= new FormaLoginGym;
$u= new Usuarios;

$v->cargos=$u->getCargos();


$v->huboerror=false;
if(isset($_POST['Submitingreso'])){
	
	//validar
	if(!isset($_POST['email'])) die("error1");
	if(!isset($_POST['password'])) die("error2");
	

	if($u->BuscarUsuario($_POST['email'], $_POST['password']) ){
		$_SESSION['logingym']= true;
		$_SESSION['emailusuario']=$_POST['email'] ;
		$_SESSION['id_cargousuario']= $u->getCargoDeUsuario($_POST['email']);
	
		header("location: paginainicio.php");
		exit;
	}
	
	else {
		($v->huboerror= true);
	}
}


if(isset($_POST['Submitregistro'])){
	//validar
	if(!isset($_POST['emaillog'])) die("error3");
	if(!isset($_POST['passwordlog'])) die("error4");
	if(!isset($_POST['psswdconfirmacionlog'])) die("error5");
	if(!isset($_POST['tipousuario'])) die("error6");


	if($u->existeUsuario($_POST['emaillog']) ) die ("Error. El usuario con el mail ingresado ya existe");
		
	$u->crearUsuario($_POST['emaillog'], $_POST['passwordlog'], $_POST['psswdconfirmacionlog'], $_POST['tipousuario'] /*es el nro de cargo_id*/);		
	$gcu= new GimnasioConfirmacionUsuario;
	$gcu->render();
	exit;	
	
}


$v->render();
?>
