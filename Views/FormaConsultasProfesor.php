<?php

/**
 * 
 */
class FormaConsultasProfesor extends View{
	
	public $varSubmitActividades ;//es un bool
	public $varSubmitCronograma ;//es un bool
	public $varSubmitSociosClases ;//es un bool
	public $varSubmitPlanillaAsistencia ;//es un bool
	public $existeAlgunaActividad; //es un bool
	public $actividades_inscriptas; // Es un arrray de arrays, o sea una tabla con filas
	public $ClasesDeProfesor;
	public $SociosClases;
	public $PlanillaAsistencia;

	public $cuitporusuario;

}