<?php include 'header.php'; ?>
<div id="busqueda">
	<form method="post">
		<div id="suggest_div">
			<input type="text" class="autosuggest" name="nombre" placeholder="nombre de la instituci&oacute;n" autocomplete="off">
			<div class="dropdown">
				<ul class="result"> 
					
				</ul>
			</div>
		</div>
		<div id="btn_div">
			<input class="white button" type="submit" name="submit" value="buscar">
		</div>
	</form>
</div>
<?php 
getInstitutos();
?>

<?php
	if(isset($_POST['submit'])){
		$nombre=$_POST['nombre'];
		$nombre = strtoupper($nombre);
		header('Location: instituciones.php?nombre='.$nombre);
	}
?>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
<script src="js/primary.js"> </script>
<script src="js/tooltip.js"></script>

<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantías > Consultas > Instituciones").html;
    });
</script>