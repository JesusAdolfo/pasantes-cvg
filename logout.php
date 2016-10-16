<?php
session_start();
unset($_SESSION['login_usuario']);
session_destroy();
header('Location: index.php');
exit();
?>
