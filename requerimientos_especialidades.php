<?php include 'header.php'; ?>
<br><br>
<div class="gradient" id="indicadores_div">
<br>
<form method="post">

<span>La fórmula de "Requerimientos X Especialidades" es la siguiente:</span>
<span>	
	<table class="fraction" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td rowspan="2" nowrap="nowrap">
				<i>Requerimientos X Especialidades</i> =  
			</td><td nowrap="nowrap">
				<i>Nro de Pasantes X Especialidades <i>
			</td>
		</tr><tr>
			<td class="upper_line">
				<i>Nro de Pasantes Incorporados</i>
			</td>
		</tr>
	</table>
</span>

<br> 

<span>
<label> Ingrese el a&ntilde;o para el cual desea calcular el indicador </label> <br><br>
<select name="anio" class="select_fecha">
	<option>2008</option>
	<option>2009</option>
	<option>2010</option>
	<option>2011</option>
	<option>2012</option>
	<option selected="selected">2013</option>
	<option>2014</option>
	<option>2015</option>
	<option>2016</option>
	<option>2017</option>
</select>
</span>

<br>
<span>
	<input type="submit" name="submit" class="white button" value="Crear Indicador">
</span>

</br>

<?php procesar(); ?>



</form>
</div>


<?php 
function procesar(){
	
	if(isset($_POST['submit'])){
		$anio= $_POST['anio'];
		
		$link = new Conexion_postgre();

		$result = pg_query("SELECT COUNT(*)
							FROM pasantias
							WHERE (extract (year FROM fecha_inicio)=$anio OR extract (year FROM fecha_fin)=$anio)");
							
		$total = pg_fetch_object($result,0);
		$total_ingresados = $total -> count;
		
		if($total_ingresados == 0){
			echo "<span>No hay pasantes ingresados para este a&ntilde;o </span>";
		}else{
		
		$query = pg_query("SELECT cod_especialidad
						   FROM especialidades");
						   
		$num = pg_num_rows($query);
		$i=0;
		
		if($num == 0){
			echo 'AGREGUE ESPECIALIDADES';
		}else{
			while ($i < $num) {
				$cod_espe = pg_fetch_result($query, $i, "cod_especialidad");
				
				$result2 = pg_query("SELECT COUNT(especialidad) 
									FROM pasantias
									WHERE (extract (year FROM fecha_inicio)=$anio OR extract (year FROM fecha_fin) = $anio)
									AND especialidad=$cod_espe");
				
				$total2 = pg_fetch_object($result2,0);					
				$num_pasantes = $total2 -> count;
	
				?>
				
				<span>
					<table class="fraction" align="center" cellpadding="0" cellspacing="0" >
					<tr>
						<td rowspan="2" nowrap="nowrap">
							<i>&#160;(<u><?php get_nombre_especialidad($cod_espe);?></u>)&#160;&#160;&#160;</i> 
						</td>
						<td nowrap="nowrap">
							<i><?php echo $num_pasantes;?></i>
						</td>
						<td rowspan="2" nowrap="nowrap">
							<i>= <?php echo sprintf("%.5f",$num_pasantes/$total_ingresados); ?></i>  
						</td>
					</tr>
					<tr>
						<td class="upper_line">
							<i><?php echo $total_ingresados;?> &#160; </i>
						</td>
					</tr>
					</table>
				</span>
				
				
				<?
				
				$i++;
			}
		}
	
	  }
	}
}
	
?>		


<?php include 'footer.php'; ?>

<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Indicadores > Requerimientos X Especialiades").html;
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