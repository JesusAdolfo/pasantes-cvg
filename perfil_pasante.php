<?php include 'header.php';
$cedu = $_GET['cedula'];
$datos_pasante = (datosPasante($cedu,'nombres','apellidos','sexo','fecha_nacimiento','nacionalidad','lugar_nacimiento','direccion',  'tipo_sangre'));
		$birthDate = $datos_pasante['fecha_nacimiento'];
		$birthDate=date("d-m-Y", strtotime($birthDate));
         //explode the date to get month, day and year
         $birthDate = explode("-", $birthDate);
         //get age from date or birthdate
         $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])):(date("Y")-$birthDate[2]));
?>

<div id="ficha" class="gradient">
	<div style="visibility:hidden;">
	a
	</div>
	<div class="whitebg" style="width:700px; margin: 0 auto; margin-bottom:20px;"> 
		<h1> Ficha de Pasante</h1>
	</div>
	<div class="ficha_row">
		<span> <strong> Nombre Completo:</strong> <?php echo $datos_pasante['nombres']; ?> <?php echo $datos_pasante['apellidos']; ?> </span> 	
		
	</div>
	<div class="ficha_row">
	<span><strong>C&eacute;dula de Identidad:</strong> <?php echo $cedu; ?></span>
	<span><strong>Edad:</strong> <?php echo $age;?> </span>
	<span><strong>Sexo:</strong> <?php echo $datos_pasante['sexo']; ?> </span>
	<span><strong>Sangre Tipo:</strong> <?php echo $datos_pasante['tipo_sangre']; ?> </span>
	</div>
	<div class="ficha_row">
		<span><strong>Nacionalidad:</strong> <?php echo $datos_pasante['nacionalidad']; ?></span>
		<span><strong>Lugar Nacimiento:</strong> <?php echo $datos_pasante['lugar_nacimiento']; ?></span>
	</div>
	<div class="ficha_row">
		<strong>Fecha Nacimiento:</strong> <?php echo date("d-m-Y", strtotime($datos_pasante['fecha_nacimiento'])); ?> 
	</div>
	<div class="ficha_row">
		<strong>Tel&eacute;fonos:</strong> <?php echo getTelefonos($_GET['cedula']); ?> 
	</div>
	<div class="ficha_row">
		<strong>Direcci&oacute;n:</strong> <?php echo $datos_pasante['direccion']; ?>
	</div>
	
	<div class="ficha_row">
		<a href="editar_pasante.php?cedula=<?php echo $cedu; ?>"><input type="submit" class="white button" value="Modificar Datos" ></a>
		
		<a href="nueva_pasantia.php?cedula=<?php echo $cedu; ?>"><input type="submit" class="white button" value="Nueva Pasant&iacute;a"> </a>
		
		<a <?php if(!tienePasantia($_GET['cedula'])){
				echo 'onClick=ConfirmacionDP(',$cedu,')'; }
				?>>
			<input type="submit" value="Eliminar Pasante" 
			
			<?php 
				if(tienePasantia($_GET['cedula'])){
					echo 'class=" white button tiene_pasantia"';
				}else{
					echo 'class=" white button"';
				}			
			?>
		>
		</a>
		
	</div>
	
	<?php getPasantias($cedu);?>

</div>



<script>
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Pasantes > Ficha de Pasante").html;
	  
	  $('.tiene_pasantia').click(function(){ 
		$('.tiene_pasantia').attr("disabled","disabled");
		$('.tiene_pasantia').delay(3000).attr("disabled",false);;
	 });
    });
</script>


<script src="js/tooltip.js"></script>
<script src="js/script.js"></script>

<?php include 'footer.php'; ?>


