<?php include 'header.php'; ?>

<div id="relaciones_div">
<form method="post">
<label>Año</label>
<select name="anio" class="select_fecha">
	<option>2008</option>
	<option>2009</option>
	<option>2010</option>
	<option>2011</option>
	<option>2012</option>
	<option>2013</option>
	<option>2014</option>
	<option>2015</option>
	<option>2016</option>
	<option>2017</option>
</select>
<label>Mes</label>
<select name="mes" class="select_fecha">
	<option value="1">Enero</option>
	<option value="2">Febrero</option>
	<option value="3">Marzo</option>
	<option value="4">Abril</option>
	<option value="5">Mayo</option>
	<option value="6">Junio</option>
	<option value="7">Julio</option>
	<option value="8">Agosto</option>
	<option value="9">Septiembre</option>
	<option value="10">Octubre</option>
	<option value="11">Noviembre</option>
	<option value="12">Diciembre</option>
</select>
<input type="submit" name="submit" class="white button" value="Ver Relaci&oacute;n">

</br>

<?php procesar(); ?>



</form>
</div>


<table class="tablas"  id="niveles" border="1" style="display:table; width:250px; border:none;">
	<tr>
		<th>Nivel de estudio</th>
		<th>Costo</th>
	</tr>
    <?php getNivelesEstudio(); ?>
	<tfoot>
		<tr>
			<td colspan="0" >
				<a class="whiteLetters" href="remuneraciones.php">Cambiar Montos de Remuneraci&oacute;n
				</a>
			</td>
		</tr>
	</tfoot>
</table>


<?php 
function procesar(){
	
	if(isset($_POST['submit'])){
		$mes= $_POST['mes'];
		$anio= $_POST['anio'];
			
		crearRelacionPago($mes,$anio);
		
	}

}
?>

<?php include 'footer.php'; ?>

<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Pagos > Relaciones de Pago").html;
    });
</script>