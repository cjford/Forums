<?php
session_start();
require_once('/home/cjford/.forum_config.php');
require_once(INCLUDE_DIR . 'connect.php');
require_once(INCLUDE_DIR . 'template.class.php');

/*
Header included in every page. Contains other essential include files.
Responsible for loading template to display user login/register bar (and errors).
Header template is loaded here, but only output on each individual page, in order 
allow setting of page titles.
*/

$error_array = array();

if (isset($_SESSION['logged_in']))
{
	$user_bar = new Template(TEMPLATE_DIR . '/user_bar_logged.tpl.php', array('curr_url' => $_SERVER['REQUEST_URI'])); 
}
else if (isset($_GET['login_fail']))
{	
	$user_bar = new Template(TEMPLATE_DIR . '/user_bar_default.tpl.php', array('curr_url' => trim($_SERVER['REQUEST_URI'], '/forums/'), 'type' => 'login'));

	if (isset($_GET['blank_fail']))
	{
		array_push($error_array, 'Please fill in all fields');
	}

	if (isset($_GET['name_fail']) && !isset($_GET['blank_fail']))
	{
		array_push($error_array, 'Incorrect Username');
	}

	if (isset($_GET['password_fail']) && !isset($_GET['blank_fail']) && !isset($_GET['name_fail']))
	{
		array_push($error_array, 'Incorrect Password');
	}
	
}
else if (isset($_GET['register_fail']))
{
	$user_bar = new Template(TEMPLATE_DIR . '/user_bar_default.tpl.php', array('curr_url' => trim($_SERVER['REQUEST_URI'], '/forums/'), 'type' => 'register'));
	
	if (isset($_GET['blank_fail']))
	{
		array_push($error_array, 'Please fill in all fields');
	}

	if (isset($_GET['name_fail']) && !isset($_GET['blank_fail']))
	{
		array_push($error_array, 'Username or email has already been registered');
	}
	
	if (isset($_GET['email_fail']) && !isset($_GET['blank_fail']))
	{
		array_push($error_array, 'Invalid email');
	}

	if (isset($_GET['password_fail']) && !isset($_GET['blank_fail']))
	{
		array_push($error_array, 'Passwords do not match');
	}

}
else
{
	if (isset($_GET['noscript_login']))
	{
		$user_bar = new Template(TEMPLATE_DIR . '/user_bar_login.tpl.php', array('curr_url' => trim($_SERVER['REQUEST_URI'], '/forums/')));
	}
	else if (isset($_GET['noscript_register']))
	{
		$user_bar = new Template(TEMPLATE_DIR . '/user_bar_register.tpl.php', array('curr_url' => trim($_SERVER['REQUEST_URI'], '/forums/')));
	}
	else
	{
		$user_bar = new Template(TEMPLATE_DIR . '/user_bar_default.tpl.php', array('curr_url' => trim($_SERVER['REQUEST_URI'], '/forums/'), 'type' => 'default'));
	}
}

$forum_query = $dbh -> prepare('SELECT forum_name, forum_id FROM forums');
$forum_query -> execute();
$forum_result = $forum_query -> fetchAll();
$user_bar -> setArg('forums', $forum_result);

$header = new Template(TEMPLATE_DIR . '/header.tpl.php', array('title' => 'Forums', 'user_bar' => $user_bar, 'errors' => $error_array));

?>
