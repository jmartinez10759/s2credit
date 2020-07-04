<?php 

require 'Conexion.php';

/**
 * Class Entity
 *
 **/
abstract class Entity extends Conexion 
{
	abstract protected function query();
	abstract protected function store($data);
	abstract protected function update($id, $data);	
	abstract protected function destroy($id);	
	abstract protected function show($id);	
}
