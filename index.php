<?php include 'header2.php';?>
		<!-- LOGIN -->
		<div id="middle">
		
			<div id="login_div"> 	
				<form action="" method="post">
					<div class="whitebg"> <h2 id="titulox"> Acceso al Sistema </h2> </div>
					
					<div id="use_div"><span>Usuario</span><input type="text" class="white user" name="login_usuario"></input></div>
					<div id="pass_div"><span>Password</span><input type="password" class="white" name="login_password"></input></div>	


					<!-- procesar formulario-->
					<?php

						if(isset($_POST['login_usuario'], $_POST['login_password'])) {
							$login_usuario = $_POST['login_usuario'];
							$login_password = $_POST['login_password'];
							
							$errors = array();
							
							if (empty($login_usuario)){
								$errors[] = 'Ingrese su usuario';					
							}if(empty($login_password)) {
								$errors[]='Ingrese su clave';
							}if (empty($errors)){
								$login_usuario = strtoupper($login_usuario);
								
								
								$login= login_check($login_usuario, $login_password);
								
								$url;
								$tipo;
								
									if($login==1){
										$url='tutores';
										$tipo=1;
									}else if($login==2){
										$url='buscar';
										$tipo=2;										
									}
								
								
								if( $login==1 || $login==2){
									$estado = true;
								}else{
									$estado = false;
								}
								
								
								if (!$estado){
									$errors[] = "Clave o usuario incorrecto";
								}else{
									$_SESSION['tipo'] = $tipo;
								}
							}
							
							if (!empty($errors)) {
								    foreach ($errors as $error){
									echo '<strong><p class="mall" style="color:white;text-shadow: 1px 1px 2px rgba(0,0,0,1);">',$error, '</p></strong><br/>';
								}
							}else{
								$_SESSION['login_usuario'] = $login_usuario;;
								header('Location:'.$url.'.php');
								exit();
							}
						}
					?>

					
					<div id="entrar_boton_div">
						<button class="white button">Entrar</button>
					</div>
				</form>

		
					<p id="invalidoo" style="color:white; font-weight: bold; margin-bottom:15px;text-shadow: 1px 1px 2px rgba(0,0,0,1);"></p>

			
			</div>
		</div>
		
		
				
		
<?php include 'footer2.php'; ?>

