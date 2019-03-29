<?php

require '../fw/fw.php';
require '../Models/Profesor.php';
require '../Models/Actividades.php';
require '../Models/Clase.php';
require '../Views/FormaBajaProfesor.php';
require '../Views/ListaBajaProf.php';
require '../Views/BajaProfesorOk.php';
require '../Views/NoEncontrado.php';


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


if(isset($_POST['nombreprof'])){
	if(!isset($_POST['nombreprof'])) die("error1");
	if(!isset($_POST['apellidoprof'])) die("error2");			

	$p= new Profesor;
	$resultados = $p->buscarProfesores($_POST['nombreprof'], $_POST['apellidoprof']);
	
	if(count($resultados)==0 ) {
		$noencontrado= new NoEncontrado;
		$noencontrado->render();
		exit;
	}


	if(count($resultados)==1) {
		$cuit= $p->getCuit($_POST['nombreprof'], $_POST['apellidoprof']);
		$p->desactivarProf($cuit);
		
		$ap= new Actividades;
		$ap->desactivarActiProf($cuit);

		$c= new Clase;
		$c->desactivarProfClase($cuit);

		/*pantalla de confirmacion*/
		$ok= new BajaProfesorOk;
		$ok->render();
		/*fin pantalla de confirmacion*/
		exit;
	}

	if(count($resultados) > 1 ) {
		$lista= new ListaBajaProf;
		$lista->profesores=$resultados;
		$lista->render();
		exit; //IMPORTANTE EL EXIT AQUI. Sino mostrara FormaBajaProfesor chocando con la lista de profesores todo junto
	}
	
}



$v=new FormaBajaProfesor;
$v->render();