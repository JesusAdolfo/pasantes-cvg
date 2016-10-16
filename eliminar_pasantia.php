<?php
	include 'init.php';
	$link = new Conexion_postgre();

	//if(isset($_GET['cedula']) || empty($_GET['cedula']) || isset($_GET['cod']) || empty($_GET['cod'])) {
		delete_pasantia($_GET['cedula'],$_GET['cod']);
		header('Location: buscar.php'); 
		exit();
	//}
?>