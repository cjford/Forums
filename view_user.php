<?php 
require('inc/header.php');

// Queries DB and loads template to display a given user profile.

$user_query = $dbh -> prepare('SELECT username, reg_date, post_count FROM users WHERE username = :username');
$user_query -> execute(array(':username' => $_GET['username']));
$user_result = $user_query -> fetch();

$header -> setArg('title', 'User Profile: ' . $user_result['username']);
$header -> output();

$view_user_template = new Template(TEMPLATE_DIR . '/view_user.tpl.php', array('username' => $_GET['username'], 'reg_date' => $user_result['reg_date'], 'post_count' => $user_result['post_count']));
$view_user_template -> output();
?>
