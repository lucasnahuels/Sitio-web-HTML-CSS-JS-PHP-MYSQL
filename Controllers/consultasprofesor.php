<?php

require '../fw/fw.php';
require '../Models/Profesor.php';
require '../Models/Actividades.php';
require '../Models/Clase.php';
require '../Views/FormaConsultasProfesor.php';

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

$v= new FormaConsultasProfesor;
$p= new Profesor;
$a= new Actividades;
$c= new Clase;

$v->cuitporusuario= $p->getCuitProfesorPorUsuario($_SESSION['emailusuario']);

$v->varSubmitActividades= false;
$v->varSubmitCronograma =false;
$v->varSubmitSociosClases=false;
$v->varSubmitPlanillaAsistencia= false;


if(isset($_POST['SubmitActividades'])){
	
	if(!isset($_POST['CuitConsulta'])) die("error1");

	//preguntar si cuit_profesor existe
	//$p= new Profesor;
	if(!$p->existeProf_Activo($_POST['CuitConsulta'])) die("Error. El cuit del profesor ingresado no existe");
	//--------------------------------------------------------
	//$a= new Actividades;
	$v->varSubmitActividades= true;
	
	$v->existeAlgunaActividad= false; //esto SI es necesario
	if($a->existeAlgunaActividad_Profesor($_POST['CuitConsulta'])) {
		$v->existeAlgunaActividad= true;
		$v->actividades_inscriptas=$a->getActividadesInscriptas($_POST['CuitConsulta']);
	}
	
}


if(isset($_POST['SubmitCronograma'])){

	if(!isset($_POST['CuitConsulta'])) die("error2");

	//preguntar si cuit_profesor existe
	//$p= new Profesor;
	if(!$p->existeProf_Activo($_POST['CuitConsulta'])) die("Error. El cuit del profesor ingresado no existe");
	//--------------------------------------------------------
	$v->varSubmitCronograma = true;

	//$c= new Clase;
	if($c->getClasesDeProfesor($_POST['CuitConsulta'])==array() ) die("Error. Ninguna clase está a cargo del profesor ingresado");
	$v->ClasesDeProfesor = $c->getClasesDeProfesor($_POST['CuitConsulta']);
}


if(isset($_POST['SubmitSociosClases'])){
	
	if(!isset($_POST['CuitConsulta'])) die("error3");

	//preguntar si cuit_profesor existe
	//$p= new Profesor;
	if(!$p->existeProf_Activo($_POST['CuitConsulta'])) die("Error. El cuit del profesor ingresado no existe");
	//--------------------------------------------------------
	$v->varSubmitSociosClases= true;

	//$c= new Clase;
	if($c->getSociosClases($_POST['CuitConsulta'])==array() ) die("Error. Ninguna clase está a cargo del profesor ingresado");
	$v->SociosClases = $c->getSociosClases($_POST['CuitConsulta']);
}


if(isset($_POST['SubmitPlanillaAsistencia'])){

	if(!isset($_POST['CuitConsulta'])) die("error4");

	//preguntar si cuit_profesor existe
	//$p= new Profesor;
	if(!$p->existeProf_Activo($_POST['CuitConsulta'])) die("Error. El cuit del profesor ingresado no existe");
	//--------------------------------------------------------
	$v->varSubmitPlanillaAsistencia= true;

	//$a= new Actividades;
	if($a->getPlanillaAsistencia($_POST['CuitConsulta'])==array() ) die("Error. No hay asistencias registrada aún");
	$v->PlanillaAsistencia= $a->getPlanillaAsistencia($_POST['CuitConsulta']);
}


$v->render(); //El render si o si a lo último para que me muestre TODO el html
