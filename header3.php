<?session_start();ob_start(); include 'queries/user_func.php';?>
<!DOCTYPE html>
<html>
	
	<head>
		<title>Control de Pasantias</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<!-- /* JQuery  */ -->
		<script src="js/jsDate/jquery-1.9.1.js"></script>
		<!-- Para confirmar el borrado de -->
		<script src="jquery.confirm/jquery.confirm.js"></script>		
	  
		<!-- /* JQuery UI */ -->
		<script src="js/jsDate/jquery-ui-1.10.1.custom.js"></script>
		<script src="js/jsDate/jquery.ui.datepicker-es.js"></script>
		
		<!-- /* Hojas de Estilo */ -->
		<link rel="stylesheet" href="css/estilos.css" type="text/css" />  <!-- referencia a la hoja de estilos -->
		<link rel="stylesheet" type="text/css" href="jquery.confirm/jquery.confirm.css" />
		<link href="js/css/startDate/rojo/jquery-ui-1.10.3.custom.css" rel="stylesheet" />
		<link rel="stylesheet" href="css/autosuggest.css">
				
	</head>
	<body>
		<?php if(!logged_in()){
					header('Location: index.php');
					exit();
				}
		?>
		<div id="topbar">
			<ul id="topbar_menu">
				<li id="logo"><a href="plataforma.php"></a></li>
				<li id="titulo1"> <a href="#">Sistema de Control de Pasantias </a></li>
			</ul>
		</div>