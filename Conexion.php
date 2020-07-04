<?php 


abstract class Conexion{

	private $_host;

	private $_user;

	private $_db;

	private $_password;

	protected $_conn;


	public function __construct()
	{
		$this->_host 	  = "127.0.0.1";
		$this->_user 	  = "root";
	    $this->_password  = "main";
		$this->_db 	      = "s2credit";	
		$this->_conexion();
	}
	/**
	 * Method for conection to db s2credit
	 * 
	 **/
	private function _conexion()
	{
		try {
		   if(!$this->_conn){ 
		       $this->_conn = new PDO("mysql:host=".$this->_host.";dbname=".$this->_db , $this->_user,$this->_password);
		   }
		}
		catch(PDOException $e) {
		    echo $e->getMessage();
		}

	}

}
