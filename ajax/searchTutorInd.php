<?php
	
if (isset($_POST['search_term']) == true && empty($_POST['search_term']) == false) {
	
	$search_term = $_POST['search_term'];
	include '../queries/db_connectRRHH.php';
	$link = new Conexion_RRHH();
	$query = pg_query("SELECT cedula, nombres, apellidos
						FROM tablasmaestras.maestra
						WHERE estado=''
						AND nomina<>'5' 
						AND nomina<>'8' AND
						CAST(cedula AS TEXT)						
						LIKE '%$search_term%'
						ORDER BY cedula ASC LIMIT 10");


	while (($row = pg_fetch_assoc($query)) !== false) {
		$row['nombres']=trim($row['nombres']);
		$row['apellidos']=trim($row['apellidos']);
		echo '<li>', $row['cedula'].' '.$row['nombres'].' '.$row['apellidos'] ,'</li>';
	}
	
}
?>	