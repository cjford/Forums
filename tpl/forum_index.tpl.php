<div id = 'preview_wrapper'>
<?php foreach ($this -> args['forums'] as $forum): ?>
	<div id = '<?php echo $forum['forum_id']; ?>' class = 'preview_box'>
	<a  onclick = 'forumToggle(<?php echo $forum['forum_id']; ?>)' class = 'toggle_arrow left'> > </a>
		<a class = 'preview_link left' href = '<?php echo HOME_URL; ?>/view_forum.php?id=<?php echo $forum['forum_id']; ?>&page=1'> <?php echo $forum['forum_name']; ?></a>
		<table id = '<?php echo $forum['forum_id']; ?>_topics' class = 'hidden'>
			<tr>
				<th> Topic </th>
				<th> Author </th>
				<th> Created </th>
				<th> Replies </th>
				<th> Last Reply </th>
			</tr>
		<?php $x = 0; foreach ($this -> args['topics'][$forum['forum_id']] as $topic): ?>
			<tr class = "<?php echo ($x % 2 == 0 ? 'even_row' : 'odd_row')?>">
				<td class = 'topic_name'>
					<a href = 'view_topic.php?id=<?php echo $topic['topic_id']?>&page=1'>  <?php echo $topic['topic_name']; ?>  </a>
					[<?php for($i = 1 ; $i <= intval($topic['topic_pages']); $i++): ?>
						<a href = '<?php echo HOME_URL; ?>/view_topic.php?id=<?php echo $topic['topic_id']; ?>&page=<?php echo $i; ?>'><?php echo $i; ?></a>
					<?php endfor; ?>]
				</td>
				<td><a href = 'view_user.php?username=<?php echo $topic['topic_creator']?>'>  <?php echo $topic['topic_creator']; ?>  </a>
				<td> <?php echo $topic['topic_date']; ?> </td>
				<td> <?php echo $topic['reply_count']; ?> </td>
				<td> <?php echo $topic['last_reply'] . ' by ' . $topic['last_reply_author']; ?> </td> 
			</tr>
		<?php $x++; endforeach; ?>
		
		</table>
		<span id = '<?php echo $forum['forum_id']; ?>_info' class = 'forum_info'> <?php echo $forum['forum_info']; ?> </span>
	</div>
<?php endforeach;?>
</div>
