<?php
	include 'header.php';
	if(!logged_in()){
		header('Location: index.php');
		exit();
	}
	include 'footer.php';
?>