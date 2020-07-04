<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'MenuController.php';

$objMenu = new MenuController();


if (count($_POST) > 0 && !isset($_GET['update'])) {
	return $objMenu->store($_POST);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['delete'])) {
	return $objMenu->destroy($_GET['delete']);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
	return $objMenu->show($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['update'])) {
	return $objMenu->update($_GET['update'], $_POST );
}

return $objMenu->index();





