<?php include 'header.php';
$cedu = $_GET['cedula'];

?>

<div class="formss gradient" id="agregar_div">
	<form method="post">
		<div id="center">
			<div class="row">
				<a id="regresar" href="perfil_pasante.php?cedula=<?php echo $cedu; ?>">  Regresar </a>
				<div class="whitebg" style="margin-top:35px;"> <h1>Datos de la Pasant&iacute;a</h1></div>			
				<div class="fila">
						<span class="small">Duraci&oacute;n de la pasant&iacute;a</span>
						del<input type="text" placeholder="dd/mm/yyyy" class="dates" name="dates" id="dateS" <?php if(isset($_POST['dates']) === true) {echo 'value="', strip_tags($_POST['dates']),'"';}?> autocomplete="off" />	

						al
						<input type="text" placeholder="dd/mm/yyyy" class="dates" name="datef" id="dateF" <?php if(isset($_POST['datef']) === true) {echo 'value="', strip_tags($_POST['datef']),'"';}?> autocomplete="off"/>
						<span id="semanas"> </span>
				</div>

					<label>Tutor Industrial</label>
					<label>Tutor Acad&eacute;mico</label>
					<input id="tind" class="notsowidearea suge" type="number" name="tind" autocomplete="off" onkeypress="return isNumberKey(event)" <?php if(isset($_POST['tind']) === true) {echo 'value="', strip_tags($_POST['tind']),'"';}?>>
					<div class="dropdown" style="position:absolute;">
						<ul class="result"> 
							
						</ul>
					</div>
					<input class="notsowidearea" type="text" name="tacad" <?php if(isset($_POST['tacad']) === true) {echo 'value="', strip_tags($_POST['tacad']),'"';}?>>
					<label>Instituci&oacute;n Educativa</label>
					<label>Especialidad</label>
						<select name="inst">
							<?php listarInstituciones($_POST['inst']);?>
						</select >
						<select name="espe">
							<?php listarEspecialidades($_POST['espe']);?>
						</select>
					<label>Nivel de Estudios</label>
					<label>Trabajador?</label>
						<select name="niv">
							<?php getNombresNivelesEstudio($_POST['niv']);?>
						</select>
						<select name="trab">
							<option <?php if($_POST['trab']=="N"){
											echo 'selected=\"selected\"';
											}?> value="N">No</option>
							<option <?php if($_POST['trab']=="S"){
											echo "selected=\"selected\"";
											}?> value="S">Si</option>
						</select>
					<label>&Aacute;rea de desempe&ntilde;o</label>
					<label>Ubicaci&oacute;n F&iacute;sica</label>
						<select name="area">
							<?php listarAreas();?>
						</select>
						<select name="ubic">
							<?php getUbicaciones($_POST['ubic']);?>
						</select>
					<label> Descripci&oacute;n de la Pasant&iacute;a</label>
					<textarea name="desc"  rows="4" cols="90" maxlength="255"><?php if(isset($_POST['desc']) === true) {echo strip_tags($_POST['desc']);}?></textarea>
				
				<div class="fila">
					<input class="white button" type="submit" name="submit" value="Guardar" />
				</div>
				
				<?php procesar(); ?>
				
			</div>
		</div>
	</form>
</div>

