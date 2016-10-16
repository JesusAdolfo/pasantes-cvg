<?php include 'header.php';

		$link = new Conexion_postgre();
		
		
		$result = pg_query("SELECT cod_factor,
							descripcion, posicion, activo 		
							FROM factores
							ORDER BY posicion");
							
		$num = pg_num_rows($result);
		$i=0;
		
		
		echo '<table class="tablas" width=90% style=" display:table; margin-top:30px;" >';
		
		echo '<thead>';
			echo "<tr>";
				echo '<th width=15%>Descripción</th>';
				echo '<th width=1%>Posición</th>';
				echo '<th width=1%>Estado</th>';
				echo '<th width=1%></th>';
				echo '<th width=1%></th>';
				
			echo "</tr>";
		echo '</thead>';

    	echo "<tbody>";
		
		if ($num == 0){
			echo "<tr><td colspan=\"0\">usted no tiene pasantes vinculados a su cuenta</td></tr>";
		}else{
			while($i < $num){
				$cod = pg_fetch_result($result, $i, "cod_factor");
				$desc = pg_fetch_result($result, $i, "descripcion");
				$pos = pg_fetch_result($result, $i, "posicion");
				$act = pg_fetch_result($result, $i, "activo");

				$activo;
				if($act=='s'){
					$activo='HABILITADO';
				}else{
					$activo="NO HABILITADO";
				}
				
				echo "<tr>";
				 echo "<td>".$desc."</td>";
				 echo "<td>".$pos."</td>";
				 echo "<td>".$activo."</td>";
				 echo '<td><a href="editar_factor.php" class="teditar"><img src="img/edit2.png" alt="editar"></a></td>';
				 
				 if(factor_existe_pasantia($cod)){
					echo '<td><a class="no_disponible" ><img src="img/trash3.png" alt="eliminar"></a></td>';
				 }else{
					echo '<td><a onClick=ConfirmacionF(',$cod,') class="teliminar delete" ><img src="img/trash2.png" alt="eliminar"></a></td>';
					
				}
				 echo "</tr>";
				
				$i++;
			}
			
			echo "</tbody>";
		echo"<tfoot>";
    	echo"<tr>";
        	echo'<td colspan="10"><em>Factores de evaluación</em></td>';
        echo"</tr>";
    	echo"</tfoot>";
    	echo"</table>";
		}
		
		
	
	?>
	
<?php include 'footer.php'; ?>



<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Evaluaciones > Factores de Evaluación").html;
    });
</script>
<script src="js/script.js"></script>
<script src="js/tooltip.js"></script>
