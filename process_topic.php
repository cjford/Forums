<?php
session_start();
require('/home/cjford/.forum_config.php');
require(INCLUDE_DIR . 'connect.php');

/* 
On attempted creation of a new forum topic, form input is sent to this page via $_POST.
It is processed and redirected to the original page(in the case of failure) or the new 
topic's page(in the case of success) with the appropriate error/success info as $_GET values.
*/

if(isset($_POST['forum_id']))
{	
	if(!isset($_SESSION['logged_in']))
	{
		$topic_fail = true;
		$login_error = true;
	}

	if(empty($_POST['topic_content']))
	{
		$topic_fail = true;
		$content_empty = true;
	}

	if(empty($_POST['topic_title']))
	{
		$topic_fail = true;
		$title_empty = true;
	}
	
	
	if(!isset($topic_fail))
	{
		$dbh -> beginTransaction();

		$timestamp_query = $dbh -> query('SELECT CURRENT_TIMESTAMP');
		$timestamp_result = $timestamp_query -> fetch();
		$timestamp = $timestamp_result['CURRENT_TIMESTAMP'];
		
	

		$topic_insert = $dbh -> prepare('INSERT INTO topics (topic_name, topic_creator, topic_forum, last_reply, last_reply_author) VALUES (:topic_name, :topic_creator, :topic_forum, :last_reply, :last_reply_author)');
		$topic_insert -> execute(array(':topic_name' => $_POST['topic_title'], ':topic_creator' => $_SESSION['username'], ':topic_forum' => $_POST['forum_id'], ':last_reply' => $timestamp, ':last_reply_author' => $_SESSION['username']));
		$topic_id = $dbh -> lastInsertId();

		$post_insert = $dbh -> prepare('INSERT INTO posts (post_content, post_creator, post_topic, post_page) VALUES (:post_content, :post_creator, :post_topic, :post_page)');
		$post_insert -> execute(array(':post_content' => $_POST['topic_content'], ':post_creator' => $_SESSION['username'], ':post_topic' => $topic_id, 'post_page' => 1));

		$user_update = $dbh -> prepare('UPDATE users SET post_count = (post_count + 1) WHERE username = :username');
		$user_update -> execute(array(':username' => $_SESSION['username']));

		$forum_update = $dbh -> query('UPDATE forums SET topic_count = (topic_count + 1) WHERE forum_id = ' . $_POST['forum_id']);
		$dbh -> commit();

		header('Location:' . HOME_URL . '/view_topic.php?id=' . $topic_id . '&page=1');
	}
	else
	{
		$redirect_addr = HOME_URL . '/new_topic.php?id=' . $_POST['forum_id'];
		if (isset($login_error)) {$redirect_addr .= '&login_error=1';}
		if (isset($content_empty)) {$redirect_addr .= '&content_empty=1';}
		if (isset($title_empty)) {$redirect_addr .= '&title_empty=1';}
		header('Location:' . $redirect_addr);
	} 
}
?>
