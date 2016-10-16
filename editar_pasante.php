<?php include 'header.php';
$cedu = $_GET['cedula'];
$datos_pasante = (datosPasante($cedu,'nombres','apellidos','sexo','fecha_nacimiento','nacionalidad','lugar_nacimiento','direccion',  'tipo_sangre'));
$birthDate=date("d-m-Y", strtotime($datos_pasante['fecha_nacimiento']));

$tlf1= getTelefonos($cedu);
$tlfs = explode('/', $tlf1);
$tlfs[0]=trim($tlfs[0]);
$tlfs[1]=trim($tlfs[1]);



 ?>
<div class="formss gradient" id="agregar_div">
	<form method="post">
		<div id="center">
			<div class="row">
				<div class="whitebg"> <h1>Datos del Pasante</h1> </div>

				<label>Nombres</label>
				<label>Apellidos</label>
				<input class="notsowidearea" type="text" name="nombres" value="<?php echo $datos_pasante['nombres'];?>" >
				<input class="notsowidearea" type="text" name="apellidos" value="<?php echo $datos_pasante['apellidos'];?>" ><br>

				<div class="fila" style="margin-left:35px;">
					<span id="cedula" style="margin-right:55px;">Cedula</span>
					<input class="notsowidearea cedulaarea" type="number" name="cedu" onkeypress="return isNumberKey(event)"value="<?php echo $cedu;?>" >
					<span>Fecha de nac</span>
					<input type="text" placeholder="dd/mm/yyyy" class="dates nac" name="dateN" autocomplete="off" value="<?php echo $birthDate; ?>" >	
					<span> Tipo de Sangre</span>
					
					<select class="blood" name="sangre" >
						
						<?php $desiredSelect = $datos_pasante['tipo_sangre'];
						
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
						
						<?php $desiredSelect = $datos_pasante['sexo'];
						
						$array = array("M" =>"M", "F" => "F");
						
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
				<input class="notsowidearea" type="text" name="nac" value="<?php echo $datos_pasante['nacionalidad']?>">
				<input class="notsowidearea" type="text" name="lnac" value="<?php echo $datos_pasante['lugar_nacimiento']?>"> 

				<label>Telefono 1</label>
				<label>Telefono 2 (opc)</label>
				<input class="notsowidearea" type="text" name="tlf1" value="<?php echo $tlfs[0]; ?>">
				<input class="notsowidearea" type="text" name="tlf2" value="<?php echo $tlfs[1]; ?>">
				<label>Direccion</label>
				<input class="widearea" style="width: 91%;" type="text" name="dir" value="<?php echo $datos_pasante['direccion']?>">
				
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
					$cedu = $_GET['cedula'];
					$cedu_n=$_POST['cedu']; //cedula
					
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
					if(empty($cedu_n)){
						$errors[]= 'Introduzca la cedula';
					}
					if( (buscarExistenciaPasante($cedu_n)==1) && ($cedu_n != $cedu) ){
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
						echo "sexo: ". $sexo;
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

						editarPasante($cedu,$cedu_n,$nombres,$apellidos,$sexo,$dateN,$nacionalidad,$lugar_nac,$dir,$sangre);
						if( (isset($_POST['tlf1'])) && (empty($_POST['tlf2'])) ){
							borrarTelefonos($cedu_n);
							agregarTelefono($cedu_n, $tlf1);
							
						}
						else if( (empty($_POST['tlf1'])) && (isset($_POST['tlf2'])) ){
							borrarTelefonos($cedu_n);
							agregarTelefono($cedu_n, $tlf2);
						}
						
						else if( (isset($_POST['tlf1'])) && (isset($_POST['tlf2'])) ){
							
							
							if( (!empty($tlf1)) && (!empty($tlf2)) ) {
								
								borrarTelefonos($cedu_n);
							
								agregarTelefono($cedu_n, $tlf1);
								agregarTelefono($cedu_n, $tlf2);
							}
						}
						header('Location: perfil_pasante.php?cedula='.$cedu_n);
						exit();
					}
					
					}
		}			
?>
	

<?php include 'footer.php'; ?>

<script>
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantias > Pasantes > Ficha de Pasante > Editar Pasante").html;
			
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


			