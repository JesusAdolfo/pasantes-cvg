<?php include 'header.php'; ?>
<div class="formss gradient" id="agregar_instituto_div" autocomplete="off">
	<form method="post">
			<div class="row">
				<div class="whitebg"> <h1> Nueva Especialidad </h1> </div>
			</div>
			<div class="row" style="margin-top:20px;">
					<label>Nombre de la Especialidad</label>
					<input id="nombre_espe" class="white widearea" type="text" name="nombre" <?php if(isset($_POST['nombre']) === true) {echo 'value="', strip_tags($_POST['nombre']),'"';}?> placeholder="ingrese el nombre de la especialidad" autocomplete="off"> 
				<div id="avaliability">   </div>
			</div>
			

<?php	
	if(isset($_POST['submit'])) {
	
		$nombre = $_POST['nombre'];
		$nombre = strtoupper($nombre);
		
		$errors = array();
	
		if (empty($nombre)) {
			$errors[]= '<span>Debe llenar todos los campos</span>';
		}if (buscarExistenciaEspe($nombre)===1){
			$errors[] = '<span>Esa especialidad ya existe</span>';
		}if(muyCorto($nombre)){
			$errors[]= '<span> Ingrese al menos 4 caracteres  en todos los campos</span>';
		}
		
		if (!empty($errors)) {
				echo '<div class="row"><div id="advertencias"><ul>';
			foreach ($errors as $error){
				echo '<li>', $error, '</li>';
			}
				echo "</ul></div></div>";
		}else{		
		$nuevo = nueva_espe($nombre);	
		header('Location: especialidades.php');
		exit();
		}
	}
?>

<div id="button_div" style="margin-top:20px;">
	<input class="white button" type="submit" name="submit" value="Registrar Especialidad"/>
</div>

</form>
</div>

<?php include 'footer.php'; ?>

<script src="js/especialidadAvaliable.js"></script>


<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Agregar > Nueva Especialidad").html;
    });
</script>