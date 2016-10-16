<?php
	
if (isset($_POST['search_term']) == true && empty($_POST['search_term']) == false) {
	
	$search_term = $_POST['search_term'];
	include '../queries/db_connect.php';
	$link = new Conexion_postgre();
	$query = pg_query("SELECT nombre_especialidad
						FROM especialidades
						WHERE nombre_especialidad
						LIKE '%$search_term%'");

	while (($row = pg_fetch_assoc($query)) !== false) {
		echo '<li>', $row['nombre_especialidad'],'</li>';
	}
	
}
?>