<?php function procesar(){

	if(isset($_POST['submit'])){
		
		$tind = $_POST['tind'];
		$tind = explode(" ",$tind);
		$tacad = $_POST['tacad'];
		$inst = $_POST['inst'];
		$espe = $_POST['espe'];
		$niv = $_POST['niv'];
		$trab = $_POST['trab'];
		$area = $_POST['area'];
		$ubic = $_POST['ubic'];
		$desc = $_POST['desc'];
		$cedu2 = $_GET['cedula'];
		
		$errors = array();
		
		if(empty($_POST['dates'])){
			$errors[]= 'Introduzca la fecha de inicio de pasant&iacute;a';
		}else{
			$dateS=$_POST['dates']; //fecha nac
			$dateS=date("Y-m-d", strtotime($dateS));
		}
		if(empty($_POST['datef'])){
			$errors[]= 'Introduzca la fecha de fin de pasant&iacute;a';
		}else{
			$dateF=$_POST['datef']; //fecha nac
			$dateF=date("Y-m-d", strtotime($dateF));
		}
		if(empty($tind)){
			$errors[]= 'Introduzca CI del tutor industrial';
		}
		if(empty($tacad)){
			$errors[]= 'Introduzca nombre del tutor acad&eacute;mico';
		}
		if(empty($inst)){
			$errors[]= 'Introduzca una instituci&oacute;n v&aacute;lida';
		}
		if(empty($espe)){
			$errors[]= 'Introduzca especialidad v&aacute;lida';
		}
		if(empty($niv)){
			$errors[]= 'Introduzca nivel v&aacute;lido';
		}
		if(empty($trab)){
			$errors[]= 'Trabajador solo puede ser SI/NO';
		}
		if(empty($area)){
			$errors[]= 'Introduzca un &aacute;rea v&aacute;lida';
		}
		if(empty($ubic)){
			$errors[]= 'Introduzca una ubicaci&oacute;n v&aacute;lida';
		}
		if(empty($desc)){
			$errors[]= 'Debe agregar descripci&oacute;n de pasant&iacute;a';
		}
			
		if(!empty($errors)){
			echo '<div class="row"><div id="advertencias"><ul>';
		foreach ($errors as $error){
			echo '<li><span>', $error, '</span></li>';
		}
			echo "</ul></div></div>";
		}else{
			agregarPasantia($cedu2,$dateS,$dateF,$tind[0],$tacad,$inst,$espe,$area,$ubic,$desc,$niv,$trab);
			
			header('Location:perfil_pasante.php?cedula='.$cedu2);
			exit();
		}
	}

}	
?>

<?php include 'footer.php'; ?>

<script>
		

		$('#dateS').datepicker({
			dateFormat: 'dd-mm-yy', 
			yearRange: '-2:+2',
			changeMonth: true,
			changeYear: true,
			onSelect: function(selected) {
          		$("#dateF").datepicker("option","minDate", selected);
          		var dateObj = $(this).datepicker( 'getDate' );
		        var dateTo = $.datepicker.formatDate('mm/dd/yy', dateObj);
		        var weekto = $.datepicker.iso8601Week(new Date(dateTo));

		        var dateObj = $('#dateF').datepicker( 'getDate' );
		        var dateFrom = $.datepicker.formatDate('mm/dd/yy', dateObj);
		        var weekfrom = $.datepicker.iso8601Week(new Date(dateFrom));

		        // subtract last date from first date's week#
		       var weekz = weekfrom-weekto;

		       if (weekz > 1){
		        $('#semanas').empty().append(parseInt(weekz)+" semanas");        
			   }else if (weekz == 1){
			  	$('#semanas').empty().append(parseInt(weekz)+" semana");        
			   }else{
			   	$('#semanas').empty();        
			   }
       		}
		});
		$('#dateF').datepicker({
			dateFormat: 'dd-mm-yy', 
			yearRange: '-5:+5',
			changeMonth: true,
			changeYear: true,
			onSelect: function(date, inst) {
			    var dateObj = $(this).datepicker( 'getDate' );
		        var dateTo = $.datepicker.formatDate('mm/dd/yy', dateObj);
		        var weekto = $.datepicker.iso8601Week(new Date(dateTo));

		        var dateObj = $('#dateS').datepicker( 'getDate' );
		        var dateFrom = $.datepicker.formatDate('mm/dd/yy', dateObj);
		        var weekfrom = $.datepicker.iso8601Week(new Date(dateFrom));

		        // subtract last date from first date's week#
		       var weekz = weekto-weekfrom+1;

		       if (weekz > 1){
		        $('#semanas').empty().append(parseInt(weekz)+" semanas");        
			   }else if (weekz == 1){
			  	$('#semanas').empty().append(parseInt(weekz)+" semana");        
			   }else{
			   	$('#semanas').empty();        
			   }
			}

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
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Pasantes > Ficha de Pasante > Agregar Pasantía").html;
    });

</script>


<script src="js/primaryTutorind.js"> </script>