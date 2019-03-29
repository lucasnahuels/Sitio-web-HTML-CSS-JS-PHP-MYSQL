<?php

/**
* Clase para interactuar con la base de datos, recuperando datos o modificando los mismos
*
* @package LuksAplicacion
* @author Lucas <lucasnahuelstp@gmail.com>
* @version 0.1
*/
abstract class Model{ //una clase abstracta significa que no se puede intsanciar (porque le faltan cosas)
	
	protected $db; //Este miembro era privado pero si fuera privado no podria acceder en las clases hijas, por lo tanto, se le pone protected
	
	/**
	* Funcion que crea una instancia de la base de datos
	*/
	public function __construct(){
		$this->db = Database::getInstance();
	}
}
?>