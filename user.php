<?php include 'header.php'; ?>

<div id="user_div">
	<div class="whitebg "> <h1>Datos de Usuario</h1> </div>

	<div id="le_div">
		<form method="post">
		<p><span>Nombre</span> <input class="white notsowidearea" type="text" name="nombre" value="<?php get_nombre($_SESSION['login_usuario']);?>" > </p> 
		<p><span>Usuario</span> <input class="white notsowidearea" type="text" name="usuario" value="<?php get_usuario($_SESSION['login_usuario']);?>" > </p>
		<p><span>Clave</span> <input class="white notsowidearea" type="password" name="password" value="" > </p>
		<p><span>Nivel de Usuario:</span> <big><strong><? if(($_SESSION['tipo'])==2){echo "Administrador"; };?> </strong></big></p>

		<input class="white button" type="submit" name="submit" value="Guardar" >		


		<?php
			if(isset($_POST['submit'])){
				$nombre = $_POST['nombre'];
				$usuario_nuevo = $_POST['usuario'];
				$password = $_POST['password'];
				$usuario_viejo = get_usuario2($_SESSION['login_usuario']);
				$errors = array();

				if(  (buscarExistenciaUsuario($usuario_nuevo)===1) &&  ($usuario_viejo != $usuario_nuevo) ){
					$errors[]= 'Ese usuario ya existe, debe elegir otro';	
				}

				if(muyCorto($nombre) || muyCorto($usuario_nuevo) || muyCorto($password)){
					$errors[] = 'Escriba al menos 4 caracteres en todos los campos';
				}

				if (!empty($errors)) {
						echo "<br>";
					foreach ($errors as $error){
						echo $error, '<br />';
					}
				}else{
					$password = MD5($password);
					$password = substr($password, 0, 20);
					$usuario_nuevo = strtoupper($usuario_nuevo);
					actualizarDatosUsario($nombre,$usuario_nuevo, $usuario_viejo,$password);

					$_SESSION['login_usuario'] = $usuario_nuevo;

					echo "<script language='javascript'>";
					echo "alert('Datos Actualizados Exitosamente! Acceda nuevamente al sistema')";
					echo "</script>";
				

					header('refresh:1;url=logout.php');

					exit();
				}
			}
		?>



		</form>
	</div>
</div>


<?php include 'footer.php'; ?>


<script src="js/tooltip.js"></script>

<script type="text/javascript">
	 $(document).ready(function() {
      $('#titulo1').text("Sistema de Control de Pasantias > Cuenta ").html;
    });
</script>

			