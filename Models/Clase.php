<?php

/**
* Clase para trabajar con los datos de las clases
*
* @package LuksAplicacion
* @author Lucas <lucasnahuelstp@gmail.com>
* @version 0.1
*/
class Clase extends Model
{
	

	/**
	* Función que actualiza profesor de clases, quitandolo al mismo como profesor de todas las clases en las que el mismo dictaba..
	*
	* Esta función no elimina las clases, sino que las conserva sin nadie que las dicte. Quitar el profesor de las clases significa darle un valor de null al * atributo profesor
	*
	* Esta función quita al profesor de todas las clases que dicta, independientemente de cual sea la actividad.
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit. Un string con el número de cuit único e irrepetible del profesor
	*/
	public function desactivarProfClase($cuit){
	//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuit)!=13) die("Error. Revea el cuit");
			$cuit = $this->db->escapeString($cuit);
	//FIN VALIDACIONES	
		
		$this->db->query("UPDATE clase 
				SET cuit_profesor = NULL
				where cuit_profesor='$cuit'"); //IMPORTANTE tambien las comillas simples encerrando el cuit aqui
	}


	/**
	* Función que actualiza profesor de clases de determinada actividad, quitandolo al mismo como profesor de todas las clases de la misma actividad en las   * que el mismo dictaba.
	*
	* Esta función no elimina las clases, sino que las conserva sin nadie que las dicte. Quitar el profesor de las clases significa darle un valor de null al * atributo profesor
	*
	* Esta función quita al profesor de todas las clases que dicta, pero esta vez dependientemente de cual sea la actividad. Esto signfica que se elimina el  * profesor de las clases en las que la actividad es siempre la misma, o sea la que ingresó el usuario.
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuitprofesor. Un string con el número de cuit único e irrepetible del profesor 
	* @param string $nombreactividad. Un string con el nombre de la actividad
	*/
	public function bajarClasesProfesor_determinadaActividad($cuitprofesor, $nombreactividad){
	//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuitprofesor)!=13) die("Error. Revea el cuit");
			$cuitprofesor = $this->db->escapeString($cuitprofesor);
			/*$this->db->query("SELECT * 
						from profesor
						where cuit_profesor= '$cuitprofesor' and estado='Activo'
						LIMIT 1");
			if($this->db->numRows() != 1) die("error201");*/
			//$nombreactividad 
			if(strlen($nombreactividad)<2) die("error200");
			$nombreactividad = substr($nombreactividad, 0, 30);
			$nombreactividad= $this->db->escapeString($nombreactividad); 
			/*$this->db->query("SELECT * 
						from actividad
						where nombre_actividad= '$nombreactividad'
						limit 1");
			if($this->db->numRows() != 1) die("error202");*/
			//Validacion existencia actividad profesor
			/*$this->db->query("SELECT * 
						from actividad_profesor
						where nombre_actividad= '$nombreactividad' AND cuit_profesor= '$cuitprofesor'
						limit 1");
			if($this->db->numRows() != 1) die("error202");*/
	//FIN VALIDACIONES	

			$this->db->query("UPDATE clase
						SET cuit_profesor = NULL
						WHERE nombre_actividad= '$nombreactividad' AND cuit_profesor= '$cuitprofesor' "  
						);
	}


	/**
	* Función que recupera y retorna todas las clases de determinado profesor
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit. Un string con el número de cuit único e irrepetible  del profesor 
	* @return array(arrays). Retorna un array de array.
	*/
	public function getClasesDeProfesor($cuit){
	//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuit)!=13) die("Error. Revea el cuit");
			$cuit = $this->db->escapeString($cuit);
	//FIN VALIDACIONES	

		$this->db->query("SELECT * FROM clase 
						WHERE cuit_profesor= '$cuit' ");

		if($this->db->numRows() < 1) return array(); //que ocurre si quito esta linea?


		return $this->db->fetchAll();
	}


	/**
	* Función que recupera y retorna todos los socios que asisten a cada clase
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit. Un string con el número de cuit único e irrepetible  del profesor 
	* @return array(arrays). Retorna un array de array.
	*/
	public function getSociosClases($cuit){
	//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuit)!=13) die("Error. Revea el cuit");
			$cuit = $this->db->escapeString($cuit);
	//FIN VALIDACIONES	

		$this->db->query("SELECT *, COUNT(socio_clase.nro_socio) cantidad_socios
						FROM socio_clase
						LEFT JOIN clase ON socio_clase.id_clase = clase.id_clase
						WHERE clase.cuit_profesor ='$cuit'
						GROUP BY clase.id_clase");

		if($this->db->numRows() < 1) return array(); //que ocurre si quito esta linea?
		

		return $this->db->fetchAll();
	}

}