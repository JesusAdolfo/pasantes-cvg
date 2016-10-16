<?php
	include 'init.php';
	$link = new Conexion_postgre();

	if(isset($_GET['cod_factor']) || empty($_GET['cod_factor'])) {
		delete_factor($_GET['cod_factor']);
		header('Location: '.$_SERVER['HTTP_REFERER']); 
		exit();
	}
?>