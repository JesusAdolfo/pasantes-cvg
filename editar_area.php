<?php include 'header.php'; 
$cod_area = $_GET['cod_area'];
$datos_area = (datosArea($cod_area,'nombre_area'));?>
<div class="formss gradient" id="agregar_instituto_div" autocomplete="off">
	<form method="post">
			<div class="row">
				<div class="whitebg"> <h1> Editar &Aacute;rea </h1> </div>
			</div>
			<div class="row" style="margin-top:20px;">
					<label>Nombre de &Aacute;rea</label>
					<input id="nombre_area" class="white widearea" type="text" name="nombre" value="<?php echo $datos_area['nombre_area']?>" placeholder="ingrese el nombre del &aacute;rea" autocomplete="off"> 
				<div id="avaliability">   </div>
			</div>
			

<?php	
	if(isset($_POST['submit'])) {
	
		$nombre = $_POST['nombre'];
		$nombre = strtoupper($nombre);
		
		$errors = array();
	
		if (empty($nombre)) {
			$errors[]= '<span>Debe llenar todos los campos</span>';
		}if (buscarExistenciaInstituto($nombre)===1){
			$errors[] = '<span>El area ya existe</span>';
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
		editar_area($cod_area,$nombre);	
		header('Location: areas.php');
		exit();
		}
	}
?>

<div id="button_div" style="margin-top:20px;">
	<input class="white button" type="submit" name="submit" value="Guardar"/>
</div>

</form>
</div>

<?php include 'footer.php'; ?>

<script src="js/areaAvaliable.js"></script>


<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Consultas > Áreas > Editar").html;
    });
</script>