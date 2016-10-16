<?php include 'header.php'; ?>
<div class="formss gradient" id="agregar_instituto_div" autocomplete="off">
	<form method="post">
			<div class="row">
				<div class="whitebg"> <h1> Nueva Instituci&oacute;n </h1> </div>
			</div>
			<div class="row">
					<label>Nombre</label>
					<input id="nombre_insti" class="white widearea" type="text" name="nombre" <?php if(isset($_POST['nombre']) === true) {echo 'value="', strip_tags($_POST['nombre']),'"';}?> placeholder="ingrese el nombre de la instituci&oacute;n" autocomplete="off"> 
				<div id="avaliability">   </div>
			</div>
			<div class="row">
				<label>Direcci&oacute;n</label>
				<input class="white widearea" type="text" name="dir"  <?php if(isset($_POST['dir']) === true) {echo 'value="', strip_tags($_POST['dir']),'"';}?>placeholder="ingrese la direcci&oacute;n de la institucion" autocomplete="off">
			</div>
			<div class="row">
				<label>Tel&eacute;fono</Label>
				<input class="white widearea" type="text" name="tlf" <?php if(isset($_POST['tlf']) === true) {echo 'value="', strip_tags($_POST['tlf']),'"';}?> placeholder="ingrese tel&eacute;fono de contacto de la instituci&oacute;n" autocomplete="off">
			</div>
			<div class="row">
				<label>Persona de Contacto</label>
					<input class="white widearea" type="text" name="persona_contacto" <?php if(isset($_POST['persona_contacto']) === true) {echo 'value="', strip_tags($_POST['persona_contacto']),'"';}?> placeholder="ingrese nombre de la persona de contacto " autocomplete="off">
			</div>
			


<?php	
	if(isset($_POST['submit'])) {
	
		$nombre = $_POST['nombre'];
		$nombre = strtoupper($nombre);
		$dir = $_POST['dir'];
		$tlf = $_POST['tlf'];
		$persona_contacto = $_POST['persona_contacto'];
		
		$errors = array();
	
		if (empty($nombre) || empty ($dir) || empty ($tlf) || empty ($persona_contacto)) {
			$errors[]= '<span>Debe llenar todos los campos</span>';
		}if (buscarExistenciaInstituto($nombre)===1){
			$errors[] = '<span>El instituto ya existe</span>';
		}if(muyCorto($nombre) || muyCorto($dir) || muyCorto($tlf) || muyCorto($persona_contacto)){
			$errors[]= '<span> Ingrese al menos 4 caracteres  en todos los campos</span>';
		}
		
		if (!empty($errors)) {
				echo '<div class="row"><div id="advertencias"><ul>';
			foreach ($errors as $error){
				echo '<li>', $error, '</li>';
			}
				echo "</ul></div></div>";
		}else{		
		$nuevo = nuevo_instituto($nombre,$dir,$tlf,$persona_contacto);	
			header('Location: instituciones.php');
		exit();
		}
	}
?>

<div id="button_div">
	<input class="white button" type="submit" name="submit" value="Guardar Instituci&oacute;n"/>
</div>

</form>
</div>

<?php include 'footer.php'; ?>
<script src="js/avaliable.js"></script>

<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Agregar > Nueva Institución").html;
    });
</script>