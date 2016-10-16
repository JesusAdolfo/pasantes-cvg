<?php include 'header2.php';
if ($_SESSION['tipo']!=1 || !logged_in()){
	header('Location: index.php');
}

 

		
		$link2 = new Conexion_Intranet();
		
		$user= $_SESSION['login_usuario'];
		$result2=pg_query("SELECT cedula 
						FROM validar 
						WHERE login=UPPER('$user')");
		$tind;
		
		while($row = pg_fetch_row($result2)){
			$tind= $row[0];
		}
		
		$link = new Conexion_postgre();
		
		$fecha_actual = date('Y-m-d');
		
		
		$result = pg_query("SELECT cod_pasantia,
							cedula_pasante,
							fecha_inicio,
							fecha_fin, 		
							descripcion_pasantia
							FROM pasantias
							WHERE tutor_industrial = '$tind'
							AND fecha_fin > '$fecha_actual' ");
							
		$num = pg_num_rows($result);
		$i=0;
		
		
		
		echo '<table class="tablas" width=90% style=" display:table; margin-top:30px;" >';
		
		echo '<thead>';
			echo "<tr>";
				echo '<th width=15%>Cedula Pasante</th>';
				echo '<th width=15%>Nombres</th>';
				echo '<th>Apellidos</th>';
				echo '<th>F. Inicio</th>';
				echo '<th>F. Fin</th>';
				echo '<th>Descripcion</th>';
				echo '<th></th>';
				
			echo "</tr>";
		echo '</thead>';

    	echo "<tbody>";
		
		if ($num == 0){
			echo "<tr><td colspan=\"0\">usted no tiene pasantes vinculados a su cuenta</td></tr>";
		}else{
			while($i < $num){
				$cod = pg_fetch_result($result, $i, "cod_pasantia");
				$ced = pg_fetch_result($result, $i, "cedula_pasante");
				$fini = pg_fetch_result($result, $i, "fecha_inicio");
				$fini=date("d-m-Y", strtotime($fini));
				$ffin = pg_fetch_result($result, $i, "fecha_fin");
				$fechaMax = date('Y-m-d', strtotime($ffin. ' +8 days'));
				
				$ffin=date("d-m-Y", strtotime($ffin));
				
				if ($fecha_actual < $fechaMax){
				
					$desc = pg_fetch_result($result, $i, "descripcion_pasantia");
									
					$query = pg_query("SELECT nombres, apellidos FROM pasantes WHERE cedula='$ced'");
					
					$nombres =pg_fetch_result($query, 0, "nombres");
					$apellidos =pg_fetch_result($query, 0, "apellidos");
					
					echo "<tr>";
					 echo "<td>".$ced."</td>";
					 echo "<td>".$nombres."</td>";
					 echo "<td>".$apellidos."</td>";
					 echo "<td>".$fini."</td>";
					 echo "<td>".$ffin."</td>";
					 echo "<td>".$desc."</td>";
					 echo '<td><a href="pasantias.php?cedula='.$ced.'&cod='.$cod.'" class="detalle"> <img src="img/detalle.png" alt="Detalle"></a></td>';
					 echo "</tr>";
					 
				}
				
				$i++;
			}
			
			echo "</tbody>";
		echo"<tfoot>";
    	echo"<tr>";
        	echo'<td colspan="10"><em>Pasantias en las que usted es tutor</em></td>';
        echo"</tr>";
    	echo"</tfoot>";
    	echo"</table>";
		}
	
	?>

<?php include 'footer2.php'; ?>

<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantias > Tutores").html;
    });
</script>

<script src="js/tooltip.js"></script>
