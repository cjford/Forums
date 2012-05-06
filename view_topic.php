<?php
require('inc/header.php');

// Queries DB and loads template to display a given topic.

$topic_query = $dbh -> prepare('SELECT topic_name, topic_pages, topic_forum from topics WHERE topic_id = :topic_id');
$topic_query -> execute(array(':topic_id' => $_GET['id']));
$topic_result = $topic_query -> fetch();

$header -> setArg('title', $topic_result['topic_name']);
$header -> output();

$topic_template = new Template(TEMPLATE_DIR . '/view_topic.tpl.php', array());
$error_array = array();

if (isset($_GET['login_error']))
{
	array_push($error_array, 'You need to log in to do that');
}
if (isset($_GET['blank_error']))
{
	array_push($error_array, 'Post must contain content');
}
if (isset($_GET['cap_error']))
{
	array_push($error_array, 'This post has reached the maxiumum allowed number of replies');
}

$post_query = $dbh -> prepare('SELECT * FROM posts WHERE post_topic= :id AND post_page = :page ORDER BY post_date LIMIT ' . POSTS_PER_PAGE);
$post_query -> execute(array(':id' => $_GET['id'], ':page' => $_GET['page']));
$post_result = $post_query -> fetchAll();

$forum_query = $dbh -> prepare('SELECT forum_name FROM forums WHERE forum_id = :forum_id');
$forum_query -> execute(array(':forum_id' => $topic_result['topic_forum']));
$forum_result = $forum_query -> fetch();

$topic_template -> setArg('posts', $post_result);
$topic_template -> setArg('errors', $error_array);
$topic_template -> setArg('forum_name', $forum_result['forum_name']);
$topic_template -> setArg('topic_forum', $topic_result['topic_forum']);
$topic_template -> setArg('topic_id', $_GET['id']);
$topic_template -> setArg('topic_title', $topic_result['topic_name']);
$topic_template -> setArg('topic_pages', $topic_result['topic_pages']);
$topic_template -> output();

include('inc/footer.php');
?>
