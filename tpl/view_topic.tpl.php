<div id = 'topic_wrapper'>

	<div id = 'top_bar'>
		<h2>
			<a href = 'view_forum.php?id=<?php echo $this -> args['topic_forum']; ?>&page=1'><?php echo $this -> args['forum_name']; ?></a> >> 
			<?php echo $this -> args['topic_title']; ?>
		</h2> 

		<ul class = 'page_nav'>
			[<?php for($i = 1; $i <= $this -> args['topic_pages']; $i++): ?>
			<li>	
				<a href = '<?php echo HOME_URL; ?>/view_topic.php?id=<?php echo $this -> args['topic_id']; ?>&page=<?php echo $i; ?>'><?php echo $i; ?></a>
			</li>
			<?php endfor; ?>]
		</ul>
	</div> 
	<?php foreach ($this -> args['posts'] as $post): ?>
	<div class = 'post_wrapper'> 
		<div class = 'post_userbar'>
			<span class = 'left'> <a class = 'username_link' href = '/view_user.php?username=<?php echo $post['post_creator']; ?>'><?php echo $post['post_creator']; ?></a></span>
			<span class = 'right'> <?php echo $post['post_date']; ?> </span>
		</div>
		<div class = 'post_content'> <?php echo $post['post_content']; ?> </div>
	</div>	
	<?php endforeach; ?>
	</table>

	<div id = 'bottom_bar'>
		<ul class = 'page_nav'>
			[<?php for($i = 1; $i <= $this -> args['topic_pages']; $i++): ?>
			<li>
				<a href = '<?php echo HOME_URL; ?>/view_topic.php?id=<?php echo $this -> args['topic_id']; ?>&page=<?php echo $i; ?>'><?php echo $i; ?></a>
			</li>
			<?php endfor; ?>]
		</ul><br/>
	</div>
</div>

Post a reply:
<div id = 'reply_box'>
	<span class = 'error'>
		<?php foreach($this -> args['errors'] as $error):?>
		<br/> <?php echo $error; ?>
		<?php endforeach; ?>
	</span>

	<form action = 'process_post.php' method = 'POST'>
		<textarea name = 'reply_input' type = 'text' rows = '10' cols = '90'></textarea>
		<input type = 'hidden' name = 'topic_id' value = '<?php echo $this -> args['topic_id']; ?>' /><br/>
		<input type = 'submit' value = 'Create Post' />
	</form>
</div>
