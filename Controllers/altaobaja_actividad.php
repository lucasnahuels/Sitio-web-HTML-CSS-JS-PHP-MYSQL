<?php

require '../fw/fw.php';
require '../Views/FormaAltaActividad.php';
require '../Views/Altaobaja_actividad_ok.php';
require '../Models/Actividades.php';
require '../Models/Profesor.php';
require '../Models/Clase.php';


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


$v= new FormaAltaActividad;

$a=new Actividades;
$v->actividades= $a->getTodas();


if(isset($_POST['cuitalta'])){
	if(!isset($_POST['cuitalta'])) die("error1");
	if(!isset($_POST['actividadalta'])) die("error2");

	//preguntar si cuit_profesor existe
	$p= new Profesor;
	if(!$p->existeProf_Activo($_POST['cuitalta'])) die("Error. El cuit del profesor ingresado no existe");
	//--------------------------------------------------------
	$a->agregarActividadProfesor($_POST['cuitalta'], $_POST['actividadalta'] );
	$AOBok= new Altaobaja_actividad_ok;
	$AOBok->render();
	exit; //IMPORTANTE EL EXIT. ME LO OLVIDO MUCHO Y ME SALTAN LAS DOS PAGINAS JUNTAS CON LA QUE VIENE LUEGO
}

$v->mostrarPaso2=false;
if(isset($_POST['cuitparabaja'])){
	if(!isset($_POST['cuitparabaja'])) die("error3");

	//preguntar si cuit_profesor existe
	$p= new Profesor;
	if(!$p->existeProf_Activo($_POST['cuitparabaja'])) die("Error. El cuit del profesor ingresado no existe");
	if(!$a->existeAlgunaActividad_Profesor($_POST['cuitparabaja'])) die("Error. El profesor ingresado no esta inscripto en ninguna actividad");
	//--------------------------------------------------------

	$v->actividades_inscriptas= $a->getActividadesInscriptas($_POST['cuitparabaja']);
	$v->mostrarPaso2=true;
	$v->cuitdebaja=$_POST['cuitparabaja'];
}


if(isset($_POST['cuitbaja'])){
	if(!isset($_POST['cuitbaja'])) die("error4");
	if(!isset($_POST['actividades_inscriptas'])) die("error5");


	$a->bajarActividadProfesor($_POST['cuitbaja'], $_POST['actividades_inscriptas']);

	$c= new Clase;
	$c->bajarClasesProfesor_determinadaActividad($_POST['cuitbaja'], $_POST['actividades_inscriptas']);

	$AOBok= new Altaobaja_actividad_ok;
	$AOBok->render();
	exit; //IMPORTANTE EL EXIT. ME LO OLVIDO MUCHO Y ME SALTAN LAS DOS PAGINAS JUNTAS CON LA QUE VIENE LUEGO
}

$v->render();


/*CONSULTAR 
1-por que cuando la tabla actividad_profesor me queda vacia (o todas las filas inactivas por baja lógica) me tira error?
2- por que cuando veo el cosnole con f12 me tira errores de Javascript que no comprendo
3-Como hago que un boton al clickearlo me rediriga a otra pagina(o sea que funcione como link). Combinacion de Javascript oc PHP adentro? rpta: Si, se puede hacer javascript dentro de un <?php if(isset()) ?> por poner un ejemplo. Sin embargo en este caso deberia usar link porque justamente para eso es un enlace. Luego si puedo haer que el link se vea como un botón 
4- Como hacer que la contraseña y la confirmacion de la contraseña sea la misma a traves de Javascript. rpta: Con una comparacion de strings*/ 
