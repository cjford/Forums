<?php 

session_start();
require('/home/cjford/.forum_config.php');

unset($_SESSION['logged_in']);
unset($_SESSION['username']);
session_destroy();
header('Location:' . HOME_URL)
?>
