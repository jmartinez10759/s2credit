<?php

require 'Menu.php';
require 'SubMenu.php';

class MenuController
{
  
  private $_menu;

  public function __construct()
  {
      $this->_menu = new Menu;
      $this->_submenu = new SubMenu;
  }

   public function index()
   {
	    $menus = $this->_menu->query();
      include 'viewMenu.php';
   }
   /**
    * Method create new menu
    *
    **/
   public function store($request)
   {
      $storeMenu = [
          'name'        =>  $request['name'],
          'description' =>  $request['description'],
      ];     
      $menu = $this->_menu->store($storeMenu);
      if (isset($request['submenu']) && $request['name'] ) {
          $items = [
             'menu_id' => $menu['id'],
             'name'    => $request['submenu']
          ];
          $this->_submenu->store($items);
      }

   }

   public function destroy($id)
   {
      $this->_submenu->destroy($id);
      $this->_menu->destroy($id);
   }

   public function show($id)
   {
       $result = $this->_menu->show($id);
       echo json_encode($result);
   }

    public function update($id, $request )
   {
       $result = $this->_menu->update($id,$request);
   }


}

