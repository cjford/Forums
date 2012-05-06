<h2> Posting in <a href = 'view_forum.php?id=<?php echo $this -> args['forum_id']; ?>&page=1'> <?php echo $this -> args['forum_name']; ?> </a> </h2>
<form action = 'process_topic.php' method = 'POST'>
	Title:<br/> 
	<input name = 'topic_title' type = 'text' /><br/>
	Post: <br/>
	<textarea name = 'topic_content' type = 'text' rows = '10' cols = '90'></textarea>
	<input type = 'hidden' name = 'forum_id' value = <?php echo $this -> args['forum_id']; ?> /><br/>
	<input type = 'submit' value = 'Create Topic' />
</form>	
<span class = 'error'>
	<?php foreach(($this -> args['errors']) as $error): ?>
	<br/> <?php echo $error; ?>		
	<?php endforeach; ?>
</span>
