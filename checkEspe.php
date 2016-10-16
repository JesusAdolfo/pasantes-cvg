<?php

	include 'queries/db_connect.php';
	$link = new Conexion_postgre();
	
	$nombre_espe=$_POST['espe'];
	$result = pg_query("SELECT nombre_especialidad 
							FROM especialidades
							WHERE
							nombre_especialidad='$nombre_espe'");
								
	if(pg_num_rows($result)==0){
		echo 0;
	}else{
		echo 1;
	}
?>