<?php 

require_once 'Entity.php';

class SubMenu extends Entity
{

	private $_table = 'submenus';

	public function query()
	{
		$result = $this->_conn->query("SELECT * FROM {$this->_table};");
		return $result->fetchAll();
	}

	public function store($data)
	{
		$this->_conn->beginTransaction();
			$insert = $this->_conn->exec('INSERT INTO '.$this->_table.' (menu_id,name,status) VALUES ("'.$data['menu_id'].'","'.$data['name'].'", TRUE )');
		$this->_conn->commit();
		
		if ($insert){
		    $maxId = $this->_conn->query("SELECT MAX(id) as id FROM {$this->_table};");
		    return $maxId->fetch();
		}
	
		$this->_conn->rollback();

	}

	public function update($id, $data)
	{
		echo "Realizo update";
	}

	public function show($id)
	{
		$menus = $this->_conn->query("SELECT * FROM {$this->_table};");
		return $menus->fetch();
	}

	public function destroy($id)
	{
		$this->_conn->beginTransaction();
			$insert = $this->_conn->exec("DELETE FROM ".$this->_table." WHERE menu_id = {$id}");
		$this->_conn->commit();
		
		if ($insert){
			return true;
		}
	
		$this->_conn->rollback();
	}



}

