<?php include 'header.php'; 
?>
<br><br>
<div id="x-wrapper">
<div class="formss gradient" id="editar_fac_div">
	<form method="post">
		<h2 class="whitebg"  style="width:550px; margin: 0 auto; margin-bottom:20px;" >Factores de evaluacion</h2>
		
		<?php get_factores_editables(); ?>
		
		<div id="button_div">
			<input class="white button" type="submit" name="submit" value="Guardar"/>
		</div>
	</form>
</div>
<div>

<?php	
	if(isset($_POST['submit'])) {
		
		$link = new Conexion_postgre();

		$result = pg_query("SELECT  cod_factor
							 FROM factores
							 ORDER BY cod_factor ASC");
		$num = pg_num_rows($result);

		$i=0;
		$facs = array();
		
		if ($num == 0){
			echo "NO HAY FACTORES AGREGADOS";
		}else{
			while ($i < $num) {
				$cod = pg_fetch_result($result, $i, "cod_factor");
				
				$facs[]=$cod;
				
				$i++;
			}
			
		}
	
		
		foreach ($facs as $fac){
			$desc=$_POST[$fac];
			$pos=$_POST['pos'.$fac];
			$act=$_POST['act'.$fac];
			
			echo $desc. "<br>";
			echo $pos. "<br>";
			echo $act. "<br>";
		
			pg_query("UPDATE factores SET descripcion='$desc', posicion=$pos, activo='$act' WHERE cod_factor=$fac");
		}
		header('Location:factores.php');
		exit();
	} 
?>

<?php
function get_factores_editables(){
		$link = new Conexion_postgre();
		
		$result = pg_query("SELECT cod_factor, descripcion, posicion, activo
							 FROM factores
							 ORDER BY posicion ASC");
		$num = pg_num_rows($result);
		
		
		$i=0;

		if ($num == 0){
    			echo 'AGREGUE FACTORES';
    		}else{
				while ($i < $num) {
					$cod = pg_fetch_result($result, $i, "cod_factor");
					$desc = pg_fetch_result($result, $i, "descripcion");
					$pos = pg_fetch_result($result, $i, "posicion");
					$act = pg_fetch_result($result, $i, "activo");
					
					$activo;
						if ($act=='s'){
							$activo='activo';
						}else{
							$activo='activo';
						}

					echo   " <input name=\"$cod\" class=\"white notsowidearea\" type=\"text\" value=\"$desc\"> 
							<input name=\"pos$cod\" class=\"white notsowidearea\" value=\"$pos\" type=\"number\" onkeypress=\"return isNumberKey(event)\">";
							
					$desiredSelect=$act;
					
					$array = array( "s"=> "HABILITADO",
					               "n" => "NO HABILITADO");
							
							echo "<select name=\"act$cod\">";
							foreach ($array as $val => $text){
								echo "<option value=\"$val\" ";
							if( $val == $desiredSelect ) echo "selected = \"selected\"";
							echo ">$text</option>";
							}
							echo "</select>";
							echo "<br>";
				
					$i++;
				}
			}
	}
?>

<?php include 'footer.php'; ?>

<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantias > Evaluaciones > Factores de Evaluacion > Editar").html;
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