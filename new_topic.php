<?php
require('inc/header.php');

// Loads template to display input form for creating a new topic.

$header -> setArg('title', 'New Topic');
$header -> output();

$error_array = array();
if (isset($_GET['login_error']))
{
	array_push($error_array, 'You need to log in to do that');
}
if (isset($_GET['content_empty']))
{
	array_push($error_array, 'Topic must contain content');
}
if (isset($_GET['title_empty']))
{
	array_push($error_array, 'You must enter a title for your topic');
}

$forum_query = $dbh -> query('SELECT forum_name FROM forums WHERE forum_id = ' . $_GET['id']);
$forum_result = $forum_query -> fetch();

$new_topic = new Template(TEMPLATE_DIR . '/new_topic.tpl.php', array('forum_id' => $_GET['id'], 'forum_name' => $forum_result['forum_name'], 'errors' => $error_array));
$new_topic -> output();?>
