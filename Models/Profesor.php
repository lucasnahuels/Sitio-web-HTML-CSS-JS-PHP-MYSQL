<?php

/**
* Clase para trabajar con los datos de los profesores
*
* @package LuksAplicacion
* @author Lucas <lucasnahuelstp@gmail.com>
* @version 0.1
*/
class Profesor extends Model
{

	/**
	* Funcion que crea un nuevo profesor
	* 
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit. Un string con el cuit único e irrepetible del profesor
	* @param string $nombre. Un string con el nombre del profesor 
	* @param string $apellido. Un string con el apellido del profesor 
	* @param string $sexo. Un string con el sexo del profesor 
	* @param string $tipo_doc. Un string con el tipo de documento del profesor 
	* @param interger $nro_doc. Un interger con el número del documento del profesor
	* @param string $dire. Un string con la dirección del profesor
	* @param interger $telefóno. Un interger con el teléfono del producto
	* @param string $correo. Un string con el correo de cada profesor, el cual es único
	* @param string $fecha_nac. Un string con la fecha de nacimiento del profesor
	*/	
	public function altaProfesor($cuit,$nombre,$apellido,$sexo,$tipo_doc,$nro_doc,$dire, $telefono, $correo, $fecha_nac){
	//VALIDACIONES
		//cuit
			if (strlen($cuit)!=13) die("error11. Revea el cuit");
			$cuit = $this->db->escapeString($cuit);
			if(substr($cuit, 2, 1) != '-' || substr($cuit, 11, 1) != '-' || !ctype_digit(substr($cuit, 0, 2)) || !ctype_digit(substr($cuit, 3, 8)) || !ctype_digit(substr($cuit, 12, 1)) ) die("error11.1");
		//nombre
			if(strlen($nombre)<2) die("error12");
			$nombre = substr($nombre, 0, 50);
			$nombre = $this->db->escapeString($nombre);
		//apellido
			if(strlen($apellido)<2) die("error13");
			$apellido = substr($apellido, 0, 50);
			$apellido= $this->db->escapeString($apellido);
		//sexo
			if (strlen($sexo)!=1) die("error14");
			$sexo = $this->db->escapeString($sexo);
		//tipo_documento
			if (strlen($tipo_doc)<4) die("error15");
			$tipo_doc= substr($tipo_doc, 0, 10);
			$tipo_doc = $this->db->escapeString($tipo_doc);
		//nro documento
			if(!ctype_digit($nro_doc)) die("error16");
			/*$this->db->query("SELECT * 
						from profesor
						where nro_documento = '$nro_doc'
						limit 1");

			if($this->db->numRows() == 1) die("error. el nro de dni ya existe en la base de datos");*/ //NO porque lo único es la combinación de tipo_doc y nro_doc
			if(substr($cuit, 3, 8)!= $nro_doc) die("error, el dni y c.u.i.t no coinciden");
		//direccion
			if (strlen($dire)<4) die("error17");
			substr($dire, 0, 50);
			$dire = $this->db->escapeString($dire);
		//telefono
			if(!ctype_digit($telefono)) die("error18");
		//correo
			if(strlen($correo)<2) die("error19");
			$correo = substr($correo, 0, 50);
			$correo = $this->db->escapeString($correo);
			$this->db->query("SELECT * 
						from profesor
						where correo = '$correo'
						limit 1");

			if($this->db->numRows() == 1) die("error. el correo ya existe en la base de datos");
		//fecha nacimiento
			$fecha_nac = $this->db->escapeString($fecha_nac); //sumarle los substr para que sea xxxx-xx-xx
			if(substr($fecha_nac, 2 , 1)!="/" || substr($fecha_nac, 5 , 1)!="/" ) die("error en el modo de la fecha");
			if(!ctype_digit(substr($fecha_nac, 0, 2)) || !ctype_digit(substr($fecha_nac, 3, 2)) || !ctype_digit(substr($fecha_nac, 6, 4)) ) die("error. los valores de la fecha deben ser númericos"); 
			$dia=substr($fecha_nac, 0, 2); $mes=substr($fecha_nac, 3, 2); $anio= substr($fecha_nac, 6, 4);
			if($dia>31 || $mes>12) die("error en los valores de la fecha");
			if($anio>date("Y") || 
				$anio==date("Y") && $mes>date("m") ||  
				$anio==date("Y") && $mes==date("m") && $dia>date("d")) die("error en los valores de la fecha 2"); //porque la fecha no puede ser futura
			$fecha_nac= $anio . '-' . $mes . '-' . $dia;
	//FIN VALIDACIONES

		$this->db->query("INSERT INTO profesor (cuit_profesor, nombre, apellido, sexo, tipo_documento, nro_documento, direccion, telefono, correo, 											fecha_nacimiento, estado)
								VALUES ('$cuit', '$nombre', '$apellido', '$sexo', '$tipo_doc', $nro_doc, '$dire', $telefono, '$correo', '$fecha_nac', 'Activo') ");
	}


	/**
	* Función que le da una baja lógica a profesor 
	*
	* Esta función no elimina el profesor, sino que lo conserva pero en estado 'inactivo'
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit. Un string con el número de cuit único e irrepetible del profesor
	*/
	public function desactivarProf($cuit){
	//VALIDACIONES
		//cuit
		if (strlen($cuit)!=13) die("error11. Revea el cuit");
		$cuit = $this->db->escapeString($cuit);
	//FIN VALIDACIONES

		if($this->existeProf_Activo($cuit)== true){
			
			$this->db->query("UPDATE profesor 
						SET estado = 'Inactivo'
						where cuit_profesor='$cuit'"); //IMPORTANTE tambien las comillas simples encerrando el cuit aqui
		}
	}


	/**
	* Función que pregunta por la existencida de un profesor en estado activo
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit. Un string con el nro de cuit e irrepetible del profesor 
	* @return bool. Retorna un verdadero si existe y un falso si no
	*/	
	public function existeProf_Activo($cuit){
	//VALIDACIONES
		//cuit
		if (strlen($cuit)!=13) die("error11. Revea el cuit");
		$cuit = $this->db->escapeString($cuit);
	//FIN VALIDACIONES	
		$this->db->query("SELECT * 
						from profesor
						where cuit_profesor= '$cuit' and estado='Activo'
						LIMIT 1");

		if($this->db->numRows() != 1) return false;

		return true;
	}


	/**
	* Función que busca un determinado profesor en la base de datos consultando por su nombre y apellido
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $nombre. Un string con el nombre del profesor 
	* @param string $apellido. Un string con el apellido del profesor 
	* @return array(arrays). Retorna un array de array.
	*/
	public function buscarProfesores($nombre, $apellido){
	//VALIDACIONES
		//nombre
			if(strlen($nombre)<2) die("error12");
			$nombre = substr($nombre, 0, 50);
			$nombre = $this->db->escapeString($nombre);
		//apellido
			if(strlen($apellido)<2) die("error13");
			$apellido = substr($apellido, 0, 50);
			$apellido= $this->db->escapeString($apellido);
	//FIN VALIDACIONES

		$this->db->query("SELECT * 
						from profesor
						where nombre='$nombre' and apellido='$apellido' and estado='Activo'");


		if($this->db->numRows() < 1) return array(); //que ocurre si quito esta linea?

		return $this->db->fetchAll();
	}


	/**
	* Función que recupera y retorna el cuit de un profesor conusltando según su nombre y apellido
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $nombre. Un string con el nombre del profesor 
	* @param string $apellido. Un string con el apellido del profesor 
	* @return string. Retorna un string con el cuit del profesor
	*/
	public function getCuit($nombre, $apellido){
	//VALIDACIONES
		//nombre
			if(strlen($nombre)<2) die("error12");
			$nombre = substr($nombre, 0, 50);
			$nombre = $this->db->escapeString($nombre);
		//apellido
			if(strlen($apellido)<2) die("error13");
			$apellido = substr($apellido, 0, 50);
			$apellido= $this->db->escapeString($apellido);
	//FIN VALIDACIONES

		$this->db->query("SELECT * 
						from profesor
						where nombre='$nombre' and apellido='$apellido' and estado='Activo'
						LIMIT 1");

		$validacion= $this->db->fetch(); 
		return $validacion['cuit_profesor'];
	}


	/**
	* Función que pregunta por la existencida de un profesor, pero esta vez en estado inactivo
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit. Un string con el número de cuit único e irrepetible del profesor 
	* @return bool. Retorna un verdadero si existe y un falso si no
	*/	
	public function existeProf_Inactivo($cuit){
	//VALIDACIONES
		//cuit
		if (strlen($cuit)!=13) die("error11. Revea el cuit");
		$cuit = $this->db->escapeString($cuit);
	//FIN VALIDACIONES	

		$this->db->query("SELECT * 
						from profesor
						where cuit_profesor= '$cuit' AND estado='Inactivo'
						LIMIT 1");

		if($this->db->numRows() != 1) return false;

		return true;
	}


	/**
	* Función que le modifica el estado a un profesor que estaba en estado de inactivo y lo cambia a activo
	* 
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $cuit. Un string con el número de cuit único e irrepetible del profesor 
	*/
	public function activarProf($cuit){
	//VALIDACIONES
		//cuit
		if (strlen($cuit)!=13) die("error11. Revea el cuit");
		$cuit = $this->db->escapeString($cuit);
	//FIN VALIDACIONES	

		$this->db->query("UPDATE profesor 
					SET estado = 'Activo'
					where cuit_profesor='$cuit'"); //IMPORTANTE tambien las comillas simples encerrando el cuit aqui
	}


	/**
	* Función que recupera y retorna el cuit de un profesor conusltando según su nombre y apellido
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $email. Un string con el correo del profesor, el cual es único e irrepetible
	* @return array(arrays). Retorna un array de array.
	*/
	public function getCuitProfesorPorUsuario($email){ //el email es unico para cada usuario
	//VALIDACIONES
		//correo
			if(strlen($email)<2) die("error19");
			$email = substr($email, 0, 50);
			$email = $this->db->escapeString($email);
	//FIN VALIDACIONES	

		$this->db->query("SELECT cuit_profesor
						 FROM profesor
						 WHERE correo='$email' 
						 LIMIT 1 ");

			if($this->db->numRows() < 1) return array(); 
			if($this->db->numRows() > 1) die("error. Hay más de un profesor con el mismo mail"); 
			

		return $this->db->fetch();

	}

}