
<!--foter-->
		<div id="footer">
			<ul id="footer_menu">
				<li class="homeButton">
					<a class="delete" href="buscar.php"></a>
				</li>
				
				<li>
					<a href="#" class="delete"> Pasantes </a>
					<ul class="dropup">
						<li> <a href="agregar.php"> Nuevo Pasante</a></li>
						<li> <a href="buscar.php">Buscar Pasantes</a></li>
					</ul>	
				</li>
				<li>
					<a href="#"> Evaluaciones </a>
					<ul class="dropup">
						<li> <a href="agregar_factor.php"> Nuevo Factor de Evaluación</a></li>
						<li> <a href="factores.php"> Factores de Evaluación</a></li>
					</ul>	
				</li>
				<li>
					<a href="#"> Pagos </a>
					<ul class="dropup">
						<li> <a href="relaciones.php"> Relaciones de Pago</a></li>
					</ul>	
				</li>
				
				<!-- Layout de 3 columnas -->
				<li>
					<a href="#">Indicadores</a>
					<div class="three_column_layout">
						<div class="col_3">
							<h2> Indicadores de Pasantia</h2>
						</div>
						<div class="col_1 black_box">
							<a href="requerimientos_solicitados.php"><p>Requerimientos<br>X<br>Solicitados</p> </a>
						</div>
						<div class="col_2 center">
							<a href="requerimientos_solicitados.php"><p> <img src="img/f1.jpg"> </p></a>
						</div>
						<div class="clear"> </div>
						<div class="col_1 black_box">
							<a href="requerimientos_area.php"><p>Requerimientos <br> X <br> Áreas</p></a>
						</div>
						<div class="col_2 center">
							<a href="requerimientos_area.php"><p> <img src="img/f2.jpg"></p></a>
						</div>
						<div class="clear"> </div>
						<div class="col_1 black_box">
							<a href="requerimientos_especialidades.php"><p>Requerimientos <br> X <br> Especialidades</p> </a>
						</div>
						<div class="col_2 center">
							<a href="requerimientos_especialidades.php"><p> <img src="img/f3.jpg"> </p></a>
						</div>
						<div class="clear"> </div>
						<div class="col_1 black_box">
							<a href="requerimientos_niveles.php"><p>Requerimientos<br>X<br>Niveles Educativos</p></a>
						</div>
						<div class="col_2 center">
							<a href="requerimientos_niveles.php"><p> <img src="img/f4.jpg"> </p></a>
						</div>
						<div class="clear"> </div>
						<div class="col_1 black_box">
							<a href="cuantificacion_costo.php"><p>Cuantificación de costo</p></a>
						</div>
						<div class="col_2 center">
							<a href="cuantificacion_costo.php"><p> <img src="img/f5.jpg"></p></a>
						</div>
					</div>
				</li>
				
				<li>
					<a href="#"> Agregar </a>
					<ul class="dropup">
						<li> <a href="nuevo_instituto.php"> Nueva Institución</a></li>
						<li> <a href="nueva_especialidad.php"> Nueva Especialidad</a></li>
						<li> <a href="nueva_area.php"> Nueva Área</a></li>
					</ul>	
				</li>
				<li>
					<a href="#"> Consultas </a>
					<ul class="dropup">
						<li> <a href="instituciones.php?orden=ASC"> Instituciones </a> </li>
						<li> <a href="especialidades.php?orden=ASC"> Especialidades </a> </li>
					    <li> <a href="areas.php?orden=ASC"> Áreas </a> </li>
					</ul>	
				</li>
				
				<!-- Layout de 3 columnas -->
				
				<?php if(get_nivel_admin($_SESSION['login_usuario'])==3){?>
				<li>
					<a href="#">Cuentas</a>
					<div class="two_column_layout">
						<div class="col_2"> 
							<h2> Cuentas </h2>
						</div>
					<!--parafos con imagenes-->
						<div class="col_2">
							<p> 
								<img src="img/profileImage.png" class="img_left" alt="" />
								<a style="display:inline; font-weight:bold; color:#fff;"> <?php get_nombre($_SESSION['login_usuario']);?> </a>
								<a href="nuevo_admin.php"> Crear nuevo administrador </a>
								
							</p>
						</div> 
					</div>
				</li>
				
				<?php } ?>
				
				
				
				
				<li class="right"> <a href="logout.php" class="drop"> Salir </a> </li>
			</ul>
			
			<ul id="notifications"style="visibility:hidden;" >
                <li>
                    <a href="#" class="notificationIcons"><img src='img/alert.png' alt="" />
                        <span> 
                            <img src="img/profileImage.png" style="float:left;width:24px;margin-right:5px;"/>
                            <div style="display:inline;color:white;font-weight:bold;">Petrofina Matyushenko</div> Pasantia por terminar en 7 dias.
                            <hr style="border:none;border-bottom:1px solid #777777; margin-bottom:5px;"/>
                            <img src="img/profileImage.png" style="float:left;width:24px;margin-right:5px;"/>
                            <div style="display:inline;color:white;font-weight:bold;">Vladimir Putin</div> Pasantia por terminar en 15 dias
                            <hr style="border:none;border-bottom:1px solid #777777; margin-bottom:5px;"/>
                            <img src="img/profileImage.png" style="float:left;width:24px;margin-right:5px;"/>
                            <div style="display:inline;color:white;font-weight:bold;">Barack Obama</div> Pasantia por terminar en 30 dias. 
                        </span>
                    </a>
                </li>
            </ul>
		</div>		
</html>

