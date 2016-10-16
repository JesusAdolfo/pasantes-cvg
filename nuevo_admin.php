<?php include 'header.php'; ?>
<div class="formss gradient" id="agregar_instituto_div" autocomplete="off">
	<form method="post">
			<div class="row">
				<div class="whitebg"> <h1> Nuevo Administrador </h1> </div>
			</div>
			<div class="row" style="margin-top:20px;">
					<label>Cedula </label>
					<input id="nombre_area" class="white widearea  suge" type="text" name="nombre" <?php if(isset($_POST['nombre']) === true) {echo 'value="', strip_tags($_POST['nombre']),'"';}?> placeholder="numero de cedula del nuevo administrador" onkeypress="return isNumberKey(event)" autocomplete="off"> 
					<div class="dropdown" style="position:absolute;">
						<ul class="result"> 
							
						</ul>
					</div>
			</div>
			

<?php	
	if(isset($_POST['submit'])) {
	
		$cedula2 = $_POST['nombre'];
		$cedula2 = explode(" ",$cedula2);
		
		$cedula = $cedula2[0];
		
		$errors = array();
	
		if (empty($cedula)) {
			$errors[]= '<span>Introduzca cedula del administrador</span>';
		}
		if (buscarExistenciaAdmin($cedula)){
			$errors[] = '<span>Ese administrador ya existe</span>';
		}
		if(!buscarExistenciaIntranet($cedula)){
			$errors[]= '<span> No se encontro la cedula en la intranet</span>';
		}
		
		if (!empty($errors)) {
				echo '<div class="row"><div id="advertencias"><ul>';
			foreach ($errors as $error){
				echo '<li>', $error, '</li>';
			}
				echo "</ul></div></div>";
		}else{		
		nuevo_admin($cedula);	
		
		echo "<script language='javascript'>";
		echo "alert('Nuevo Administrador Creado! Acceda nuevamente al sistema')";
		echo "</script>";
				
		header('refresh:1;url=logout.php');
	
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


<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantias > Cuentas > Nuevo Administrador").html;
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
<script src="js/primaryTutorind.js"> </script>