<?php

	include 'queries/db_connect.php';
	$link = new Conexion_postgre();
	
	$nombre_area=$_POST['area'];
	$result = pg_query("SELECT nombre_area 
							FROM areas
							WHERE
							nombre_area='$nombre_area'");
								
	if(pg_num_rows($result)==0){
		echo 0;
	}else{
		echo 1;
	}
?>