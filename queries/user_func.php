<?php 
	include 'db_connect.php';
	include 'db_connectRRHH.php';
	include 'db_connectIntranet.php';
	
	function logged_in(){
			return isset($_SESSION['login_usuario']);
	}
	
	function nivel(){
			return ($_SESSION['tipo']);
	}

	function postgre_mysql_real_escape_string($unescaped_string){
		return str_replace
		(
			array("\x00", "\\", "\0", "\n", "\r", "'", '"', "\x1a")
			,' ',$unescaped_string
		);
	}
	
	/*Funcion para validar el login*/
	function login_check($user, $password){
	
		$link = new Conexion_Intranet();
		
		$password = MD5($password);
		
		$result=pg_query("SELECT cedula
						FROM validar 
						WHERE login=UPPER('$user')
						AND clave='$password'");
		
		$num = pg_num_rows($result);
			
		if($num==0){
			return false;
		}else{
			$cedula = pg_fetch_result($result, 0, "cedula");
			
			$link2 = new Conexion_postgre();
			
			$result2=pg_query("SELECT nivel
								FROM usuarios
								WHERE id_usuario='$cedula'");
			
			$num2 = pg_num_rows($result2);
			
			if($num2==0){				
				return 1;				// es tutor
			}else{
				return 2;				// es administrador
			}
		}
	
	}
	
	
	function get_nombre($user){
		$link = new Conexion_postgre();
			
		$result = pg_query("SELECT nombre
							FROM usuarios
							WHERE id_usuario='$user'");
		while($row = pg_fetch_row($result)){
			echo $row[0];
		}
	}
	
	
	function get_nombre_tutor($cedu){
		$link = new Conexion_RRHH();
			
		$result = pg_query("SELECT nombres, apellidos
							FROM tablasmaestras.maestra
							WHERE cedula='$cedu'");
		while($row = pg_fetch_row($result)){
			echo $row[0]." ".$row[1];
		}
	}
	
	function get_nombre_institucion($inst){
		$link = new Conexion_postgre();
			
		$result = pg_query("SELECT nombre_institucion
							FROM instituciones
							WHERE cod_institucion='$inst'");
		while($row = pg_fetch_row($result)){
			echo $row[0];
		}
	}
	function get_nombre_especialidad($espe){
		$link = new Conexion_postgre();
			
		$result = pg_query("SELECT nombre_especialidad
							FROM especialidades
							WHERE cod_especialidad='$espe'");
		while($row = pg_fetch_row($result)){
			echo $row[0];
		}
	}
	function get_nombre_nivel($niv){
		$link = new Conexion_postgre();
			
		$result = pg_query("SELECT descripcion	
							FROM niveles_pasantes
							WHERE cod_nivel='$niv'");
		while($row = pg_fetch_row($result)){
			echo $row[0];
		}
	}
	function get_nivel_admin($login_usuario){
		$link = new Conexion_Intranet();
			
		$result = pg_query("SELECT cedula
							FROM validar
							WHERE login=UPPER('$login_usuario')");
							
		$cedula = pg_fetch_result($result, 0, "cedula");
		
		$link2 = new Conexion_postgre();
		
		$result2 = pg_query("SELECT nivel
							FROM usuarios
							WHERE id_usuario='$cedula' ");
							
		$nivel = pg_fetch_result($result2, 0, "nivel");

		return $nivel;
	}
	
	function get_remuneracion($niv){
		$link = new Conexion_postgre();
			
		$result = pg_query("SELECT remuneracion
							FROM niveles_pasantes
							WHERE cod_nivel='$niv'");
		while($row = pg_fetch_row($result)){
			return $row[0];
		}
	}
	
	function get_nombre_area($area){
		$link = new Conexion_postgre();
			
		$result = pg_query("SELECT nombre_area
							FROM areas
							WHERE cod_area='$area'");
		while($row = pg_fetch_row($result)){
			echo $row[0];
		}
	}
	
	
	
	function get_usuario($user){
		$link = new Conexion_postgre();
			
		$result = pg_query("SELECT id_usuario
							FROM usuarios
							WHERE id_usuario='$user'");
		while($row = pg_fetch_row($result)){
			echo $row[0];
		}

		
	}

	function get_usuario2($user){
		$link = new Conexion_postgre();
			
		$result = pg_query("SELECT id_usuario
							FROM usuarios
							WHERE id_usuario='$user'");
		while($row = pg_fetch_row($result)){
			return $row[0];
		}

		
	}

	function get_nivel($user){
		$link = new Conexion_postgre();
			
		$result = pg_query("SELECT nivel
							FROM usuarios
							WHERE id_usuario='$user'");
		
	}

	function get_password($user){
		$link = new Conexion_postgre();
			
		$result = pg_query("SELECT pass_usuario
							FROM usuarios
							WHERE id_usuario='$user'");
		while($row = pg_fetch_row($result)){
			echo $row[0];
		}

		
	}

	function actualizarDatosUsario($nombre,$usuario_nuevo, $usuario_viejo,$password){
		$link = new Conexion_postgre();

		$result = pg_query("UPDATE usuarios SET nombre='$nombre', id_usuario='$usuario_nuevo', pass_usuario='$password' WHERE id_usuario='$usuario_viejo'");		

		
	}
	
	function nuevo_instituto($nombre,$dir,$tlf,$persona){
		
		$link = new Conexion_postgre();

		$result = pg_query("INSERT INTO instituciones
						  (nombre_institucion,direccion,tlf,persona_contacto)
						   VALUES('$nombre','$dir','$tlf','$persona')");
		if(!$result){
			return false;
		}else{
			return true;
		}

		
	}

	function nueva_espe($nombre){

		$link = new Conexion_postgre();
		
		$result = pg_query("INSERT INTO especialidades
						  (nombre_especialidad)
						   VALUES('$nombre')");
		if(!$result){
			return false;
		}else{
			return true;
		}

		

	}

	function nueva_area($nombre){

		$link = new Conexion_postgre();
		
		$result = pg_query("INSERT INTO areas
						  (nombre_area)
						   VALUES('$nombre')");
		if(!$result){
			return false;
		}else{
			return true;
		}

		

	}

	function buscarExistenciaPasante($cedu){

		$link = new Conexion_postgre();

		$result = pg_query("SELECT cedula
							FROM pasantes
							WHERE
							cedula='".$cedu."'");
		
		if(pg_num_rows($result)>0){
			return 1;			
		}else{
			return 0;
		}	
	}
	
	function buscarExistencia($user){

		$link = new Conexion_postgre();

		$result = pg_query("SELECT id_usuario 
							FROM usuarios
							WHERE
							id_usuario='".$user."'");
		
		if(pg_num_rows($result)>0){
			echo 'no existe';
			
		}else{
			echo 'existe';
		}

		
	}
	
	function buscarExistenciaInstituto($nombre){

		$link = new Conexion_postgre();

		$result = pg_query("SELECT nombre_institucion 
							FROM instituciones
							WHERE
							nombre_institucion='$nombre'");
		
		if(pg_num_rows($result)==0){
			return 0;
		}else{
			return 1;
		}
	}

	function buscarExistenciaEspe($nombre){

		$link = new Conexion_postgre();

		$result = pg_query("SELECT nombre_especialidad 
							FROM especialidades
							WHERE
							nombre_especialidad='$nombre'");
		
		if(pg_num_rows($result)==0){
			return 0;
		}else{
			return 1;
		}

		
	}

	function buscarExistenciaArea($nombre){

		$link = new Conexion_postgre();

		$result = pg_query("SELECT nombre_area 
							FROM areas
							WHERE
							nombre_area='$nombre'");
		
		if(pg_num_rows($result)==0){
			return 0;
		}else{
			return 1;
		}

		
	}

	function buscarExistenciaUsuario($user){

		$link = new Conexion_postgre();

		$result = pg_query("SELECT id_usuario 
							FROM usuarios
							WHERE
							id_usuario='$user'");
		
		if(pg_num_rows($result)==0){
			return 0;
		}else{
			return 1;
		}	

		
	}

	function muyCorto($string){
		if (strlen($string) < 4 ) {
			return true;
		}else{
			return false;
		}
	}

	function getInstitutos(){

		$link = new Conexion_postgre();
		
		if (isset($_GET['orden'])) {
			$orden = $_GET['orden'];
		}else{
			$orden = "ASC";
		}

		if(isset($_GET['nombre'])){
			$nombre = $_GET['nombre'];
			$nombre = "instituciones WHERE nombre_institucion='$nombre'";
		}else{
			$nombre = "instituciones";
		}
		
		$result = pg_query("SELECT cod_institucion,
							 nombre_institucion,
							 direccion,
							 tlf,
							 persona_contacto
							 FROM $nombre
							 ORDER BY nombre_institucion $orden");
		$num = pg_num_rows($result);
		
		
		$i=0;

		if ($orden == "ASC"){
			$link = '<a href="instituciones.php?orden=DESC" style="display:inline-block;"><img src="img/order.png" style="vertical-align:middle;"></a>';
		}else{
			$link = '<a href="instituciones.php?orden=ASC" style="display:inline-block;"><img src="img/orden2.png" style="vertical-align:middle;"></a>';
		}
		echo '<table class="tablas" width=90%>';

		echo '<thead>';
			echo "<tr>";
				echo '<th width=45%>Nombre de la Instituci&oacute;n '.$link.'</th>';
				echo '<th width=25%><div class="delete">Direcci&oacute;n</div></th>';
				echo '<th width=15%>Tel&eacute;fono</th>';
				echo '<th width=15%>Contacto</th>';
				echo '<th width=1% style="text-align:center;"></th>';
				echo '<th width=1%></th>';
			echo "</tr>";
		echo '</thead>';

		echo"<tfoot>";
    	echo"<tr>";
        	echo'<td colspan="6"><em>Busqueda de instituciones registradas en el sistema</em></td>';
        echo"</tr>";
    	echo"</tfoot>";
    	echo "<tbody>";

    		if ($num == 0){
    			echo '<tr> <td colspan="6"><b>No se encontraron coincidencias</b></td></tr>';
    		}else{
				while ($i < $num) {
					$cod_institucion = pg_fetch_result($result, $i, "cod_institucion");
					$nombre_institucion = pg_fetch_result($result, $i, "nombre_institucion");
					$direccion = pg_fetch_result($result, $i, "direccion");
					$tlf = pg_fetch_result($result, $i, "tlf");
					$persona_contacto = pg_fetch_result($result, $i, "persona_contacto");

					echo "<tr>";
					echo "<td>" . $nombre_institucion . "</td>";
					echo "<td>" . $direccion . "</td>";
					echo "<td>" . $tlf . "</td>";
					echo "<td>" . $persona_contacto . "</td>";
					echo '<td><a href="editar_institucion.php?cod_institucion='.$cod_institucion.'" class="teditar"><img src="img/edit2.png" alt="editar"></a></td>';
					if(institucion_existe_pasantia($cod_institucion)){
						echo '<td><a class="no_disponible" ><img src="img/trash3.png" alt="eliminar"></a></td>';
					}else{
						echo '<td><a onClick=Confirmacion(',$cod_institucion,') class="teliminar delete" ><img src="img/trash2.png" alt="eliminar"></a></td>';
					}

					echo "</tr>";

					$i++;
				}
			}
		echo "</tbody>";
		echo "</table>";

		
	}
	
	function tienePasantia($cedu){
		$link = new Conexion_postgre();
		$result = pg_query("SELECT COUNT(*) 
								AS rows
								FROM pasantias
								WHERE cedula_pasante='$cedu'");
								
		if(!$result){
			echo "query did not execute";
		}
		
		if ($line = pg_fetch_assoc($result)) {
			if ($line['rows'] == 0) {
				return false;
			} else {
				return true;
			}
		}	
	}
	
	function institucion_existe_pasantia($cod_insti){
	
	$link = new Conexion_postgre();		
		$result = pg_query("SELECT COUNT(*) 
								AS rows
								FROM pasantias
								WHERE institucion_educativa='$cod_insti'");
								
		if(!$result){
			echo "query did not execute";
		}
		
		if ($line = pg_fetch_assoc($result)) {
			if ($line['rows'] == 0) {
				return false;
			} else {
				return true;
			}
		}	
	}

	function delete_institucion($cod_institucion){

		$link = new Conexion_postgre();

		$result = pg_query("DELETE 
							FROM instituciones
							WHERE cod_institucion='$cod_institucion'");

		

	}

	function datosInstitucion($cod_institucion){

		$link = new Conexion_postgre();

		$cod_institucion = (int)$cod_institucion;
		
		$args = func_get_args();
		unset($args[0]);
		$fields = implode(", ", $args);
		$query = pg_query("SELECT $fields FROM instituciones WHERE cod_institucion=$cod_institucion");	
		$query_result = pg_fetch_assoc($query);
		foreach($args as $field) {
			$args[$field] = $query_result[$field];
		}
		return $args;

	}
	
	function datosPasante($cedu){

		$link = new Conexion_postgre();
		
		$args = func_get_args();
		unset($args[0]);
		$fields = implode(", ", $args);
		$query = pg_query("SELECT $fields FROM pasantes WHERE cedula='$cedu'");
		$query_result = pg_fetch_assoc($query);
		foreach($args as $field) {
			$args[$field] = $query_result[$field];
		}
		return $args;
	
	}
	
	
	
	function idNiveles(){

		$link = new Conexion_postgre();
		

		$query = pg_query("SELECT cod_nivel FROM niveles_pasantes");
		
		$niv_ids = array();
		
		$num = pg_num_rows($query);
		$i=0;
		
		if($num == 0){
			echo "no hay niveles educativos agregados";
		}else{
			while($i < $num){
			$cod_nivel=pg_fetch_result($query, $i, "cod_nivel");
			$niv_ids[]=$cod_nivel;
			
			$i++;
			}			
		}
		
		return $niv_ids;
	
	}

	function editar_institucion($cod_institucion, $nombre_institucion, $direccion, $tlf, $persona_contacto){
		
		$link = new Conexion_postgre();

		$cod_institucion = (int)$cod_institucion;
		$nombre_institucion = postgre_mysql_real_escape_string($nombre_institucion);
		$direccion = postgre_mysql_real_escape_string($direccion);
		$tlf = postgre_mysql_real_escape_string($tlf);
		$persona_contacto = postgre_mysql_real_escape_string($persona_contacto);
		pg_query("UPDATE instituciones SET nombre_institucion='$nombre_institucion', direccion='$direccion', tlf='$tlf', persona_contacto='$persona_contacto' WHERE cod_institucion=$cod_institucion");

		

	}

	function listarInstituciones($sel){

		$link = new Conexion_postgre();

		$result=pg_query("SELECT cod_institucion, nombre_institucion
				 FROM instituciones
				 ORDER BY nombre_institucion ASC");
		$num = pg_num_rows($result);
		$i=0;
		if($num == 0){
			echo "<option> No hay instituciones registradas</option>";
		}else{
			$desiredSelect = $sel;
			while($i < $num){
				$nombre_institucion=pg_fetch_result($result, $i, "nombre_institucion");
				$cod_institucion=pg_fetch_result($result, $i, "cod_institucion");
				if($desiredSelect === $cod_institucion){
					echo "<option selected=\"selected\" value='".$cod_institucion."'>".$nombre_institucion."</option>";
				}else{
					echo "<option value='".$cod_institucion."'>".$nombre_institucion."</option>";
				}
				$i++;
			}
		}

		

	}


	function getEspecialidades(){

	$link = new Conexion_postgre();
		
		if (isset($_GET['orden'])) {
			$orden = $_GET['orden'];
		}else{
			$orden = "ASC";
		}

		if(isset($_GET['nombre'])){
			$nombre = $_GET['nombre'];
			$nombre = "especialidades WHERE nombre_especialidad='$nombre'";
		}else{
			$nombre = "especialidades";
		}
		
		$result = pg_query("SELECT cod_especialidad,
							 nombre_especialidad
							 FROM $nombre
							 ORDER BY nombre_especialidad $orden");
		$num = pg_num_rows($result);
		
		
		$i=0;

		if ($orden == "ASC"){
			$link = '<a href="especialidades.php?orden=DESC" style="display:inline-block;"><img src="img/order.png" style="vertical-align:middle;"></a>';
		}else{
			$link = '<a href="especialidades.php?orden=ASC" style="display:inline-block;"><img src="img/orden2.png" style="vertical-align:middle;"></a>';
		}
		echo '<table class="tablas" width=90%>';

		echo '<thead>';
			echo "<tr>";
				echo '<th width=45%>Nombre de la Especialidad '.$link.'</th>';
				echo '<th width=1% style="text-align:center;"></th>';
				echo '<th width=1%></th>';
			echo "</tr>";
		echo '</thead>';

		echo"<tfoot>";
    	echo"<tr>";
        	echo'<td colspan="6"><em>Busqueda de especialidades registradas en el sistema</em></td>';
        echo"</tr>";
    	echo"</tfoot>";
    	echo "<tbody>";

    		if ($num == 0){
    			echo '<tr> <td colspan="6"><b>No se encontraron coincidencias</b></td></tr>';
    		}else{
				while ($i < $num) {
					$cod_especialidad = pg_fetch_result($result, $i, "cod_especialidad");
					$nombre_especialidad = pg_fetch_result($result, $i, "nombre_especialidad");

					echo "<tr>";
					echo "<td>" . $nombre_especialidad . "</td>";
					echo '<td><a href="editar_especialidad.php?cod_especialidad='.$cod_especialidad.'" class="teditar"><img src="img/edit2.png" alt="editar"></a></td>';
					if(especialidad_existe_pasantia($cod_especialidad)){
						echo '<td><a class="no_disponible" ><img src="img/trash3.png" alt="eliminar"></a></td>';
					}else{
						echo '<td><a onClick=ConfirmacionE(',$cod_especialidad,') class="teliminar delete" ><img src="img/trash2.png" alt="eliminar"></a></td>';
					}

					echo "</tr>";

					$i++;
				}
			}
		echo "</tbody>";
		echo "</table>";

		

	}
	
	function especialidad_existe_pasantia($cod_espe){
	
	$link = new Conexion_postgre();		
		$result = pg_query("SELECT COUNT(*) 
								AS rows
								FROM pasantias
								WHERE especialidad='$cod_espe'");
								
		if(!$result){
			echo "query did not execute";
		}
		
		if ($line = pg_fetch_assoc($result)) {
			if ($line['rows'] == 0) {
				return false;
			} else {
				return true;
			}
		}	
	}

	function delete_especialidad($cod_especialidad){
	
		$link = new Conexion_postgre();

		$result = pg_query("DELETE 
							FROM especialidades
							WHERE cod_especialidad='$cod_especialidad'");
	
		
	}

	function datosEspecialidad($cod_especialidad){

		$link = new Conexion_postgre();

		$cod_especialidad = (int)$cod_especialidad;
		
		$args = func_get_args();
		unset($args[0]);
		$fields = implode(", ", $args);
		$query = pg_query("SELECT $fields FROM especialidades WHERE cod_especialidad=$cod_especialidad");	
		$query_result = pg_fetch_assoc($query);
		foreach($args as $field) {
			$args[$field] = $query_result[$field];
		}
		return $args;
	
		
	}

	function editar_especialidad($cod_especialidad, $nombre_especialidad){
	
		$link = new Conexion_postgre();

		$cod_especialidad = (int)$cod_especialidad;
		$nombre_especialidad = postgre_mysql_real_escape_string($nombre_especialidad);
		pg_query("UPDATE especialidades SET nombre_especialidad='$nombre_especialidad' WHERE cod_especialidad=$cod_especialidad");

		

	}

	function listarEspecialidades($sel){

		$link = new Conexion_postgre();

		$result=pg_query("SELECT cod_especialidad, nombre_especialidad
				 FROM especialidades
				 ORDER BY nombre_especialidad ASC");
		$num = pg_num_rows($result);
		$i=0;
		if($num == 0){
			echo "<option> No hay especialidades registradas</option>";
		}else{
			$desiredSelect = $sel;	
			while($i < $num){
				$nombre_especialidad=pg_fetch_result($result, $i, "nombre_especialidad");
				$cod_especialidad= pg_fetch_result($result, $i, "cod_especialidad");
				if($desiredSelect === $cod_especialidad){
					echo '<option selected=\"selected\" value="'.$cod_especialidad.'">'.$nombre_especialidad.'</option>';
				}else{
					echo '<option value="'.$cod_especialidad.'">'.$nombre_especialidad.'</option>';
				}
				$i++;
			}
		}
	
		
	}

	function getAreas(){
		
		$link = new Conexion_postgre();

		if (isset($_GET['orden'])) {
			$orden = $_GET['orden'];
		}else{
			$orden = "ASC";
		}

		if(isset($_GET['nombre'])){
			$nombre = $_GET['nombre'];
			$nombre = "areas WHERE nombre_area='$nombre'";
		}else{
			$nombre = "areas";
		}
		
		$result = pg_query("SELECT cod_area,
							 nombre_area
							 FROM $nombre
							 ORDER BY nombre_area $orden");
		$num = pg_num_rows($result);
		
		
		$i=0;

		if ($orden == "ASC"){
			$link = '<a href="areas.php?orden=DESC" style="display:inline-block;"><img src="img/order.png" style="vertical-align:middle;"></a>';
		}else{
			$link = '<a href="areas.php?orden=ASC" style="display:inline-block;"><img src="img/orden2.png" style="vertical-align:middle;"></a>';
		}
		echo '<table class="tablas" width=90%>';

		echo '<thead>';
			echo "<tr>";
				echo '<th width=45%>Nombre de Área '.$link.'</th>';
				echo '<th width=1% style="text-align:center;"></th>';
				echo '<th width=1%></th>';
			echo "</tr>";
		echo '</thead>';

		echo"<tfoot>";
    	echo"<tr>";
        	echo'<td colspan="6"><em>Busqueda de &aacute;reas registradas en el sistema</em></td>';
        echo"</tr>";
    	echo"</tfoot>";
    	echo "<tbody>";

    		if ($num == 0){
    			echo '<tr> <td colspan="6"><b>No se encontraron coincidencias</b></td></tr>';
    		}else{
				while ($i < $num) {
					$cod_area = pg_fetch_result($result, $i, "cod_area");
					$nombre_area = pg_fetch_result($result, $i, "nombre_area");

					echo "<tr>";
					echo "<td>" . $nombre_area . "</td>";
					echo '<td><a href="editar_area.php?cod_area='.$cod_area.'" class="teditar"><img src="img/edit2.png" alt="editar"></a></td>';
					if(area_existe_pasantia($cod_area)){
						echo '<td><a class="no_disponible" ><img src="img/trash3.png" alt=""></a></td>';
					}else{
						echo '<td><a onClick=ConfirmacionA(',$cod_area,') class="teliminar delete" ><img src="img/trash2.png" alt="eliminar"></a></td>';
					}

					echo "</tr>";

					$i++;
				}
			}
		echo "</tbody>";
		echo "</table>";

		

	}
	
	function area_existe_pasantia($cod_area){
	
	$link = new Conexion_postgre();		
		$result = pg_query("SELECT COUNT(*) 
								AS rows
								FROM pasantias
								WHERE area_desempeno='$cod_area'");
								
		if(!$result){
			echo "query did not execute";
		}
		
		if ($line = pg_fetch_assoc($result)) {
			if ($line['rows'] == 0) {
				return false;
			} else {
				return true;
			}
		}	
	}

	function delete_area($cod_area){
		
		
			$link = new Conexion_postgre();

			$result = pg_query("DELETE 
								FROM areas
								WHERE cod_area='$cod_area'");
		
		
	}

	function datosArea($cod_area){

		$link = new Conexion_postgre();

		$cod_area = (int)$cod_area;
		
		$args = func_get_args();
		unset($args[0]);
		$fields = implode(", ", $args);
		$query = pg_query("SELECT $fields FROM areas WHERE cod_area=$cod_area");	
		$query_result = pg_fetch_assoc($query);
		foreach($args as $field) {
			$args[$field] = $query_result[$field];
		}
		return $args;
	
		

	}

	function editar_area($cod_area, $nombre_area){

		$link = new Conexion_postgre();

		$cod_area = (int)$cod_area;
		$nombre_area = postgre_mysql_real_escape_string($nombre_area);
		pg_query("UPDATE areas SET nombre_area='$nombre_area' WHERE cod_area=$cod_area");

		

	}

	function listarAreas(){
		
		$link = new Conexion_postgre();

		$result=pg_query("SELECT cod_area, nombre_area
				 FROM areas
				 ORDER BY nombre_area ASC");
		$num = pg_num_rows($result);
		$i=0;
		if($num == 0){
			echo "<option> No hay areas registradas</option>";
		}else{
			$desiredSelect = $_POST['area'];
			while($i < $num){
				$nombre_area=pg_fetch_result($result, $i, "nombre_area");
				$cod_area=pg_fetch_result($result, $i, "cod_area");
				
				if($desiredSelect === $cod_area){
					echo "<option selected=\"selected\" value='".$cod_area."'>".$nombre_area."</option>";
				}else{
					echo "<option value='".$cod_area."'>".$nombre_area."</option>";
				}
				$i++;
			}
		}
	
		

	}
	
	function getPasantes(){

		$link = new Conexion_postgre();
		
		if (isset($_GET['orden'])) {
			$orden = $_GET['orden'];
		}else{
			$orden = "ASC";
		}

		if(isset($_GET['nombre'])){
			$nombre = $_GET['nombre'];
			if(!empty($nombre)){
				$nombre = "pasantes WHERE cedula='$nombre'";
			}else{
				$nombre = "pasantes";
			}
		}else{
			$nombre = "pasantes";
		}
		
		$result = pg_query("SELECT pasantes.cedula,
							 pasantes.nombres,
							 pasantes.apellidos,							 
							 pasantes.sexo,
							 pasantes.tipo_sangre,
							 pasantes.fecha_nacimiento
							 FROM $nombre
							 ORDER BY cedula $orden");
		$num = pg_num_rows($result);
		
		$i=0;

		if ($orden == "ASC"){
			$link = '<a href="buscar.php?orden=DESC" style="display:inline-block;"><img src="img/order.png" style="vertical-align:middle;"></a>';
		}else{
			$link = '<a href="buscar.php?orden=ASC" style="display:inline-block;"><img src="img/orden2.png" style="vertical-align:middle;"></a>';
		}
		echo '<table class="tablas" width=90%>';

		echo '<thead>';
			echo "<tr>";
				echo '<th width=10%>C&eacute;dula'.$link.'</th>';
				echo '<th width=15%>Nombres</th>';
				echo '<th width=15%>Apellidos</th>';
				echo '<th width=5%>Edad</th>';
				echo '<th width=5%>Sexo</th>';				
				echo '<th width=5%>Sangre</th>';				
				echo '<th width=25%>Tel&eacute;fonos</th>';
				echo '<th width=1%></th>';
			echo "</tr>";
		echo '</thead>';

		echo"<tfoot>";
    	echo"<tr>";
        	echo'<td colspan="10"><em>Busqueda de pasantes</em></td>';
        echo"</tr>";
    	echo"</tfoot>";
    	echo "<tbody>";

    		if ($num == 0){
    			echo '<tr> <td colspan="10"><b>No se encontraron coincidencias</b></td></tr>';
    		}else{
				while ($i < $num) {
				
					$cedu = pg_fetch_result($result, $i, "cedula");
					$nombres = pg_fetch_result($result, $i, "nombres");
					$apellidos = pg_fetch_result($result, $i, "apellidos");
					$sexo = pg_fetch_result($result, $i, "sexo");
					$sangre = pg_fetch_result($result, $i, "tipo_sangre");
					$tlf= getTelefonos($cedu);
					
					$birthDate = pg_fetch_result($result, $i, "fecha_nacimiento");
					
					
					$birthDate=date("d-m-Y", strtotime($birthDate));
					 //explode the date to get month, day and year
					 $birthDate = explode("-", $birthDate);
					 //get age from date or birthdate
					 $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])):(date("Y")-$birthDate[2]));
		
					
					echo "<tr>";
					echo "<td>" . $cedu . "</td>";
					echo "<td>" . $nombres . "</td>";
					echo "<td>" . $apellidos . "</td>";
					echo "<td>" . $age . "</td>";
					echo "<td>" . $sexo . "</td>";
					echo "<td>" . $sangre . "</td>";
					echo "<td>" . $tlf . "</td>";
					echo '<td><a href="perfil_pasante.php?cedula='.$cedu.'" class="ficha"> <img src="img/ficha.png" alt="Ver ficha"></a></td>';

					echo "</tr>";

					$i++;
				}
			}
		echo "</tbody>";
		echo "</table>";

		
	}
	
	function delete_pasante($cedu){
		$link = new Conexion_postgre();
		
		$result = pg_query("DELETE FROM pasantes WHERE cedula='$cedu'");
	}
	
	function delete_pasantia($cedu,$cod){
		$link = new Conexion_postgre();
		
		$result = pg_query("DELETE FROM pasantias WHERE cedula_pasante='$cedu' AND cod_pasantia='$cod'");
	}
	
	function borrarTelefonos($cedu){
		
		$link = new Conexion_postgre();
		
		$result = pg_query("DELETE FROM telefonos_pasantes WHERE cedula_pasante='$cedu'");
	}
	
	function agregarTelefono($cedula,$telefono){
		$link = new Conexion_postgre();
		$result = pg_query("INSERT INTO telefonos_pasantes (cedula_pasante, numero_telefono) VALUES ('$cedula', '$telefono') ");
		
		if(!$result){
			echo "no se pudo agregar numero de pasante";
		}
		
	}
	
	function getTelefonos($cedu){
		$link = new Conexion_postgre();
		$result = pg_query("SELECT numero_telefono
							FROM telefonos_pasantes
							WHERE cedula_pasante='$cedu'");
		
		$num = pg_num_rows($result);
		
		$tlf ="";
		$i=0;

		if ($num == 0){
    			echo 'N/A';
    		}else{
				while ($i < $num) {
				if ($i==0){
					$tlf = pg_fetch_result($result, $i, "numero_telefono");
				}
				if ($i==1){	
					$tlf = $tlf." / ".pg_fetch_result($result, $i, "numero_telefono");
				}
					$i++;
				}
			}
		return $tlf;
	}
		
	function nuevoPasante($nombres,$apellidos,$cedu,$dateN,$sangre,$sexo,$nacionalidad,$lugar_nac,$dir){
		$link = new Conexion_postgre();
		
		$result = pg_query("INSERT INTO pasantes
							(cedula,nombres,apellidos,sexo,fecha_nacimiento,nacionalidad,lugar_nacimiento,direccion,tipo_sangre)
							VALUES('$cedu','$nombres','$apellidos','$sexo','$dateN','$nacionalidad','$lugar_nac','$dir','$sangre')");
		
		if(!$result){
			echo "no se pudo agregar pasante";
		}
	}

	function editarPasante($cedula_vieja,$cedula_nueva,$nombres,$apellidos,$sexo,$fecha_nacimiento,$nacionalidad,$lugar_nacimiento,$direccion,$tipo_sangre){
		$link = new Conexion_postgre();

		$result = pg_query("UPDATE pasantes SET nombres='$nombres', apellidos='$apellidos', sexo='$sexo',fecha_nacimiento='$fecha_nacimiento',nacionalidad='$nacionalidad', lugar_nacimiento='$lugar_nacimiento', direccion='$direccion', tipo_sangre='$tipo_sangre', cedula='$cedula_nueva' WHERE cedula='$cedula_vieja'");
		
		if(!$result){
			echo "error al editar pasante";
		}
	}

	function eliminarPasante(){

	}

	function agregarPasantia($cedu,$dates,$datef,$tind,$tacad,$inst,$espe,$area,$ubic,$desc,$niv,$trab){
		$link = new Conexion_postgre();
		
		$result = pg_query("INSERT into pasantias			(cedula_pasante,fecha_inicio,fecha_fin,tutor_industrial,tutor_academico,institucion_educativa,especialidad,area_desempeno,ubicacion_fisica,descripcion_pasantia,nivel_pasante,trabajador)
		VALUES ('$cedu','$dates', '$datef', '$tind', '$tacad', '$inst', '$espe', '$area', '$ubic', '$desc', '$niv', '$trab') ");
		
		if(!$result){
			echo "no se pudo agregar pasantia";
		}
		
	}
	
	function getPasantias($cedu){
		$link = new Conexion_postgre();
		
		$result = pg_query("SELECT cod_pasantia, fecha_inicio, fecha_fin, descripcion_pasantia 
							FROM pasantias
							WHERE
							cedula_pasante='$cedu' ORDER BY cod_pasantia");
		
		$num = pg_num_rows($result);
		$i=0;
		
		echo '<table class="tablas" width=90%>';

		echo '<thead>';
			echo "<tr>";
				echo '<th width=15%>Fecha Inicio</th>';
				echo '<th width=15%>Fecha Fin</th>';
				echo '<th width=50%>Descripci&oacute;n</th>';
				echo '<th width=1%></th>';
			echo "</tr>";
		echo '</thead>';

    	echo "<tbody>";
		
		if($num == 0){
			echo '<tr> <td style="padding:10px;" colspan="10"><b>No se han agregado pasantías a este pasante</b></td></tr>';
		}else{
			while($i < $num){
				$cod = pg_fetch_result($result, $i, "cod_pasantia");
				$fi = pg_fetch_result($result, $i, "fecha_inicio");
				$ff = pg_fetch_result($result, $i, "fecha_fin");
				$desc = pg_fetch_result($result, $i, "descripcion_pasantia");
				
				echo "<td>" . $fi . "</td>";
					echo "<td>" . $ff . "</td>";
					echo "<td>" . $desc . "</td>";
					echo '<td><a href="pasantias.php?cedula='.$cedu.'&cod='.$cod.'" class="detalle"> <img src="img/detalle.png" alt="Detalle"></a></td>';

					echo "</tr>";
					
					$i++;
			}
		}
		echo "</tbody>";
		echo"<tfoot>";
    	echo"<tr>";
        	echo'<td colspan="10"><em>Pasantías agregadas</em></td>';
        echo"</tr>";
    	echo"</tfoot>";
    	echo"</table>";
	
	}
	
	function datosPasantia($cedu,$cod){

		$link = new Conexion_postgre();

		$cod_institucion = (int)$cod_institucion;
		
		$args = func_get_args();
		unset($args[0]);
		$fields = implode(", ", $args);
		$query = pg_query("SELECT $fields FROM pasantias WHERE cedula_pasante='$cedu' AND cod_pasantia=$cod");	
		$query_result = pg_fetch_assoc($query);
		foreach($args as $field) {
			$args[$field] = $query_result[$field];
		}
		return $args;

	}

	function editarPasantia($cedu,$cod,$dateS,$dateF,$tind,$tacad,$inst,$espe,$area,$ubic,$desc,$niv){
		$link = new Conexion_postgre();

		$result = pg_query("UPDATE pasantias SET fecha_inicio='$dateS', fecha_fin='$dateF', tutor_industrial='$tind',tutor_academico='$tacad',institucion_educativa='$inst', especialidad='$espe', area_desempeno='$area', ubicacion_fisica='$ubic', descripcion_pasantia='$desc', nivel_pasante=$niv WHERE cedula_pasante='$cedu' AND cod_pasantia=$cod");
		
		if(!$result){
			echo "error al editar pasantia";
		}
	}

	function eliminarPasantia(){

	}

	function getNivelesEstudio(){
		$link = new Conexion_postgre();

		$result = pg_query("SELECT cod_nivel, descripcion, remuneracion
							 FROM niveles_pasantes
							 ORDER BY remuneracion ASC");
		$num = pg_num_rows($result);
		
		
		$i=0;

		if ($num == 0){
    			echo '<tr> <td colspan="0"><b>AGREGUE NIVELES DE ESTUDIO</b></td></tr>';
    		}else{
				while ($i < $num) {
					$cod_nivel = pg_fetch_result($result, $i, "cod_nivel");
					$desc = pg_fetch_result($result, $i, "descripcion");
					$remuneracion = pg_fetch_result($result, $i, "remuneracion");

					echo "<tr>";
					echo "<td>" . $desc . "</td>";
					echo "<td>" . $remuneracion . "</td>";	
					echo "</tr>";

					$i++;
				}
			}
	}

	function getNombresNivelesEstudio($sel){
		$link = new Conexion_postgre();

		$result = pg_query("SELECT  cod_nivel, descripcion
							 FROM niveles_pasantes
							 ORDER BY descripcion ASC");
		$num = pg_num_rows($result);


		$i=0;

		if ($num == 0){
			echo "AGREGUE NIVELES DE ESTUDIO";
		}else{
			$desiredSelect = $sel;
			while ($i < $num) {
				$desc = pg_fetch_result($result, $i, "descripcion");
				$cod = pg_fetch_result($result, $i, "cod_nivel");
				if($desiredSelect === $cod){
					echo "<option selected=\"selected\" value='".$cod."'>".$desc."</option>";
				}else{
					echo "<option value='".$cod."'>".$desc."</option>";
				}
				$i++;
			}
		}
		
	}
	
	function getUbicaciones($sel){
		$link = new Conexion_RRHH();
		
		$result = pg_query("SELECT  codigo,descrip3
							 FROM tablasmaestras.ubicacion
							 ORDER BY descrip3 ASC");
		$num = pg_num_rows($result);


		$i=0;

		if ($num == 0){
			echo "UBICACIONES NO REGISTRADAS";
		}else{
			$desiredSelect = $sel;
			while ($i < $num) {
				$desc = pg_fetch_result($result, $i, "descrip3");
				
				if ($desiredSelect == $desc){
					echo "<option value='".$desc."' selected=\"selected\">".$desc."</option>";
				}else{
					echo "<option value='".$desc."'>".$desc."</option>";
				}
				
				$i++;
			}
		}
	}
	
	function contarNiveles(){
		$link = new Conexion_postgre();	
		$result = pg_query("SELECT COUNT(*) as rows FROM niveles_pasantes");
		
		if(!$result){
			echo "query did not execute";
		}
		
		if ($line = pg_fetch_assoc($result)) {
			if ($line['rows'] == 0) {
				return $line['rows'];
			} else {
				return $line['rows'];
			}
		}		
	}
	
	function contarFactores(){
		$link = new Conexion_postgre();	
		$result = pg_query("SELECT COUNT(*) as rows FROM factores WHERE activo='s'");
		
		if(!$result){
			echo "query did not execute";
		}
		
		if ($line = pg_fetch_assoc($result)) {
			if ($line['rows'] == 0) {
				return $line['rows'];
			} else {
				return $line['rows'];
			}
		}		
	}
	
	function nuevo_factor($desc,$pos,$act){
		$link = new Conexion_postgre();

		$result = pg_query("INSERT INTO factores
						  (descripcion,posicion,activo)
						   VALUES('$desc','$pos','$act')");
		if(!$result){
			return false;
		}else{
			return true;
		}

	}
	
	function factor_existe_evaluacion($cod_factor,$cod_pasantia){
		$link = new Conexion_postgre();
		
		$result = pg_query("SELECT COUNT(*)
							AS rows
							FROM evaluaciones
							WHERE cod_factor='$cod_factor' 
							AND cod_pasantia='$cod_pasantia'");
							
		if ($line = pg_fetch_assoc($result)) {
			if ($line['rows'] == 0) {
				return false;
			} else {
				return true;
			}
		}	
	}
	
	function get_puntuacion($cod_factor,$cod_pasantia){
			
		$result = pg_query("SELECT puntuacion
							FROM evaluaciones
							WHERE cod_factor='$cod_factor' 
							AND cod_pasantia='$cod_pasantia'");
							
		while($row = pg_fetch_row($result)){
			return $row[0];
		}
	}
	
	function get_observacion($cod_factor,$cod_pasantia){
		$result = pg_query("SELECT observacion
							FROM evaluaciones
							WHERE cod_factor='$cod_factor' 
							AND cod_pasantia='$cod_pasantia'");
							
		while($row = pg_fetch_row($result)){
			return $row[0];
		} 
	}
	
	function get_factores_id(){
		$link = new Conexion_postgre();
		
		$result = pg_query("SELECT cod_factor
							 FROM factores WHERE activo='s'
							 ORDER BY cod_factor ASC");
		$num = pg_num_rows($result);
		
		
		$i=0;
		
		if($num==0){
			echo "NO HAY FACTORES DE EVALUACION AGREGADOS";
		}else{
			$ids = array();
			while($i<$num){
				$cod_factor = pg_fetch_result($result, $i, "cod_factor");
				
				$ids[]=$cod_factor;
				
				$i++;
			}
		}
		return $ids;
	}

	function getFactores($cod_pasantia){
		$link = new Conexion_postgre();

		$result = pg_query("SELECT cod_factor,descripcion
							 FROM factores WHERE activo='s'
							 ORDER BY posicion");
		$num = pg_num_rows($result);
		
		
		$i=0;
		
		if($num==0){
			echo "<tr><td colspan='0'>NO HAY FACTORES DE EVALUACION AGREGADOS</td></tr>";
		}else{
			while($i<$num){
				$factor = pg_fetch_result($result, $i, "descripcion");
				$cod_factor = pg_fetch_result($result, $i, "cod_factor");
				
				$punt;
				$obs=strip_tags($_POST["ob".$cod_factor]);
				$bandera=0;
				
				if(factor_existe_evaluacion($cod_factor,$cod_pasantia)){
					$punt=get_puntuacion($cod_factor,$cod_pasantia);
					$obs=get_observacion($cod_factor,$cod_pasantia);
				}else{
					$punt=3;
					$obs="";
				}
				
				echo "<tr>";
					echo "<td>".$factor."</td>";
						if($punt==1){
							echo "<td><input type=\"radio\" checked name=\"".$cod_factor."\" value=\"1\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"2\"></td>";
							echo "<td><input type=\"radio\"  name=\"".$cod_factor."\" value=\"3\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"4\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"5\"></td>";	
							echo "<td><input type=\"text\" maxlength=\"150\" class=\"widearea\" name=\"ob".$cod_factor."\"";
							echo 'value="', $obs,'"';
							echo"></td>";
						}else 
						if($punt==2){
							echo "<td><input type=\"radio\"name=\"".$cod_factor."\" value=\"1\"></td>";
							echo "<td><input type=\"radio\" checked name=\"".$cod_factor."\" value=\"2\"></td>";
							echo "<td><input type=\"radio\"  name=\"".$cod_factor."\" value=\"3\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"4\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"5\"></td>";	
							echo "<td><input type=\"text\" maxlength=\"150\" class=\"widearea\" name=\"ob".$cod_factor."\"";
							echo 'value="', $obs,'"';
							echo"></td>";
						}else
						if($punt==3){
							echo "<td><input type=\"radio\"name=\"".$cod_factor."\" value=\"1\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"2\"></td>";
							echo "<td><input type=\"radio\" checked name=\"".$cod_factor."\" value=\"3\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"4\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"5\"></td>";
							echo "<td><input type=\"text\" maxlength=\"150\" class=\"widearea\" name=\"ob".$cod_factor."\"";
							echo 'value="', $obs,'"';
					echo"></td>";
						}else
						if($punt==4){
							echo "<td><input type=\"radio\"name=\"".$cod_factor."\" value=\"1\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"2\"></td>";
							echo "<td><input type=\"radio\"  name=\"".$cod_factor."\" value=\"3\"></td>";
							echo "<td><input type=\"radio\" checked name=\"".$cod_factor."\" value=\"4\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"5\"></td>";	
							echo "<td><input type=\"text\" maxlength=\"150\" class=\"widearea\" name=\"ob".$cod_factor."\"";
							echo 'value="', $obs,'"';
					echo"></td>";
						}else
						if($punt==5){
							echo "<td><input type=\"radio\"name=\"".$cod_factor."\" value=\"1\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"2\"></td>";
							echo "<td><input type=\"radio\"  name=\"".$cod_factor."\" value=\"3\"></td>";
							echo "<td><input type=\"radio\" name=\"".$cod_factor."\" value=\"4\"></td>";
							echo "<td><input type=\"radio\" checked name=\"".$cod_factor."\" value=\"5\"></td>";	
							echo "<td><input type=\"text\" maxlength=\"150\" class=\"widearea\" name=\"ob".$cod_factor."\"";
							echo 'value="', $obs,'"';
							echo"></td>";
						}
					
				echo "</tr>";
				
				$i++;
			}
			
		}
	}
	
	function factor_existe_pasantia($cod){
		$link = new Conexion_postgre();		
		$result = pg_query("SELECT COUNT(*) 
								AS rows
								FROM evaluaciones
								WHERE cod_factor='$cod'");
								
		if(!$result){
			echo "query did not execute";
		}
		
		if ($line = pg_fetch_assoc($result)) {
			if ($line['rows'] == 0) {
				return false;
			} else {
				return true;
			}
		}	
	}
	
	function delete_factor($cod_factor){
	
		$link = new Conexion_postgre();

		$result = pg_query("DELETE 
							FROM factores
							WHERE cod_factor=$cod_factor");
		
	}
	
	function borrarEvaluacion($cod,$cod_factor){		
		$result = pg_query("DELETE FROM evaluaciones WHERE cod_pasantia=$cod AND cod_factor=$cod_factor ");
	}
	function agregarEvaluacion($punt,$obs,$cod_factor,$cod_pasantia){
		$link = new Conexion_postgre();
		
		
		$result = pg_query("INSERT into evaluaciones (puntuacion,observacion, cod_factor, cod_pasantia) values ($punt,'$obs',$cod_factor,$cod_pasantia)");
		
		if(!$result){
			echo "ERROR AL AGREGAR EVALUACION";
		}
	}
	function nombreFactor($cod_factor){
		$link = new Conexion_postgre();
		
		$result = pg_query("SELECT descripcion FROM factores WHERE cod_factor=$cod_factor");
		
		while($row = pg_fetch_row($result)){
			echo $row[0];
		}
		
	}
	function buscarEvaluacion($cod){
		
	    $link = new Conexion_postgre();

		$result = pg_query("SELECT cod_factor, puntuacion, observacion
							 FROM evaluaciones WHERE cod_pasantia='$cod'");
		$num = pg_num_rows($result);
		
		
		$i=0;
		
		if($num==0){
			echo "<br><strong>ESTA PASANTIA NO HA SIDO EVALUADA</strong>
			<br><br><br>";
		}else{
			echo "<h2 class=\"whitebg\"  style=\"width:700px; margin: 0 auto; margin-bottom:20px;\" >Evaluacion de pasantia</h2>";
			$total;
				
				echo "<table class=\"tablas\" style=\" display:table; width:70%; \">";
				echo "<tr>";
				echo "<th width=40%>Factor</th>";
				echo "<th width=20%>Nota</th>";
				echo "<th width=40%>Observacion</th>";
				echo "</tr>";
				echo "<tbody>";
			
			while($i<$num){
				$puntos = pg_fetch_result($result, $i, "puntuacion");
				$obs = pg_fetch_result($result, $i, "observacion");
				$cod_factor = pg_fetch_result($result, $i, "cod_factor");
				$nota;
				
				echo "<tr><td>";
				echo nombreFactor($cod_factor);
				echo "</td>";
				if(($puntos)<=1){
					$nota="DEFICIENTE";
				}else if(($puntos)<=2){
					$nota="REGULAR";
				}else if(($puntos)<=3){
					$nota="BUENO";
				}else if(($puntos)<=4){
					$nota="MUY BUENO";
				}else if(($puntos)<=5){
					$nota="EXCELENTE";
				}
				echo "<td>".$nota."</td>";
				echo "<td>".$obs."</td></tr>";
				
				
				$total += $puntos;
				
				$i++;
			}
			$decision;
			if(($total/$i)<=1){
				$decision="DEFICIENTE";
			}else if(($total/$i)<=2){
				$decision="REGULAR";
			}else if(($total/$i)<=3){
				$decision="BUENO";
			}else if(($total/$i)<=4){
				$decision="MUY BUENO";
			}else if(($total/$i)<=5){
				$decision="EXCELENTE";
			}
			
			echo "</tbody>";			
			echo "<tfoot>";
			echo "<tr>";
        	echo "<td colspan=\"0\"> Resultado Final: ".$decision."</td>";
			echo"</tr>";
			echo "</tfoot>";
			echo "</table>";
			
		}
	}
	
	function crearRelacionPago($mes, $anio){
		$link = new Conexion_postgre();
		
		$result = pg_query("SELECT cedula_pasante,
							nivel_pasante,
							fecha_inicio,
							fecha_fin
							FROM pasantias 
							WHERE (extract (year FROM fecha_inicio)=$anio OR extract (year FROM fecha_fin)=$anio+1 )
							AND $mes BETWEEN extract (month FROM fecha_inicio) AND extract (month FROM fecha_fin) ");
		
		$num = pg_num_rows($result);
		
		
		$i=0;
		
		if($num==0){
			echo "<h2 style=\"width:700px; display:block; margin: 0 auto; margin-top:20px; margin-bottom:20px;\" class=\"whitebg\"> NO HAY PASANT&Iacute;AS PARA EL ".$mes."/".$anio."</h2>";
		}else{
			echo "<h2 style=\"width:700px; display:block; margin: 0 auto; margin-bottom:20px; margin-top:20px;\" class=\"whitebg\">Relaci&oacute;n de Pago del ".$mes;
			echo "/".$anio. "</h2>";
			
			echo "<table class=\"tablas\" style=\"display:table; width:100%; text-align:left; \">";
			echo "<tr>";
			echo "<th width=10%>C&eacute;dula</th>";
			echo "<th>Nombres</th>";
			echo "<th>Apellidos</th>";
			echo "<th width=5%>F. Inicio</th>";
			echo "<th width=5%>F. Fin</th>";
			echo "<th>Nivel</th>";
			echo "<th>Remuneraci&oacute;n</th>";
			echo "<th>Tel&eacute;fono(s)</th>";
			echo "</tr>";
			$totalMes;
			while($i<$num){
				$cedu = pg_fetch_result($result, $i, "cedula_pasante");
				
				$datos_pasante = (datosPasante($cedu,'nombres','apellidos'));
				$fecha_inicio = pg_fetch_result($result, $i, "fecha_inicio");
				$fecha_fin = pg_fetch_result($result, $i, "fecha_fin");
				$nivel_pasante = pg_fetch_result($result, $i, "nivel_pasante");
				
				echo "<tr>";
				echo "<td>".$cedu."</td>";
				echo "<td>".$datos_pasante['nombres']."</td>";
				echo "<td>".$datos_pasante['apellidos']."</td>";
				echo "<td>".date("d-m-Y" ,(strtotime($fecha_inicio)))."</td>";
				echo "<td>".date("d-m-Y" ,(strtotime($fecha_fin)))."</td>";	
				echo "<td>",get_nombre_nivel($nivel_pasante)."</td>";
				echo "<td>",get_remuneracion($nivel_pasante)."</td>";
				echo "<td>".getTelefonos($cedu)."</td>";
				
				$totalMes+=get_remuneracion($nivel_pasante);
				echo "</tr>";
				
				$i++;
			}
			echo "<tfoot >";
			echo "<tr ><td></td><td></td><td></td><td></td><td></td><td style=\"text-align:right;\">Total</td><td colspan=\"0\">";
			echo "<span id=\"total\">".$totalMes."</span> Bs";
			echo "</tr></td>";
			echo "</tfoot>";
			echo "</table>";
		}
		
	}		
	
	function costoEjecutado($anio){
		$link = new Conexion_postgre();
		
		$result = pg_query("SELECT cedula_pasante,fecha_inicio, fecha_fin, nivel_pasante
							FROM pasantias
							WHERE (extract (year FROM fecha_inicio)=$anio OR extract (year FROM fecha_fin) = $anio)");
		
		$num = pg_num_rows($result);
				
		$i=0;
		
		if($num==0){
			echo 'no hay pasantias registradas en el a&ntilde;o ',$anio,' por lo tanto:';
			return 0;
		}else{
		$costoEjecutado;
			while($i<$num){
				$nivel_pasante = pg_fetch_result($result, $i, "nivel_pasante");				
				
				$costoEjecutado+=get_remuneracion($nivel_pasante);
				
				$i++;
			}
			
			return $costoEjecutado;
		}
	}
	
	function buscarExistenciaAdmin($cedula){
		$link = new Conexion_postgre();
		
		$result=pg_query("SELECT COUNT(id_usuario) 
						AS rows
						FROM usuarios
						WHERE id_usuario='$cedula'");
						
		if ($line = pg_fetch_assoc($result)) {
			if ($line['rows'] > 0 ) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	function buscarExistenciaIntranet($cedula){
		$link = new Conexion_Intranet();
		
		$result=pg_query("SELECT COUNT(cedula) 
						AS rows
						FROM validar 
						WHERE cedula='$cedula'");
						
		if ($line = pg_fetch_assoc($result)) {
			if ($line['rows'] > 0 ) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	function nuevo_admin($cedula){
		$link = new Conexion_postgre();

		$result = pg_query("INSERT INTO usuarios
						  (id_usuario,nivel)
						   VALUES('$cedula',2)");
	}
	

	
	
	
	
	



?>
