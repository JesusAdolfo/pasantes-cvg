<?php
	include 'init.php';
	$link = new Conexion_postgre();

	if(isset($_GET['cod_especialidad']) || empty($_GET['cod_especialidad'])) {
		delete_especialidad($_GET['cod_especialidad']);
		header('Location: '.$_SERVER['HTTP_REFERER']); // locates user to previous album
		exit();
	}
?>