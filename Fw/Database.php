<?php

//database.php


/**
* Clase del framewrok que contiene todas las funciones necesarias para intereactuar con la base de datos 
*
* @package LuksAplicacion
* @author Lucas <lucasnahuelstp@gmail.com>
* @version 0.1
*/
class Database{

	private $res;
	private $cn = false;
	private static $instance = false; // no es de los objetos database, sino de la clase database. Static lo convierte en un miembro de clase en lugar de miembro de instancia


	/**
	* Función que hace singleton 
	*/
	private function __construct(){

	}


	/**
	*Funcion que crea una instancia de la base de datos si es que aún no fue creada
	*
	* @return un objeto tipo clase database
	*/
	public static function getInstance(){
		if(!self::$instance) self::$instance = new database; // self es como un this para metodos static
		return self::$instance;
	}

	//static significa no es un metodo de la instancia sino que es un metodo de la clase


	/**
	* Función que conecta a la base de datos correspondiente
	*/
	private function connect(){
		$this->cn = mysqli_connect("localhost","root","","gimnasio");
		$this->query("SET names UTF8");
	}


	/**
	* Función que permite realizar una consulta a la base de datos
	*
	* @param string. Recibe un string de texto con la consulta que se le realiará a la base de datos
	*/
	public function query($q) {
		if(!$this->cn) $this->connect();
		$this->res= mysqli_query($this->cn, $q); //Si no fuera this->$res y seria solo $res, no hablariamos de la misma variable (this-> es una referencia a si mismo)
		if(mysqli_error($this->cn)!=""){
			die("Error consulta $q - -". mysqli_error($this->cn));
		}
	}


    /**
	* Función que retorna fila por fila la consulta previamente realizada
	*
	* @return array. Retorna un array.
	*/
	public function fetch(){
		return mysqli_fetch_assoc($this->res);
	}


 	/**
	* Función que retorna la cantidad de filas que contiene la consulta realizada previamente
	*
	* @return un interger. Retorna un entero
	*/
	public function numRows(){
		return mysqli_num_rows($this->res);
	}


	/**
	* Función que retorna todas filas de la consulta realizada previamente
	*
	* @return array(arrays). Retorna un array de array.
	*/
	public function fetchAll(){
		
		while ($fila = $this->fetch()) 
			$aux[] = $fila;
		
		return $aux; 
	}


	/**
	* Función que escapa caracteres especiales en la cadena dada para que sea seguro usarla. Si se van a insertar datos binarios, se ha de usar esta función.
	*
	* @param string. Recibe un string de texto al que se le quiere escapar caracteres esepciales
	*
	* @return string. Retorna un string de texto
	*/
	public function escapeString($str) {
		if(!$this->cn) $this->connect();
		return mysqli_escape_string($this->cn, $str);
	}


	/**
	* Función que recupera el ID generado por la consulta anterior (normalmente INSERT) para una columna AUTO_INCREMENT.
	*
	* @return interger. Retorna un entero
	*/
	public function insertId(){
		return mysqli_insert_id($this->cn);
	}

}
//Los metodos públcios de la clase son la interfaz, ya que son la forma de relacionarnos con la clase




