<?php include 'header.php'; ?>
<br><br>
<div class="gradient" id="indicadores_div">
<br>
<form method="post">

<span>La fórmula de cuantificación de costos es la siguiente:</span>
<span>	
	<table class="fraction" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td rowspan="2" nowrap="nowrap">
				<i>Cuantificación de Costos</i> =  
			</td><td nowrap="nowrap">
				<i>Costo Ejecutado</i>
			</td>
		</tr><tr>
			<td class="upper_line">
				<i>Costo Programado</i>
			</td>
		</tr>
	</table>
</span>

<br> 

<span>
<label> Ingrese el a&ntilde;o para calcular el costo ejecutado</label>
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
	Ingrese el monto del costo programado en Bs. del a&ntilde;o escogido <br>
	<input type="number" onkeypress="return isNumberKey(event)" class="autosuggest" name="costo_programado" placeholder="monto programado para el a&ntilde;o escogido">
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
		$costoProgramado=$_POST['costo_programado'];
		if ($costoProgramado==0){
			$costoProgramado=1;
		}
		$costoEjecutado=costoEjecutado($anio);
		
		$cuantificacion= sprintf("%.5f",$costoEjecutado/$costoProgramado);
	
?>		
		<span>
		<table class="fraction" align="center" cellpadding="0" cellspacing="0" >
		<tr>
			<td rowspan="2" nowrap="nowrap">
				<i>Cuantificación de Costos</i> =  
			</td>
			<td nowrap="nowrap">
				<i><?php echo $costoEjecutado."Bs";?></i>
			</td>
		</tr>
		<tr>
			<td class="upper_line">
				<i><?php echo $costoProgramado."Bs";?></i>
			</td>
		</tr>
		</table>
		</span>
		
		<span>
		<table class="fraction" align="center" cellpadding="0" cellspacing="0" >
		<tr>
			<td rowspan="2" nowrap="nowrap">
				<i>Cuantificacion de Costos</i> =  
			</td>
		</tr>
		<tr>
			<td rowspan="2" nowrap="nowrap">
				<i><?php echo $cuantificacion; ?></i>  
			</td>
		</tr>
		</table>
		</span>
	
<?php
	}
}
?>

<?php include 'footer.php'; ?>

<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Indicadores > Cuantificación de Costos").html;
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