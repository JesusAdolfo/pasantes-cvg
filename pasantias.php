<?php include 'header3.php'; 
$cedu = $_GET['cedula'];
$cod = $_GET['cod'];
$datos_pasantia=(datosPasantia($cedu,$cod,'fecha_inicio','fecha_fin','tutor_industrial','tutor_academico','institucion_educativa','especialidad','area_desempeno','ubicacion_fisica','descripcion_pasantia','nivel_pasante'));
?>

<div id="ficha" class="gradient">

	<div style="visibility:hidden;">
	a
	</div>
	<div class="whitebg" style="width:700px; margin: 0 auto; margin-bottom:20px;"> 
		<h1> Ficha de Pasantía</h1>
	</div>
	<div class="ficha_row">
		<span><strong>
		Fecha Inicio:</strong> 
		<?php echo date("d-m-Y", strtotime($datos_pasantia['fecha_inicio']));?>
		</span>
		<span><strong>Fecha Fin:</strong> <?php echo date("d-m-Y", strtotime($datos_pasantia['fecha_fin'])); ?></span>
		<?php 
		$start = $datos_pasantia['fecha_inicio'];
		$end = $datos_pasantia['fecha_fin'];

		$weeks = abs(strtotime($start) - strtotime($end)) / 604800 ;
		$weeks = ceil($weeks+0.001);
		?>
		<span><strong>Semanas:</strong> <?php echo $weeks; ?></span>
	</div>
	<div class="ficha_row">
		<span><strong>Tutor Industrial: </strong> <?php get_nombre_tutor($datos_pasantia['tutor_industrial']);?></span>
		<span><strong>Tutor Acad&eacute;mico:</strong> <?php echo $datos_pasantia['tutor_academico'];?></span>
	</div>
	<div class="ficha_row">

		<span><strong>Instituci&oacute;n Educativa: </strong> <?php echo get_nombre_institucion($datos_pasantia['institucion_educativa']);?></span>		
	</div>
	<div class="ficha_row">
		<span><strong>Nivel:</strong> <?php echo get_nombre_nivel($datos_pasantia['nivel_pasante']);?></span>
		<span><strong>Especialidad:</strong> <?php echo get_nombre_especialidad($datos_pasantia['especialidad']);?></span>	
	</div>
	<div class="ficha_row">
		<span><strong>&Aacute;rea de Desempe&ntilde;o:</strong> <?php echo get_nombre_area($datos_pasantia['area_desempeno']);?></span>
	</div>
	<div class="ficha_row">
		<span><strong>Ubicacion F&iacute;sica: </strong> <?php echo $datos_pasantia['ubicacion_fisica'];?></span>
	</div>
	<div class="ficha_row">
		<span><strong>Descripci&oacute;n: </strong> <?php echo $datos_pasantia['descripcion_pasantia'];?></span>
	</div>
	
	<?php buscarEvaluacion($cod); ?>
	
	<div class="ficha_row">
		<?php if($_SESSION['tipo']==2){ ?>
			<a href="editar_pasantia.php?cedula=<?php echo $cedu; ?>&cod=<?php echo $cod; ?>">
				<input type="submit" class="white button" value="Modificar Pasant&iacute;a">
			</a>
		<?php } ?>
		
		<a href="evaluar_pasantia.php?cedula=<?php echo $cedu; ?>&cod=<?php echo $cod; ?>">
			<input type="submit" class="white button" value="Evaluar Pasant&iacute;a">
		</a>
		
		<?php if($_SESSION['tipo']==2){ ?>
			<a  <?php echo 'onClick=ConfirmacionEP(',$cedu,",",$cod,')';?>>
				<input type="submit" class="white button" value="Eliminar Pasant&iacute;a">
			</a>
		<?php } ?>
	</div>
</div>


<?php if($_SESSION['tipo']==2){ 
    include 'footer.php'; 
 }else{
	include 'footer2.php'; 
 } ?>

<script>
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Pasantías ").html;
    });

</script>
<script src="js/script.js"></script>

