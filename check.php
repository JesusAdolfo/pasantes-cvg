<?php

	include 'queries/db_connect.php';
	$link = new Conexion_postgre();
	
	$nombre_insti=$_POST['instituto'];
	$result = pg_query("SELECT nombre_institucion 
							FROM instituciones
							WHERE
							nombre_institucion='$nombre_insti'");
								
	if(pg_num_rows($result)==0){
		echo 0;
	}else{
		echo 1;
	}
?>
