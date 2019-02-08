<?php
	require 'Routes.php';
	require 'db_conn.php';
	require '_autoload.php';
	
	$routes = new \carshop\Routes();

	$frontController = new \core\FrontController(new \carshop\Routes, isset($_GET['route']) ? $_GET['route'] : null, isset($_GET['action']) ? $_GET['action'] : null);
	echo $frontController->output();

?>
