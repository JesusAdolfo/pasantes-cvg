<?php include 'header.php'; ?>
<div class="formss gradient" id="agregar_div">
	<form method="post">
		<div id="center">
			<div class="row">
				<div class="whitebg"> <h1>Datos del Pasante</h1> </div>

				<label>Nombres</label>
				<label>Apellidos</label>
				<input class="notsowidearea" type="text" name="nombres" <?php if(isset($_POST['nombres']) === true) {echo 'value="', strip_tags($_POST['nombres']),'"';}?>>
				<input class="notsowidearea" type="text" name="apellidos" <?php if(isset($_POST['apellidos']) === true) {echo 'value="', strip_tags($_POST['apellidos']),'"';}?>><br>

				<div class="fila" style="margin-left:35px;">
					<span id="cedula" style="margin-right:55px;">C&eacute;dula</span>
					<input class="notsowidearea cedulaarea" type="number" name="cedu" onkeypress="return isNumberKey(event)"<?php if(isset($_POST['cedu']) === true) {echo 'value="', strip_tags($_POST['cedu']),'"';}?>  >
					<span>Fecha de nac</span>
					<input type="text" placeholder="dd/mm/yyyy" class="dates nac" name="dateN" autocomplete="off" <?php if(isset($_POST['dateN']) === true) {echo 'value="', strip_tags($_POST['dateN']),'"';}?>/>	
					<span> Tipo de Sangre</span>
					<select class="blood" name="sangre" >
						
						<?php $desiredSelect = $_POST['sangre'];
						
						$array = array("O+" => "O+",
										"O-" => "O-",
										"A+"=> "A+",
										"A-" =>"A-",
										"B+" =>"B+",
										"B-" =>"B-",
										"AB+" =>"AB+",
										"AB-"=>"AB-");
						
						foreach( $array as $val => $text )
						{
							echo "<option value=\"$val\" ";
							if( $text == $desiredSelect ) echo "selected = \"selected\"";
							echo ">$text</option>";
						} ?>
						
					</select>
					<span> Sexo </span>
					<select class="blood" name="sexo">
						
						<?php $desiredSelect = $_POST['sexo'];
						
						$array = array("M" => "M",
										"F"=>"F");
						
						foreach( $array as $val => $text )
						{
							echo "<option value=\"$val\" ";
							if( $text == $desiredSelect ) echo "selected = \"selected\"";
							echo ">$text</option>";
						} ?>
						
					</select>
				</div>

				<label>Nacionalidad</label>
				<label>Lugar Nacimiento</label>
				<input class="notsowidearea" type="text" name="nac" <?php if(isset($_POST['nac']) === true) {echo 'value="', strip_tags($_POST['nac']),'"';}?>>
				<input class="notsowidearea" type="text" name="lnac" <?php if(isset($_POST['lnac']) === true) {echo 'value="', strip_tags($_POST['lnac']),'"';}?>> 

				<label>Tel&eacute;fono 1</label>
				<label>Tel&eacute;fono 2 (opc)</label>
				<input class="notsowidearea" type="text" name="tlf1" <?php if(isset($_POST['tlf1']) === true) {echo 'value="', strip_tags($_POST['tlf1']),'"';}?>>
				<input class="notsowidearea" type="text" name="tlf2" <?php if(isset($_POST['tlf2']) === true) {echo 'value="', strip_tags($_POST['tlf2']),'"';}?>>
				<label>Direcci&oacute;n</label>
				<input class="widearea" style="width: 91%;" type="text" name="dir" <?php if(isset($_POST['dir']) === true) {echo 'value="', strip_tags($_POST['dir']),'"';}?>>
				
				<div class="fila">
					<input class="white button" type="submit" name="submit" value="Guardar" />
				</div>
				
				
				<?php procesar(); 	?>
				
			</div>
		</div>
	</form>
</div>

<?php 
	function procesar(){
				if(isset($_POST['submit'])){
					$nombres=$_POST['nombres']; //nombres
					$apellidos=$_POST['apellidos']; //apellidos
					$nombres = strtoupper($nombres);
					$apellidos = strtoupper($apellidos);
					$cedu=$_POST['cedu']; //cedula
					
					
					$sangre=$_POST['sangre'];
					$sexo=$_POST['sexo'];
					$nacionalidad=$_POST['nac'];
					$lugar_nac=$_POST['lnac'];
					$tlf1=$_POST['tlf1'];
					$tlf2=$_POST['tlf2'];
					$dir=$_POST['dir'];
					
					$errors = array();
					
					if(empty($nombres)){
						$errors[]= 'Introduzca un nombre';
					}
				    if(empty($apellidos)){
						$errors[]= 'Introduzca un apellido';
					}
					if(empty($cedu)){
						$errors[]= 'Introduzca la cedula';
					}
					if( (buscarExistenciaPasante($cedu_n)==1)){
						$errors[]='La cedula ingresada ya existe';
					}
					if(empty($_POST['dateN'])){
						$errors[]= 'Introduzca la fecha nacimiento';
					}else{
						$dateN=$_POST['dateN']; //fecha nac
						$dateN=date("Y-m-d", strtotime($dateN));
					}
					
					if(empty($sangre)){
						$errors[]= 'Debe elegir un tipo sangre';
					}
					if (empty($sexo)){
						$errors[]= 'Debe eligir el sexo';
					}
					if (empty($nacionalidad)) {
						$errors[]= 'Introduzca la nacionalidad';
					}
					if (empty($lugar_nac)){
						$errors[]= 'Introduzca el lugar nacimiento';
					} 
					if(empty($dir)){
						$errors[]= 'Introduzca una direccion';
					}
					if(empty($tlf1) && empty($tlf2)){
						$errors[]= 'Debe agregar al menos un numero de telefono';
					}
					
					
					
					if(!empty($errors)){
						echo '<div class="row"><div id="advertencias"><ul>';
						foreach ($errors as $error){
							echo '<li><span>', $error, '</span></li>';
						}
						echo "</ul></div></div>";
					}else{		
						nuevoPasante($nombres,$apellidos,$cedu,$dateN,$sangre,$sexo,$nacionalidad,$lugar_nac,$dir);
						if( (isset($_POST['tlf1'])) && (empty($_POST['tlf2'])) ){
							borrarTelefonos($cedu);
							agregarTelefono($cedu, $tlf1);
							
						}
						else if( (empty($_POST['tlf1'])) && (isset($_POST['tlf2'])) ){
							borrarTelefonos($cedu);
							agregarTelefono($cedu, $tlf2);
						}
						
						else if( (isset($_POST['tlf1'])) && (isset($_POST['tlf2'])) ){
							
							
							if( (!empty($tlf1)) && (!empty($tlf2)) ) {
								
								borrarTelefonos($cedu);
							
								agregarTelefono($cedu, $tlf1);
								agregarTelefono($cedu, $tlf2);
							}
						}
						header('Location: perfil_pasante.php?cedula='.$cedu);
						exit();
					}
					
					}
		}			
?>
	

<?php include 'footer.php'; ?>

<script>
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Pasantes > Nuevo Pasante").html;
			
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

<script>
		

		$('.nac').datepicker({ dateFormat: 'dd-mm-yy',
								 yearRange: '-90:+0',
								 changeMonth: true,
								 changeYear: true,
								 defaultDate: '-20y'});



	</script>


			