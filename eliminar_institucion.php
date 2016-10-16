<?php
	include 'init.php';
	$link = new Conexion_postgre();

	if(isset($_GET['cod_institucion']) || empty($_GET['cod_institucion'])) {
		delete_institucion($_GET['cod_institucion']);
		header('Location: '.$_SERVER['HTTP_REFERER']); // locates user to previous album
		exit();
	}
?>