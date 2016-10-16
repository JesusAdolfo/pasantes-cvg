<?php include 'header.php';?>
<br><br>
<div id="x-wrapper">
<div class="formss gradient" id="editar_niveles_div">
	<form method="post">
		<h2 class="whitebg"  style="width:300px; margin: 0 auto; margin-bottom:20px;" >Remuneraci&oacute;n por nivel</h2>
		<span>Nivel</span>
		<span>Costo</span><br>
		<?php get_niveles_pasantes(); ?>
		
		<div id="button_div">
			<input class="white button" type="submit" name="submit" value="Guardar"/>
		</div>
	</form>
</div>
<div>
 
 <?php	
	if(isset($_POST['submit'])) {
		$reps = contarNiveles();
		$i=1;
		
		while($i <= $reps){
			$desc=$_POST[$i];
			$rem=$_POST['re'.$i];
			
		
			pg_query("UPDATE niveles_pasantes SET descripcion='$desc', remuneracion=$rem WHERE cod_nivel=$i");
			$i++;	
		}
		header('Location:relaciones.php');
		
	} 
?>

<?php include 'footer.php'; ?>
<?php
function get_niveles_pasantes(){
		$link = new Conexion_postgre();

		$result = pg_query("SELECT cod_nivel, descripcion, remuneracion
							 FROM niveles_pasantes
							 ORDER BY remuneracion ASC");
		$num = pg_num_rows($result);
		
		
		$i=0;

		if ($num == 0){
    			echo 'AGREGUE NIVELES DE ESTUDIO';
    		}else{
				while ($i < $num) {
					$cod_nivel = pg_fetch_result($result, $i, "cod_nivel");
					$desc = pg_fetch_result($result, $i, "descripcion");
					$remuneracion = pg_fetch_result($result, $i, "remuneracion");

					echo   " <input name=\"$cod_nivel\" class=\"white notsowidearea\" type=\"text\" value=\"$desc\"> <input name=\"re$cod_nivel\" class=\"white notsowidearea\" type=\"text\" value=\"$remuneracion\" type=\"number\" onkeypress=\"return isNumberKey(event)\"> <br>";

					$i++;
				}
			}
	}
?>


<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Relaciones de Pago > Cambiar monto de remuneraciones").html;
    });
</script>

<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}    
</script>