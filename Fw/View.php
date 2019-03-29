<?php
abstract class View{
	public function render(){
	

		include '../html/'.get_class($this).'.php';//include copia y pega.. No es lo mismo que using
	}
}