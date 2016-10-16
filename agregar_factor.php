<?php include 'header.php'; ?>
<br><br>
<div id="x-wrapper">
<div class="formss gradient" id="agregar_factor_div" autocomplete="off">
	<form method="post">
			<div class="row">
				<div class="whitebg"> <h2> Nuevo  Factor de Evaluaci&oacute;n</h2> </div>
			</div>
			<div class="row">
					<label>Descripci&oacute;n</label>
					<input id="nombre" class="white widearea" type="text" name="nombre" <?php if(isset($_POST['nombre']) === true) {echo 'value="', strip_tags($_POST['nombre']),'"';}?> placeholder="ingrese descripcion del factor" autocomplete="off"> 
				<div id="avaliability">   </div>
			</div>
			<div class="row">
				Posici&oacute;n:<input id="posicion" class="white notsowidearea" type="text" name="dir"  <?php if(isset($_POST['dir']) === true) {echo 'value="', strip_tags($_POST['dir']),'"';}?>placeholder="" autocomplete="off" maxlength="3"  pattern="([0-9]|[0-9]|[0-9])" onkeypress="return isNumberKey(event)">
				
				Estado:<select name="act">
					<option value="s"> HABILITAR</option>
					<option value="n"> NO HABILITAR </option>
				</select>
			</div>
			
<?php	
	if(isset($_POST['submit'])) {
	
		$factor = $_POST['nombre'];
		$factor = strtoupper($factor);
		$pos = $_POST['dir'];
		$act = $_POST['act'];
		
		$errors = array();
	
		if (empty($factor) || empty ($pos) || empty ($act)) {
			$errors[]= '<span>Debe llenar todos los campos</span>';
		}
		
		
		if (!empty($errors)) {
				echo '<div class="row"><div id="advertencias"><ul>';
			foreach ($errors as $error){
				echo '<li>', $error, '</li>';
			}
				echo "</ul></div></div>";
		}else{		
			nuevo_factor($factor,$pos,$act);
			header('Location: factores.php');
		exit();
		}
	}
?>

<div id="button_div">
	<input class="white button" type="submit" name="submit" value="Guardar Factor"/>
</div>

</form>
</div>
</div>


<?php include 'footer.php'; ?>

<script type="text/javascript">
	 $(document).ready(function() {
	 
      $('#titulo1').text("Sistema de Control de Pasantías > Evaluaciones > Nuevo Factor de Evaluación").html;
	  
	  $("#posicion").keyup(function() {
		$("#posicion").val(this.value.match(/[0-9]*/));
	});
	
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


