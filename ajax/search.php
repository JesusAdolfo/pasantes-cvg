<?php
	
if (isset($_POST['search_term']) == true && empty($_POST['search_term']) == false) {
	
	$search_term = $_POST['search_term'];
	include '../queries/db_connect.php';
	$link = new Conexion_postgre();
	$query = pg_query("SELECT nombre_institucion
						FROM instituciones
						WHERE nombre_institucion
						LIKE '%$search_term%'");

	while (($row = pg_fetch_assoc($query)) !== false) {
		echo '<li>', $row['nombre_institucion'],'</li>';
	}
	
}
?>