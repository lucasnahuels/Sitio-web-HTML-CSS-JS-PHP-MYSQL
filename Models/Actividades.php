<?php


/**
* Clase para trabajar con los datos de las actividades
*
* @package LuksAplicacion
* @author Lucas <lucasnahuelstp@gmail.com>
* @version 0.1
*/
class Actividades extends Model
{

	/**
	* Función que recupera y retorna todas las actividades que tiene la base de datos
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @return array(arrays). Retorna un array de array.
	*/
	public function getTodas(){
		$this->db->query("SELECT * FROM actividad");
		return $this->db->fetchAll();
	}


	/**
	* Función que pregunta por la existencua del nombre de la actividad ingresada
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $nombreactividad. Un string con el nombre de la actividad
	* @return bool. Retorna un true si existe y un false si no.
	*/
	public function existeActividad($nombreactividad){
	//VALIDACIONES 
		//Nnombre actividad
		if(strlen($nombreactividad)<2) return false;
		$nombreactividad = substr($nombreactividad, 0, 30);
		$nombreactividad= $this->db->escapeString($nombreactividad); 
	//FIN VALIDACIONES
		$this->db->query("SELECT * 
						from actividad
						where nombre_actividad= '$nombreactividad'
						limit 1");

		if($this->db->numRows() != 1)return false;

		return true;
	}


	/**
	* Función que le da una baja lógica a todas las relaciones entre actividad y profesor en las que el profesor es el mismo.
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* Esta función no elimina las relaciones en las que un profesor estaba inscripto como apto, sino que les da una baja lógica. Esto sigifica que les cambia 
	* el estado a la relación de 'activo' a 'inactivo'.
	*
	* @param string $cuit. Un string con el número de cuit único e irrepetible del profesor
	*/
	public function desactivarActiProf($cuit){
	//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuit)!=13) die("Error. Revea el cuit");
			$cuit = $this->db->escapeString($cuit);
	//FIN VALIDACIONES
		
				$this->db->query("UPDATE actividad_profesor 
						SET estado = 'Inactivo'
						where cuit_profesor='$cuit'"); //IMPORTANTE tambien las comillas simples encerrando el cuit aqui
		
	}


	/**
	* Función que recupera y retorna todas las activiades en las que está inscripto como apto determinado profesor
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit. Un string con el número de cuit único e irrepetible del profesor
	* @return array(arrays) retorna un array de array.
	*/
	public function getActividadesInscriptas($cuit){
	//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuit)!=13) die("Error. Revea el cuit");
			$cuit = $this->db->escapeString($cuit);
	//FIN VALIDACIONES

		$this->db->query("SELECT * 
							FROM actividad_profesor
							WHERE estado = 'Activo' and cuit_profesor = '$cuit'
							");
		
		return $this->db->fetchAll();
	}
	

	/**
	* Función que inscribe como apto en una actividad a un profesor 
	* 
	* Crea una fila nueva en la relacion entre actividad y profesor
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuitprofesor. Un string con el número de cuit único e irrepetible del profesor 
	* @param string $nombreactividad. Un string con el nombre de la actividad
	*/
	public function agregarActividadProfesor($cuitprofesor, $nombreactividad){
		//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuitprofesor)!=13) die("Error. Revea el cuit");
			$cuitprofesor = $this->db->escapeString($cuitprofesor);
			//$nombreactividad 
			if(!$this->existeActividad($nombreactividad)) die("Error. La actividad ingresada no existe");
			if(strlen($nombreactividad)<2) die("error200");
			$nombreactividad = substr($nombreactividad, 0, 30);
			$nombreactividad= $this->db->escapeString($nombreactividad); 
			//VALIDACION EXISTENCIA actividad_profesor no es ya existente
			if($this->existeActividad_Profesor($cuitprofesor, $nombreactividad)) die("Error. El profesor con cuit $cuitprofesor ya esta inscripto en la actividad $nombreactividad");
		//FIN VALIDACIONES 

		if($this->existeActividad_Profesor_Inactivo($cuitprofesor, $nombreactividad)) 
			$this->db->query("UPDATE actividad_Profesor
							SET estado='Activo'
							WHERE nombre_actividad= '$nombreactividad' AND cuit_profesor= '$cuitprofesor' ");
		
		

		if(!$this->existeActividad_Profesor_Inactivo($cuitprofesor, $nombreactividad)  && !$this->existeActividad_Profesor($cuitprofesor, $nombreactividad)) //en lugar de poner la segunda condicion en el if, otra opcion hubiera sido que sea un else del if anterior, en lugar de un if apartado
			$this->db->query("INSERT INTO actividad_profesor (nombre_actividad, cuit_profesor, estado, Titulo_habilitacion)
							VALUES ('$nombreactividad', '$cuitprofesor', 'Activo', 'Carpeta titulos/$cuitprofesor')"
						);			
	}


	/**
	* Función que le da una baja lógica a una determinada relació entre una actividad y un profesor.
	*
	* Esta función no elimina relación entre la actividad y el profesor, sino que le da una baja lógica. Esto sigifica que le cambia 
	* el estado a la relación de 'activo' a 'inactivo'.
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuitprofesor. Un string con el número de cuit único e irrepetible del profesor
	* @param string $nombreactividad. Un string con el nombre de la actividad
	*/
	public function bajarActividadProfesor($cuitprofesor, $nombreactividad){
		//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuitprofesor)!=13) die("Error. Revea el cuit");
			$cuitprofesor = $this->db->escapeString($cuitprofesor);
			//$nombreactividad 
			if(!$this->existeActividad($nombreactividad)) die("Error. La actividad ingresada no existe");
			if(strlen($nombreactividad)<2) die("error200");
			$nombreactividad = substr($nombreactividad, 0, 30);
			$nombreactividad= $this->db->escapeString($nombreactividad); 
			//VALIDACION EXISTENCIA actividad_profesor existe
			if(!$this->existeActividad_Profesor($cuitprofesor, $nombreactividad)) die("Error. La relación entre $cuitprofesor y $nombreactividad no existe actualmente");
		//FIN VALIDACIONES 	
		$this->db->query("UPDATE actividad_Profesor
						SET estado='Inactivo'
						WHERE nombre_actividad= '$nombreactividad' AND cuit_profesor= '$cuitprofesor' "  
						);
	}


	/**
	* Función que pregunta por la existencida de la relación entre una actividad y un profesor en estado activo
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuitprofesor. Un string con el número de cuit único e irrepetible del profesor
	* @param string $nombreactividad. Un string con el nombre de la actividad
	* @return bool. Retorna un verdadero si existe y un falso si no
	*/
	public function existeActividad_Profesor($cuitprofesor, $nombreactividad){
	//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuitprofesor)!=13) die("Error. Revea el cuit");
			$cuitprofesor = $this->db->escapeString($cuitprofesor);
			//nombre actividad
			if(strlen($nombreactividad)<2) die("error200");
			$nombreactividad = substr($nombreactividad, 0, 30);
			$nombreactividad= $this->db->escapeString($nombreactividad); 
	//FIN VALIDACIONES

		$this->db->query("SELECT * 
						from actividad_profesor
						where nombre_actividad= '$nombreactividad' AND cuit_profesor= '$cuitprofesor' AND estado='Activo'
						limit 1");

			if($this->db->numRows() != 1)return false;

		return true;
	}


	/**
	* Función que pregunta por la existencida de la relación entre una actividad y un profesor pero esta vez en estado inactivo
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuitprofesor. Un string con el número de cuit único e irrepetible del profesor
	* @param string $nombreactividad. Un string con el nombre de la actividad
	* @return bool. Retorna un verdadero si existe y un falso si no
	*/
	public function existeActividad_Profesor_Inactivo($cuitprofesor, $nombreactividad){
	//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuitprofesor)!=13) die("Error. Revea el cuit");
			$cuitprofesor = $this->db->escapeString($cuitprofesor);
			//nombre actividad
			if(strlen($nombreactividad)<2) die("error200");
			$nombreactividad = substr($nombreactividad, 0, 30);
			$nombreactividad= $this->db->escapeString($nombreactividad); 
	//FIN VALIDACIONES
		
		$this->db->query("SELECT * 
						from actividad_profesor
						where nombre_actividad= '$nombreactividad' AND cuit_profesor= '$cuitprofesor' AND estado='Inactivo'
						limit 1");

			if($this->db->numRows() != 1)return false;

		return true;
	}


	/**
	* Función que pregunta por la existencida de la relación entre una actividad y un profesor pero esta vez en estado inactivo
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuitprofesor. Un string con el número de cuit único e irrepetible del profesor 
	* @return bool. Retorna un verdadero si existe y un falso si no
	*/
	public function existeAlgunaActividad_Profesor($cuitprofesor){
	//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuitprofesor)!=13) die("Error. Revea el cuit");
			$cuitprofesor = $this->db->escapeString($cuitprofesor);
	//FIN VALIDACIONES

		$this->db->query("SELECT * 
						from actividad_profesor
						where  cuit_profesor= '$cuitprofesor' and estado='Activo'
						limit 1");

			if($this->db->numRows() != 1)return false;

		return true;
	}


	/**
	* Función que recupera y retorna todas las asistencias de determinado profesor
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit. Un string con el número de cuit único e irrepetible del profesor
	* @return array(arrays). Retorna un array de array.
	*/
	public function getPlanillaAsistencia($cuit){
	//VALIDACIONES 
			//$cuitprofesor 
			if (strlen($cuit)!=13) die("Error. Revea el cuit");
			$cuit = $this->db->escapeString($cuit);
	//FIN VALIDACIONES

		$this->db->query("SELECT * FROM asistencia_profesor 
						WHERE cuit_profesor = '$cuit' ");


			if($this->db->numRows() < 1) return array(); 
		
		return $this->db->fetchAll();
	}


}