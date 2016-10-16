<?php include 'header.php'; 
$cod_institucion = $_GET['cod_institucion'];
$datos_institucion = (datosInstitucion($cod_institucion,'nombre_institucion','direccion','tlf','persona_contacto'));
?>
<div class="formss gradient" id="agregar_instituto_div" autocomplete="off">
	<form method="post">
			<div class="row">
				<div class="whitebg"> <h1> Editar Instituci&oacute;n </h1> </div>
			</div>
			<div class="row">
					<label>Nombre</label>
					<input id="nombre_insti" class="white widearea" type="text" name="nombre"  value="<?php echo $datos_institucion['nombre_institucion']?>" placeholder="ingrese el nombre de la instituci&oacute;n" autocomplete="off"> 
				<div id="avaliability">   </div>
			</div>
			<div class="row">
				<label>Direcci&oacute;n</label>
				<input class="white widearea" type="text" name="dir"  value="<?php echo $datos_institucion['direccion']?>" placeholder="ingrese la direcci&oacute;n de la instituci&oacute;n" autocomplete="off">
			</div>
			<div class="row">
				<label>Tel&eacute;fono</Label>
				<input class="white widearea" type="text" name="tlf" value="<?php echo $datos_institucion['tlf']?>" placeholder="ingrese tel&eacute;fono de contacto de la instituci&oacute;n" autocomplete="off">
			</div>
			<div class="row">
				<label>Persona de Contacto</label>
					<input class="white widearea" type="text" name="persona_contacto" value="<?php echo $datos_institucion['persona_contacto']?>" placeholder="ingrese nombre de la persona de contacto" autocomplete="off">
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
		}if (buscarExistenciaInstituto($nombre)===1 && $nombre!=$datos_institucion['nombre_institucion']){
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
		editar_institucion($cod_institucion,$nombre,$dir,$tlf,$persona_contacto);	
		header('Location: instituciones.php');
		exit();
		}
	}
?>

<div id="button_div">
	<input class="white button" type="submit" name="submit" value="Guardar"/>
</div>

</form>
</div>

<?php include 'footer.php'; ?>

<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Consultas > Instituciones > Editar").html;
    });
</script>