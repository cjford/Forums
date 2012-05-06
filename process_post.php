<?php
session_start();
require('/home/cjford/.forum_config.php');
require(INCLUDE_DIR . 'connect.php');

/* 
On attempted creation of a new forum post, form input is sent to this page via $_POST.
It is processed and redirected to the original page(in the case of failure) or the new 
post's page(in the case of success) with the appropriate error/success info as $_GET values.
*/

$topic_query = $dbh -> prepare('SELECT reply_count, topic_pages FROM topics WHERE topic_id = :topic_id');
$topic_query -> execute(array(':topic_id' => $_POST['topic_id']));
$topic_result = $topic_query -> fetch();

$post_page = (integer)(intval($topic_result['reply_count'] + 1) / intval(POSTS_PER_PAGE)) + 1;

if (!isset($_SESSION['logged_in']))
{
	$post_fail = true;
	$login_error = true;
}

if (empty($_POST['reply_input']))
{	
	$post_fail = true;
	$blank_error = true;
}

if ($topic_result['reply_count'] == POSTS_PER_TOPIC)
{
	$post_fail = true;
	$cap_error = true;
}

if (isset($post_fail))
{
	$redirect_addr = HOME_URL . '/view_topic.php?&id=' . $_POST['topic_id'] . '&page=' . $post_page;
	if (isset($blank_error)){$redirect_addr .= '&blank_error=1';}
	if (isset($login_error)){$redirect_addr .= '&login_error=1';}	
	if (isset($cap_error)){$redirect_adder .= '&cap_error';}
	header('Location:' . $redirect_addr);	

}
else
{  
	if(intval($post_page) != intval($topic_result['topic_pages'])) {$new_page = true;}

	$dbh -> beginTransaction();

	$post_insert = $dbh -> prepare('INSERT INTO posts (post_content, post_creator, post_topic, post_page) VALUES (:content, :username, :id, :page)');
	$post_insert -> execute(array(':content' => $_POST['reply_input'], ':username' => $_SESSION['username'], ':id' => $_POST['topic_id'], ':page' => $post_page));

	$topic_update = $dbh -> prepare('UPDATE topics SET reply_count = (reply_count+1), last_reply = CURRENT_TIMESTAMP, last_reply_author = :username WHERE topic_id = :id');
	$topic_update -> execute(array(':id' => $_POST['topic_id'], ':username' => $_SESSION['username']));
	
	if (isset($new_page))
	{
		$dbh -> query('UPDATE topics SET topic_pages = (topic_pages + 1)');
	}
	$user_update = $dbh -> prepare('UPDATE users SET post_count = (post_count + 1) WHERE username = :username');
	$user_update -> execute(array(':username' => $_SESSION['username']));

	$dbh -> commit();
	
	unset($new_page);
	header('Location:' . HOME_URL . '/view_topic.php?id=' . $_POST['topic_id'] . '&page=' . $post_page);
}
?>
