<h1><?php echo $this -> args['forum_name']; ?></h1>
<div id = 'new_post_button'><a href = 'new_topic.php?id=<?php echo $_GET['id']; ?>'> New Topic </a></div>
<table id = 'post_index'>
	<tr>
		<th> Topic </th>
		<th> Author </th>
		<th> Created </th>
		<th> Replies </th>
		<th> Last Reply </th>
	</tr>

<br/>
<ul class = 'page_nav'>
	[<?php for($i = 1; $i <= $this -> args['page_count']; $i++): ?>
	<li>	
		<a href = '<?php echo HOME_URL; ?>/view_forum.php?id=<?php echo $this -> args['forum']; ?>&page=<?php echo $i; ?>'><?php echo $i; ?></a>
	</li>
	<?php endfor; ?>]
</ul>
	
<?php $x = 0; foreach($this -> args['topics'] as $topic): ?>
<tr class = "<?php echo ($x % 2 == 0 ? 'even_row' : 'odd_row')?>">
	<td class = 'topic_name'>
		<a href = 'view_topic.php?id=<?php echo $topic['topic_id']; ?>&page=1'>  <?php echo $topic['topic_name']; ?>  </a>
		[<?php for($i = 1 ; $i <= intval($topic['topic_pages']); $i++): ?>
			<a href = '<?php echo HOME_URL; ?>/view_topic.php?id=<?php echo $topic['topic_id']; ?>&page=<?php echo $i; ?>'><?php echo $i; ?></a>
		<?php endfor; ?>]
	<td><a href = 'view_user.php?username=<?php echo $topic['topic_creator']?>'>  <?php echo $topic['topic_creator']; ?>  </a>
	<td> <?php echo $topic['topic_date']; ?> </td>
	<td> <?php echo $topic['reply_count']; ?> </td>
	<td class = 'last_reply'> <?php echo $topic['last_reply'] . ' by ' . $topic['last_reply_author']; ?> </td>
</tr>
<?php $x++; endforeach; ?>

</table>

<ul class = 'page_nav'>
[<?php for($i = 1; $i <= $this -> args['page_count']; $i++): ?>
	<li>	
		<a href = '<?php echo HOME_URL; ?>/view_forum.php?id=<?php echo $this -> args['forum']; ?>&page=<?php echo $i; ?>'><?php echo $i; ?></a>
	</li>
<?php endfor; ?>]
</ul>

</div>

