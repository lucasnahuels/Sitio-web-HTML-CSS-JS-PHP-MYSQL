<?php

/**
* Clase para trabajar con los datos de los usuarios
*
* @package LuksAplicacion
* @author Lucas <lucasnahuelstp@gmail.com>
* @version 0.1
*/
class Usuarios extends Model
{
	
	/**
	* Función que busca el usuario para corroborar su existencia y asi saber si puede o no iniciar sesión
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $email. Un string con el correo del usuario, el cual es único e irrepetible 
	* @param string $passwd. Un string con la contraseña elegida por el usuario 
	* @return bool. Retorna bool verdadero si existe el usuario y un falso si no.
	*/	
	public function BuscarUsuario($email, $passwd){
	//VALIDACIONES
		//email
			if(strlen($email)<2) die("error100");
			$email = substr($email, 0, 50);
			$email = $this->db->escapeString($email);
		//psswd
			if(strlen($passwd)<2) die("error101");
			$passwd = substr($passwd, 0, 50);
			$passwd = $this->db->escapeString($passwd);
	//FIN VALIDACIONES

		$this->db->query("SELECT * 
						FROM usuarios
						WHERE email='$email' and contra=sha1('$passwd')  
						LIMIT 1");
		
		//OJO. la consulta se confunde cuando lleva una Ñ
		//la contraseña con la que estoy probando es hola
	

		if($this->db->numRows() != 1) return false;

		return true;
	}


	/**
	* Función que crea un nuevo usuario
	* 
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $email. Un string con el correo del usuario, el cual es único e irrepetible 
	* @param string $psswd. Un string con la contraseña elegida por el usuario 
	* @param string $confirmacion_contraseña. Un string con la contraseña elegida por el usuario 
	* @param interger $cargo. Un interger con el id de cargo del usuario, el cual es único e irrepetible y debe exisitr 
	* @param string $cuit_profesor. Un string con el cuit único  e irrepetible del profesor
	*/	
	public function CrearUsuario($email, $psswd, $confirmacion_contraseña, $cargo){
	//VALIDACIONES
		//email
			if(strlen($email)<2) die("error100");
			$email = substr($email, 0, 50);
			$email = $this->db->escapeString($email);
		//psswd
			if(strlen($psswd)<2) die("error101");
			$psswd = substr($psswd, 0, 50);
			$psswd = $this->db->escapeString($psswd);
		//confirmación_usuario
			if(strlen($confirmacion_contraseña)<2) die("error102");
			$confirmacion_contraseña = substr($confirmacion_contraseña, 0, 50);
			$confirmacion_contraseña = $this->db->escapeString($confirmacion_contraseña);
		//cargo
			if(!ctype_digit($cargo)) die("error103");
			$this->db->query("SELECT * FROM cargos
							WHERE cargo_id= $cargo 
							LIMIT 1");
			if($this->db->numRows() != 1) die("error104");

	// FIN VALIDACIONES
		
		if($psswd== $confirmacion_contraseña){
			$this->db->query("INSERT INTO usuarios (email, contra, cargo_id)
										VALUES ('$email', sha1('$psswd'), $cargo)
							");
		}

		else die("Error, las contraseñas no coinciden"); //Se puede hacer con Javascript?
	}


	/**
	* Función que pregunta por la existencua de un usuario
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $email. Un string con el correo del usuario, el cual es único e irrepetible 
	* @return bool. Retorna un true si existe y un false si no.
	*/
	public function existeUsuario($email){
	//VALIDACIONES
		//email
			if(strlen($email)<2) die("error100");
			$email = substr($email, 0, 50);
			$email = $this->db->escapeString($email);
	//FIN VALIDACIONES
			
		$this->db->query("SELECT * 
						from usuarios
						where email= '$email'
						LIMIT 1");

		if($this->db->numRows() != 1) return false;

		return true;
	}


	/**
	* Función que recupera y retorna todos los cargos existentes en la base de datos
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @return array(arrays). Retorna un array de array.
	*/
	public function getCargos(){
			$this->db->query("SELECT * FROM cargos");


			if($this->db->numRows() < 1) return array(); 
		
		return $this->db->fetchAll();
	}


	/**
	* Función que recupera y retorna el cargo que posee determinado usuario, consultando según su email
	*
	* Si hay dudas sobre la herencia, chequear {@link Model la clase madre}.
	*
	* @param string $email. Un string con el correo del usuario, el cual es único e irrepetible 
	* @return array. Retorna un array
	*/
	public function getCargoDeUsuario($email){
	//VALIDACIONES
		//email
			if(strlen($email)<2) die("error100");
			$email = substr($email, 0, 50);
			$email = $this->db->escapeString($email);
	//FIN VALIDACIONES

		$this->db->query("SELECT cargo_id
						 FROM usuarios
						 WHERE email='$email' 
						 LIMIT 1 ");

			if($this->db->numRows() < 1) return array(); 

		return $this->db->fetch();

		/* $fila= $this->db->fetch();

		foreach ($fila as $key => $value) {
			$cargo= $value;
		}

		return $cargo; //PREGUNTAR ESTO*/

	}


}