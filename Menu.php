<?php 

require 'Entity.php';

class Menu extends Entity
{

	private $_table = 'menus';

	public function query()
	{
		$query = "SELECT 
					m.id,
					m.name,
					m.description,
					m.status,
					s.name as submenu
				   FROM menus m
				   JOIN submenus s on m.id = s.menu_id;";
		return $this->_conn->query($query)->fetchAll();
		
	}

	public function store($data)
	{
		$this->_conn->beginTransaction();
			$insert = $this->_conn->exec('INSERT INTO '.$this->_table.' (name,description,status) VALUES ("'.$data['name'].'", "'.$data['description'].'", TRUE )');
		$this->_conn->commit();
		
		if ($insert){
			$maxId = $this->_conn->query("SELECT MAX(id) as id FROM {$this->_table};");
		    return $maxId->fetch();
		}
	
		$this->_conn->rollback();

	}

	public function show($id)
	{
		$query = "SELECT 
					m.id,
					m.name,
					m.description,
					m.status,
					s.name as submenu
				   FROM menus m
				   JOIN submenus s on m.id = s.menu_id
				   WHERE m.id = {$id};";
		$rs = $this->_conn->query($query)->fetch();
		return [
			'id'            => $rs['id'],
			'name'          => $rs['name'],
			'description'   => $rs['description'],
			'submenu' 		=> $rs['submenu'],
			'status' 		=> $rs['status']
		];
	}

	public function destroy($id)
	{
		$this->_conn->beginTransaction();
			$insert = $this->_conn->exec("DELETE FROM ".$this->_table." WHERE id = {$id}");
		$this->_conn->commit();
		
		if ($insert){
			return true;
		}
	
		$this->_conn->rollback();
	}

	public function update($id, $data)
	{
		$this->_conn->beginTransaction();
            $sql = "UPDATE menus m
            		JOIN submenus s on m.id = s.menu_id
            		SET 
            		    m.name = '{$data['name']}',
            		    m.description = '{$data['description']}',
            		    s.name = '{$data['submenu']}'
            		WHERE m.id = {$id}";
			$result = $this->_conn->exec($sql);
		$this->_conn->commit();
		
		if ($result){
			$this->show($id);
			return;
		}
	
		$this->_conn->rollback();

	}


}

