<?php
require('inc/header.php');

if (isset($_GET['noscript_login']))
{
	$header -> setArg('title', 'Log in');
}
else if (isset($_GET['noscript_register']))
{
	$header -> setArg('title', 'Register');
}
else
{
	header('Location: /');
}
$header -> output();

echo '<p><strong>It is recommended that you configure your browser to allow javascript on this website.</strong></p>';  
?>
