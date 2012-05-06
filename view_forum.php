<?php
require('inc/header.php');

// Queries DB and loads template to display a given forum.

$forum_query = $dbh -> prepare('SELECT forum_name, topic_count FROM forums WHERE forum_id = :forum_id');
$forum_query -> execute(array(':forum_id' => $_GET['id']));
$forum_result = $forum_query -> fetch();

$header -> setArg('title', $forum_result['forum_name']);
$header -> output();

$topic_index = new Template(TEMPLATE_DIR . '/view_forum.tpl.php', array('forum' => $_GET['id'], 'page_count' => ceil($forum_result['topic_count']/TOPICS_PER_PAGE)));
$topic_query = $dbh -> prepare('SELECT topic_id, topic_name, topic_creator, topic_date, topic_pages, reply_count, last_reply, last_reply_author FROM topics WHERE topic_forum = :forum_id ORDER BY last_reply DESC LIMIT ' . (($_GET["page"] - 1) * TOPICS_PER_PAGE) . ', ' . TOPICS_PER_PAGE);

$topic_query -> execute(array(':forum_id' => $_GET['id']));
$topic_result = $topic_query -> fetchAll(PDO::FETCH_ASSOC);

$topic_index -> setArg('forum_name', $forum_result['forum_name']);
$topic_index -> setArg('topics', $topic_result);
$topic_index -> setArg('reply_count', $topic_query -> rowCount());
$topic_index -> output();
include('inc/footer.php');
?>
