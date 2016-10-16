<?php
	include 'init.php';
	$link = new Conexion_postgre();

	if(isset($_GET['cedula']) || empty($_GET['cedula'])) {
		delete_pasante($_GET['cedula']);
		header('Location: buscar.php'); 
		exit();
	}
?>