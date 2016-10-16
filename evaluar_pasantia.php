<?php include 'header3.php';
$cedu = $_GET['cedula'];
$cod = $_GET['cod'];
$datos_pasante = (datosPasante($cedu,'nombres','apellidos','sexo','fecha_nacimiento','nacionalidad','lugar_nacimiento','direccion',  'tipo_sangre'));
$datos_pasantia=(datosPasantia($cedu,$cod,'fecha_inicio','fecha_fin','tutor_industrial','tutor_academico','institucion_educativa','especialidad','area_desempeno','ubicacion_fisica','descripcion_pasantia','nivel_pasante'));
 ?>
<form method="post">
 <table id="tab_ev" class="tablas" width=90% >
	<thead>
	<tr>
		<th width="25%">Factores de Evaluaci&oacute;n</th>
		<th>Deficiente</th>
		<th>Regular</th>
		<th>Bueno</th>
		<th>Muy Bueno</th>
		<th>Excelente</th>
		<th  width="90%">Observaci&oacute;n</th>
	</tr>
	</thead>
	
	<tfoot>
		<tr>
		<td colspan="0">Evaluaci&oacute;n del pasante <?php echo $datos_pasante['nombres']." ".$datos_pasante['apellidos'] ?> para pasantía del <?php echo date("d-m-Y", strtotime($datos_pasantia['fecha_inicio']))." al ".date("d-m-Y", strtotime($datos_pasantia['fecha_fin']));
		echo "<br>";
		echo $datos_pasantia['descripcion_pasantia']?> </td>
		</tr>
	</tfoot>
	
	<tbody>
		<?php getFactores($cod); ?>
	</tbody>
	
	
 </table>


<?php procesar(); ?>
 
<div id="resultado_div">
	<span>TOTAL PUNTAJE DE LA EVALUACI&Oacute;N: </span>
	<span id="weeh">BUENO</span>
	<input class="white button" type="submit" name="submit" value="Guardar Evaluaci&oacute;n" style="margin-left:50px;">
</div>
</form>

<?php


function procesar(){
	
	if(isset($_POST['submit'])){
		
		$notas = array();
		$obs = array();
		$num_fac = contarFactores();
		$ids = get_factores_id();
		
		foreach($ids as $id){
			$cedu=$_GET['cedula'];
			$cod=$_GET['cod'];
			$punt= $_POST[$id];
			$obs= $_POST["ob".$id];
			$cod_factor=$id;
			
			borrarEvaluacion($cod,$cod_factor);
			agregarEvaluacion($punt,$obs,$cod_factor,$cod);
			
			
		}
			header('Location: pasantias.php?cedula='.$cedu.'&cod='.$cod);
			exit();

		
	}
} 
?> 

<?php if($_SESSION['tipo']==2){ 
    include 'footer.php'; 
 }else{
	include 'footer2.php'; 
 } ?>

<script>
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Evaluar Pasantía").html;
	  
	$('input[type=radio]').change(function () {
		var total = 0;
		var count=0;
		$("input[type=radio]:checked").each(function () {
			var x = parseInt($(this).val());
			total += x;
			count +=1;
		});
		var decision=total/count;
		var output;
		if(decision<=1){
			output="DEFICIENTE";
		}else if(decision<=2){
			output="REGULAR";
		}else if(decision<=3){
			output="BUENO";
		} else if(decision<=4){
			output="MUY BUENO";
		} else if(decision<=5){
			output="EXCELENTE";
		}
		
		$('#weeh').text(output);
		
	});
});

</script>