<?php

/**
* Clase para trabajar con los datos de los registros
*
* @package LuksAplicacion
* @author Lucas <lucasnahuelstp@gmail.com>
* @version 0.1
*/
class Registros extends Model
{
	
	/**
	* Función que crea una nueva asistencia de un profesor
	* 
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit_profesor. Un string con el cuit único  e irrepetible del profesor
	* @param string $fecha_asistencia. Un string con la fecha en la que se realiza la asistencia
	* @param string $hora_clase. Un string con la hora en la que está estipulada la clase
	* @param string $hora_asistencia. Un string con la hora en la que se realiza la asistencia
	*/		
	public function crear_AsistenciaProfesor($cuit_profesor, $fecha_asistencia, $hora_clase, $hora_asistencia){
		
		$id_clase= $this->getIdClase($cuit_profesor, $fecha_asistencia, $hora_clase); //al principio sino se alteran los datos con las validaciones y surgen errores (escape_string)

	//PRINCIPIO VALIDACIONES
		//cuit profesor
			if (strlen($cuit_profesor)!=13) die("Error. Revea el cuit");
			$cuit_profesor = $this->db->escapeString($cuit_profesor);
			if(substr($cuit_profesor, 2, 1) != '-' || substr($cuit_profesor, 11, 1) != '-' || !ctype_digit(substr($cuit_profesor, 0, 2)) || !ctype_digit(substr($cuit_profesor, 3, 8)) || !ctype_digit(substr($cuit_profesor, 12, 1)) ) die("error104");
				$this->db->query("SELECT * 
						from profesor
						where cuit_profesor= '$cuit_profesor'
						limit 1");

			if($this->db->numRows() != 1) die("error105");
		//fecha asistencia
			$fecha_asistencia = $this->db->escapeString($fecha_asistencia); //sumarle los substr para que sea xxxx-xx-xx
			if(substr($fecha_asistencia, 2 , 1)!="/" || substr($fecha_asistencia, 5 , 1)!="/" ) die("error en el modo de la fecha");
			if(!ctype_digit(substr($fecha_asistencia, 0, 2)) || !ctype_digit(substr($fecha_asistencia, 3, 2)) || !ctype_digit(substr($fecha_asistencia, 6, 4)) ) die("error. los valores de la fecha deben ser númericos"); 
			$dia=substr($fecha_asistencia, 0, 2); $mes=substr($fecha_asistencia, 3, 2); $anio= substr($fecha_asistencia, 6, 4);
			if($dia>31 || $mes>12) die("error en los valores de la fecha");
			if($anio>date("Y") || 
				$anio==date("Y") && $mes>date("m") ||  
				$anio==date("Y") && $mes==date("m") && $dia>date("d")) die("error en los valores de la fecha 2"); //porque la fecha no puede ser futura
			$fecha_asistencia= $anio . '-' . $mes . '-' . $dia;
		//hora clase
			$hora_clase=$this->db->escapeString($hora_clase);
			if(strlen($hora_clase)>9) die("error100");
			if(strlen($hora_clase)<4) die("error101");
			if(substr($hora_clase, 2, 1)== ":"){
				$hora24=substr($hora_clase, 0, 2); $minuto60= substr($hora_clase, 3, 2); $segundo60=substr($hora_clase, 6,2);
			}
			if(substr($hora_clase, 1, 1)== ":"){
				$hora24=substr($hora_clase, 0, 1); $minuto60= substr($hora_clase, 2, 2); $segundo60=substr($hora_clase, 5,2);
			}
			if(substr($hora_clase, 2, 1)!= ":" && substr($hora_clase, 1, 1)!= ":") die("error en los valores de la hora 1");
			if($hora24>23 || $minuto60 > 59 || $segundo60 >59) die("error en los valores de la hora 2");
			if(!ctype_digit($hora24) || !ctype_digit($minuto60) ) die("error en los valores de la hora 3");
			//necesito dos if porque podria ser tanto 7:35:34 como 07:35:34  
		//hora asistencia
			$hora_asistencia=$this->db->escapeString($hora_asistencia);
			if(strlen($hora_asistencia)>9) die("error102");
			if(strlen($hora_asistencia)<4) die("error103");
			if(substr($hora_asistencia, 2, 1)== ":"){
				$hora24=substr($hora_asistencia, 0, 2); $minuto60= substr($hora_asistencia, 3, 2); $segundo60=substr($hora_asistencia, 6,2);
			}
			if(substr($hora_asistencia, 1, 1)== ":"){
				$hora24=substr($hora_asistencia, 0, 1); $minuto60= substr($hora_asistencia, 2, 2); $segundo60=substr($hora_asistencia, 5,2);
			}
			if(substr($hora_asistencia, 2, 1)!= ":" && substr($hora_asistencia, 1, 1)!= ":") die("error en los valores de la hora 1");
			if($hora24>23 || $minuto60 > 59 || $segundo60 >59) die("error en los valores de la hora 2");
			if(!ctype_digit($hora24) || !ctype_digit($minuto60) ) die("error en los valores de la hora 3");
			//necesito dos if porque podria ser tanto 7:35:34 como 07:35:34  
	//FIN VALIDACIONES	


		$this->db->query("INSERT INTO asistencia_profesor(fecha, hora, cuit_profesor, id_clase)
								VALUES('$fecha_asistencia', '$hora_asistencia', '$cuit_profesor', $id_clase) ");

	}


	/**
	* Función que crea una nueva asistencia de un profesor
	* 
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit_profesor. Un string con el cuit único  e irrepetible del profesor
	* @param string $fecha_ausencia. Un string con la fecha en la que se realiza la ausencia
	* @param string $hora_clase. Un string con la hora en la que está estipulada la clase
	* @param string $motivo. Un string con los motivos por los cuales se va a ausentar
	*/	
	public function crear_AusenciaProfesor($cuit_profesor, $fecha_ausencia, $hora_clase, $motivo){
	
		$id_clase= $this->getIdClase($cuit_profesor, $fecha_ausencia, $hora_clase);//al principio sino se alteran los datos con las validaciones y surgen errores (escape_string)
	
	//PRINCIPIO VALIDACIONES
		//cuit profesor
			if (strlen($cuit_profesor)!=13) die("Error. Revea el cuit");
			$cuit_profesor = $this->db->escapeString($cuit_profesor);
			if(substr($cuit_profesor, 2, 1) != '-' || substr($cuit_profesor, 11, 1) != '-' || !ctype_digit(substr($cuit_profesor, 0, 2)) || !ctype_digit(substr($cuit_profesor, 3, 8)) || !ctype_digit(substr($cuit_profesor, 12, 1)) ) die("error104");
				$this->db->query("SELECT * 
						from profesor
						where cuit_profesor= '$cuit_profesor'
						limit 1");

			if($this->db->numRows() != 1) die("error105");
		//fecha ausencia
			if(substr($fecha_ausencia, 2 , 1)!="/" || substr($fecha_ausencia, 5 , 1)!="/" ) die("error en el modo de la fecha");
			$fecha_ausencia = $this->db->escapeString($fecha_ausencia); //sumarle los substr para que sea xxxx-xx-xx
			if(!ctype_digit(substr($fecha_ausencia, 0, 2)) || !ctype_digit(substr($fecha_ausencia, 3, 2)) || !ctype_digit(substr($fecha_ausencia, 6, 4)) ) die("error. los valores de la fecha deben ser númericos"); 
			$dia=substr($fecha_ausencia, 0, 2); $mes=substr($fecha_ausencia, 3, 2); $anio= substr($fecha_ausencia, 6, 4);
			if($dia>31 || $mes>12) die("error en los valores de la fecha");
			if($anio<date("Y") || 
				$anio==date("Y") && $mes<date("m") ||  
				$anio==date("Y") && $mes==date("m") && $dia<date("d")) die("error en los valores de la fecha 2");//porque la fecha no puede ser pasada
			$fecha_ausencia= $anio . '-' . $mes . '-' . $dia;
		//hora clase
			$hora_clase=$this->db->escapeString($hora_clase);
			if(strlen($hora_clase)>9) die("error100");
			if(strlen($hora_clase)<4) die("error101");
			if(substr($hora_clase, 2, 1)== ":"){
				$hora24=substr($hora_clase, 0, 2); $minuto60= substr($hora_clase, 3, 2); $segundo60=substr($hora_clase, 6,2);
			}
			if(substr($hora_clase, 1, 1)== ":"){
				$hora24=substr($hora_clase, 0, 1); $minuto60= substr($hora_clase, 2, 2); $segundo60=substr($hora_clase, 5,2);
			}
			if(substr($hora_clase, 2, 1)!= ":" && substr($hora_clase, 1, 1)!= ":") die("error en los valores de la hora 1");
			if($hora24>23 || $minuto60 > 59 || $segundo60 >59) die("error en los valores de la hora 2");
			if(!ctype_digit($hora24) || !ctype_digit($minuto60) ) die("error en los valores de la hora 3");
			//necesito dos if porque podria ser tanto 7:35:34 como 07:35:34  
		//motivo
			if(strlen($motivo)<2) die("texto demasiado corto es invalido");
			$motivo = substr($motivo, 0, 140);
			$motivo = $this->db->escapeString($motivo);
	//FIN VALIDACIONES	


		$this->db->query("INSERT INTO ausencia_profesor(fecha, hora, motivo, cuit_profesor, id_clase)
								VALUES('$fecha_ausencia', '$hora_clase', '$motivo', '$cuit_profesor', $id_clase) ");

	}


	/**
	* Función que recupera y retorna el id de clase único e irrepetible, conusltando según su fehca y hora
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit_profesor. Un string con el cuit único  e irrepetible del profesor
	* @param string $fecha_asistencia. Un string con la fecha en la que se realiza la asistencia
	* @param string $hora_clase. Un string con la hora en la que está estipulada la clase
	* @return string. Retorna un string con el cuit del profesor
	*/
	public function getIdClase($cuit_profesor, $fecha, $hora_clase){
	//PRINCIPIO VALIDACIONES
		//cuit profesor
			if (strlen($cuit_profesor)!=13) die("Error. Revea el cuit");
			$cuit_profesor = $this->db->escapeString($cuit_profesor);
			if(substr($cuit_profesor, 2, 1) != '-' || substr($cuit_profesor, 11, 1) != '-' || !ctype_digit(substr($cuit_profesor, 0, 2)) || !ctype_digit(substr($cuit_profesor, 3, 8)) || !ctype_digit(substr($cuit_profesor, 12, 1)) ) die("error104");
				$this->db->query("SELECT * 
						from profesor
						where cuit_profesor= '$cuit_profesor'
						limit 1");

			if($this->db->numRows() != 1) die("error105");
		//fecha 
			if(substr($fecha, 2 , 1)!="/" || substr($fecha, 5 , 1)!="/" ) die("error en el modo de la fecha");
			$fecha = $this->db->escapeString($fecha); //sumarle los substr para que sea xxxx-xx-xx
			if(!ctype_digit(substr($fecha, 0, 2)) || !ctype_digit(substr($fecha, 3, 2)) || !ctype_digit(substr($fecha, 6, 4)) ) die("error. los valores de la fecha deben ser númericos"); 
			$dia=substr($fecha, 0, 2); $mes=substr($fecha, 3, 2); $anio= substr($fecha, 6, 4);
			if($dia>31 || $mes>12) die("error en los valores de la fecha");
			$fecha= $anio . '-' . $mes . '-' . $dia;
		//hora clase
			$hora_clase=$this->db->escapeString($hora_clase);
			if(strlen($hora_clase)>9) die("error100");
			if(strlen($hora_clase)<4) die("error101");
			if(substr($hora_clase, 2, 1)== ":"){
				$hora24=substr($hora_clase, 0, 2); $minuto60= substr($hora_clase, 3, 2); $segundo60=substr($hora_clase, 6,2);
			}
			if(substr($hora_clase, 1, 1)== ":"){
				$hora24=substr($hora_clase, 0, 1); $minuto60= substr($hora_clase, 2, 2); $segundo60=substr($hora_clase, 5,2);
			}
			if(substr($hora_clase, 2, 1)!= ":" && substr($hora_clase, 1, 1)!= ":") die("error en los valores de la hora 1");
			if($hora24>23 || $minuto60 > 59 || $segundo60 >59) die("error en los valores de la hora 2");
			if(!ctype_digit($hora24) || !ctype_digit($minuto60) ) die("error en los valores de la hora 3");
			//necesito dos if porque podria ser tanto 7:35:34 como 07:35:34 
	//FIN VALIDACIONES
		$this->db->query("SELECT id_clase
							FROM clase
							WHERE cuit_profesor = '$cuit_profesor' AND fecha_clase='$fecha' AND  hora='$hora_clase' ");

		if($this->db->numRows() > 1) die("error. Un profesor esta anotado en más de una clase en un mismo horario");
		if($this->db->numRows() < 1) die("error. No hay ninguna clase programada en la fecha y horario seleccionados");

		$fila= $this->db->fetch(); 
		return $fila['id_clase'];

	}

}