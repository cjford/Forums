<?php
require('inc/header.php');

// Entry point of website. Queries DB and loads template to display all forums and topic previews.
//Globals defined in config file outside of web root

$header -> setArg('title', 'Forum Index');
$header -> output();

$forum_query = $dbh -> prepare('SELECT forum_id, forum_name, forum_info FROM forums ORDER BY forum_name');
$forum_query -> execute();
$forum_result = $forum_query -> fetchAll(PDO::FETCH_ASSOC);

$topic_query = $dbh -> prepare('SELECT topic_id, topic_name, topic_creator, topic_date, topic_forum, topic_pages, reply_count, last_reply, last_reply_author FROM topics WHERE topic_forum = :forum_id ORDER BY topic_date DESC LIMIT ' . PREVIEW_LIMIT); 
foreach($forum_result as $forum)
{	
	$topic_query -> execute(array(':forum_id' => $forum['forum_id']));
	$topic_result = $topic_query -> fetchAll(PDO::FETCH_ASSOC);
	$topics[$forum['forum_id']] = $topic_result; 
}

$forum_index = new Template(TEMPLATE_DIR . '/forum_index.tpl.php', array('forums' => $forum_result, 'topics' => $topics));
$forum_index -> output();

include('inc/footer.php');
?>
