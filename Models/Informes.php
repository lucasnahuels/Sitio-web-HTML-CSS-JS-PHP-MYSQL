<?php

/**
* Clase para trabajar con los datos de los informes
*
* @package LuksAplicacion
* @author Lucas <lucasnahuelstp@gmail.com>
* @version 0.1
*/
class Informes extends Model
{

	/**
	* Función que crea un nuevo informe de rotura o faltante de un determinado producto
	* 
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $fecha. Un string con la fecha en la que se realiza el informe 
	* @param string $hora. Un string con la hora en la que se realiza el informe
	* @param interger $codigo_producto. Un interger con el código único del producto
	* @param string $detalle_novedad. Un string con los detalles de la rotura o faltante
	* @param string $cuit_profesor. Un string con el cuit único e irrepetible del profesor
	*/	
	public function crearInforme_RoturaFaltanteProductos($fecha, $hora, $codigo_producto, $detalle_novedad, $cuit_profesor){
	//PRINCIPIO VALIDACIONES
		//fecha informe
			$fecha= $this->db->escapeString($fecha); //sumarle los substr para que sea xxxx-xx-xx
			if(substr($fecha, 2 , 1)!="/" || substr($fecha, 5 , 1)!="/" ) die("error en el modo de la fecha");
			if(!ctype_digit(substr($fecha, 0, 2)) || !ctype_digit(substr($fecha, 3, 2)) || !ctype_digit(substr($fecha, 6, 4)) ) die("error. los valores de la fecha deben ser númericos"); 
			$dia=substr($fecha, 0, 2); $mes=substr($fecha, 3, 2); $anio= substr($fecha, 6, 4);
			if($dia>31 || $mes>12) die("error en los valores de la fecha");
			if($anio>date("Y") || 
				$anio==date("Y") && $mes>date("m") ||  
				$anio==date("Y") && $mes==date("m") && $dia>date("d")) die("error en los valores de la fecha 2"); //porque la fecha no puede ser futura
			$fecha= $anio . '-' . $mes . '-' . $dia;
		//hora
			$hora=$this->db->escapeString($hora);
			if(strlen($hora)>9) die("error100");
			if(strlen($hora)<4) die("error101");
			if(substr($hora, 2, 1)== ":"){
				$hora24=substr($hora, 0, 2); $minuto60= substr($hora, 3, 2); $segundo60=substr($hora, 6,2);
			}
			if(substr($hora, 1, 1)== ":"){
				$hora24=substr($hora, 0, 1); $minuto60= substr($hora, 2, 2); $segundo60=substr($hora, 5,2);
			}
			if(substr($hora, 2, 1)!= ":" && substr($hora, 1, 1)!= ":") die("error en los valores de la hora 1");
			if($hora24>23 || $minuto60 > 59 || $segundo60 >59) die("error en los valores de la hora 2");
			if(!ctype_digit($hora24) || !ctype_digit($minuto60) ) die("error en los valores de la hora 3");
			//necesito dos if porque podria ser tanto 7:35:34 como 07:35:34
		//codigo producto
			$this->db->query("SELECT * 
						from producto
						where codigo_producto= '$codigo_producto'
						limit 1");

			if($this->db->numRows() != 1) die("error102");

			if(!ctype_digit($codigo_producto)) die("error103");
			if($codigo_producto<1)die("error103.1");
		//detalle novedad
			if(strlen($detalle_novedad)<2) die("texto demasiado corto es invalido");
			$detalle_novedad = substr($detalle_novedad, 0, 140);
			$detalle_novedad = $this->db->escapeString($detalle_novedad); 
		//cuit profesor
			if (strlen($cuit_profesor)!=13) die("Error. Revea el cuit");
			$cuit_profesor = $this->db->escapeString($cuit_profesor);
			if(substr($cuit_profesor, 2, 1) != '-' || substr($cuit_profesor, 11, 1) != '-' || !ctype_digit(substr($cuit_profesor, 0, 2)) || !ctype_digit(substr($cuit_profesor, 3, 8)) || !ctype_digit(substr($cuit_profesor, 12, 1)) ) die("error104");
				$this->db->query("SELECT * 
						from profesor
						where cuit_profesor= '$cuit_profesor'
						limit 1");

			if($this->db->numRows() != 1) die("error105");
	//FIN VALIDACIONES	

		$this->db->query("INSERT INTO planilla_rotura_faltante_elementos(fecha, hora, detalle_novedad, codigo_producto, cuit_profesor)
								VALUES('$fecha', '$hora', '$detalle_novedad', $codigo_producto, '$cuit_profesor') ");

	}


	/**
	* Función que crea un nuevo informe de falla de determinada maquinaria
	* 
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $fecha. Un string con la fecha en la que se realiza el informe 
	* @param string $hora. Un string con la hora en la que se realiza el informe
	* @param interger $nro_maquinaria. Un interger con el número de maquinaria único de la maquinaria
	* @param string $detalle_novedad. Un string con los detalles de la rotura o faltante
	* @param string $cuit_profesor. Un string con el cuit único  e irrepetible del profesor
	*/	
	public function crearInforme_FallaMaquinaria($fecha, $hora, $nro_maquinaria, $detalle_novedad, $cuit_profesor){
	//PRINCIPIO VALIDACIONES
		//fecha informe
			$fecha= $this->db->escapeString($fecha); //sumarle los substr para que sea xxxx-xx-xx
			if(substr($fecha, 2 , 1)!="/" || substr($fecha, 5 , 1)!="/" ) die("error en el modo de la fecha");
			if(!ctype_digit(substr($fecha, 0, 2)) || !ctype_digit(substr($fecha, 3, 2)) || !ctype_digit(substr($fecha, 6, 4)) ) die("error. los valores de la fecha deben ser númericos"); 
			$dia=substr($fecha, 0, 2); $mes=substr($fecha, 3, 2); $anio= substr($fecha, 6, 4);
			if($dia>31 || $mes>12) die("error en los valores de la fecha");
			if($anio>date("Y") || 
				$anio==date("Y") && $mes>date("m") ||  
				$anio==date("Y") && $mes==date("m") && $dia>date("d")) die("error en los valores de la fecha 2");//porque la fecha no puede ser futura
			$fecha= $anio . '-' . $mes . '-' . $dia;
		//hora
			$hora=$this->db->escapeString($hora);
			if(strlen($hora)>9) die("error100");
			if(strlen($hora)<4) die("error101");
			if(substr($hora, 2, 1)== ":"){
				$hora24=substr($hora, 0, 2); $minuto60= substr($hora, 3, 2); $segundo60=substr($hora, 6,2);
			}
			if(substr($hora, 1, 1)== ":"){
				$hora24=substr($hora, 0, 1); $minuto60= substr($hora, 2, 2); $segundo60=substr($hora, 5,2);
			}
			if(substr($hora, 2, 1)!= ":" && substr($hora, 1, 1)!= ":") die("error en los valores de la hora 1");
			if($hora24>23 || $minuto60 > 59 || $segundo60 >59) die("error en los valores de la hora 2");
			if(!ctype_digit($hora24) || !ctype_digit($minuto60) ) die("error en los valores de la hora 3");
			//necesito dos if porque podria ser tanto 7:35:34 como 07:35:34  
		//número maquinaria
			$this->db->query("SELECT * 
						from maquinaria
						where nro_maquinaria= '$nro_maquinaria'
						limit 1");

			if($this->db->numRows() != 1) die("error102");

			if(!ctype_digit($nro_maquinaria)) die("error103");
			if($nro_maquinaria<1)die("error104");

		//detalle novedad
			if(strlen($detalle_novedad)<2) die("texto demasiado corto es invalido");
			$detalle_novedad = substr($detalle_novedad, 0, 140);
			$detalle_novedad = $this->db->escapeString($detalle_novedad); 
		//cuit profesor
			if (strlen($cuit_profesor)!=13) die("Error. Revea el cuit");
			$cuit_profesor = $this->db->escapeString($cuit_profesor);
			if(substr($cuit_profesor, 2, 1) != '-' || substr($cuit_profesor, 11, 1) != '-' || !ctype_digit(substr($cuit_profesor, 0, 2)) || !ctype_digit(substr($cuit_profesor, 3, 8)) || !ctype_digit(substr($cuit_profesor, 12, 1)) ) die("error104");
			$this->db->query("SELECT * 
						from profesor
						where cuit_profesor= '$cuit_profesor'
						limit 1");

			if($this->db->numRows() != 1) die("error105");
	//FIN VALIDACIONES	
			
		$this->db->query("INSERT INTO planilla_info_maquinaria(fecha, hora, detalle_novedad, nro_maquinaria, cuit_profesor) 
								VALUES('$fecha', '$hora', '$detalle_novedad', $nro_maquinaria, '$cuit_profesor') "); //Si no especifico el id_planilla_productos (el cual es auto-increment) se automatiza y funciona bien. En caso de querer especificarlo se le pone null y se automatiza asi el auto-increment

	}


	/**
	* Función que recupera y retorna todos los productos existentes en la base de datos
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @return array(arrays). Retorna un array de array.
	*/
	public function getTodosLosProductos(){
		$this->db->query("SELECT * FROM producto");
		
		return $this->db->fetchAll();
	}

}