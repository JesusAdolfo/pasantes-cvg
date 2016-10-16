<?php
	
if (isset($_POST['search_term']) == true && empty($_POST['search_term']) == false) {
	
	$search_term = $_POST['search_term'];
	include '../queries/db_connect.php';
	$link = new Conexion_postgre();
	$query = pg_query("SELECT cedula
						FROM pasantes
						WHERE cedula
						LIKE '%$search_term%'");

	while (($row = pg_fetch_assoc($query)) !== false) {
		echo '<li>', $row['cedula'],'</li>';
	}
	
}
?>