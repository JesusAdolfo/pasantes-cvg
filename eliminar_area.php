<?php
	include 'init.php';
	$link = new Conexion_postgre();

	if(isset($_GET['cod_area']) || empty($_GET['cod_area'])) {
		delete_area($_GET['cod_area']);
		header('Location: '.$_SERVER['HTTP_REFERER']); 
		exit();
	}
?>