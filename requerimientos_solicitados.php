<?php include 'header.php'; ?>
<br><br>
<div class="gradient" id="indicadores_div">
<br>
<form method="post">

<span>La fórmula de "Requerimientos X Solicitados" es la siguiente:</span>
<span>	
	<table class="fraction" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td rowspan="2" nowrap="nowrap">
				<i>Requerimientos X Solicitados</i> =
			</td><td nowrap="nowrap">
				<i>Nro de Pasantes Solicitados en la D.N <i>
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
<span>
	Ingrese el número de pasantes solicitados en la D.N para el a&ntilde;o escogido <br>
	<input type="number" onkeypress="return isNumberKey(event)" class="autosuggest" name="detencion" placeholder="Nro de Pasantes Solicitados en la D.N ">
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
		$num_pasantes= $_POST['detencion'];
		
		$link = new Conexion_postgre();

		$result = pg_query("SELECT COUNT(*)
							FROM pasantias
							WHERE (extract (year FROM fecha_inicio)=$anio OR extract (year FROM fecha_fin)=$anio)");
							
		$total = pg_fetch_object($result,0);
		$total_ingresados = $total -> count;
		
		if($total_ingresados == 0){
			echo "<span>No hay pasantes ingresados para este a&ntilde;o </span>";
		}else{
	
						   
	
				?>
				
				<span>
					<table class="fraction" align="center" cellpadding="0" cellspacing="0" >
					<tr>
						<td rowspan="2" nowrap="nowrap">
							<i>Requerimientos X Solicitados=&#160;</i>  
						</td>
						<td nowrap="nowrap">
							<i><?php echo $num_pasantes;?></i>
						</td>
						<td rowspan="2" nowrap="nowrap">
							<i>&#160;= <?php echo sprintf("%.5f",$num_pasantes/$total_ingresados); ?></i>  
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
	
?>		
<?php include 'footer.php'; ?>

<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Indicadores > Requerimientos X Niveles").html;
    });
</script>