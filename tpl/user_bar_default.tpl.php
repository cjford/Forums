<div id = 'form_buttons' class = '<?php echo ($this->args['type'] == 'default' ? 'shown_ib' : 'hidden'); ?>' >
	<div id = 'login_button' onclick = "toggleForm('login'); return false;" href = 'noscript.php?noscript_login'>
		<span class = 'hidden'> Log In </span>
	</div> 


	<div id = 'register_button' onclick = "toggleForm('register');return false;" href = 'noscript.php?noscript_register'>
		<span class = 'hidden'> Register </span>
	</div>
</div>

<div id = 'register_form' class = '<?php echo ($this->args['type'] == 'register' ? 'shown_ib' : 'hidden'); ?>' >
	<a class = 'form_back' onClick = "toggleForm('default');"> << </a>
		<form class = 'user_bar_form' action = 'process_login.php' method = 'POST'>
			Username: <input type = 'text' name = 'username' />
			Email: <input type = 'text' name = 'email' />
			Password: <input type = 'password' name = 'password' />
			Confirm Password: <input type = 'password' name = 'password_confirm' />
			<input type = 'hidden' name = 'curr_url' value = <?php echo $this->args['curr_url'];?> />
			<input type = 'hidden' name = 'register' />
		<input type = 'submit' value = 'Submit' onClick = "alert('Registration is currently disabled for display purposes.')">
		</form>
</div>

<div id = 'login_form' class = '<?php echo ($this->args['type'] == 'login' ? 'shown_ib' : 'hidden'); ?>' >
<a class = 'form_back' onClick = "toggleForm('default');"> << </a>
	<form class = 'user_bar_form' action = 'process_login.php' method = 'POST'> 
		 Username: <input type = 'text' name = 'username' />
		 Password: <input type = 'password' name = 'password' />
		 <input type = 'hidden' name = 'curr_url' value = <?php echo $this->args['curr_url'];?> />
		 <input type = 'hidden' name = 'login' />
		<input type = 'submit' value = 'Submit' />
	 </form>
</div>

<div id = 'nav_items' class = 'right <?php echo ($this->args['type'] == 'default' ? 'shown_ib' : 'hidden'); ?>' >
	<form id = 'dropdown_nav' class = 'right' action = '' method = 'POST'>
	Jump to Forum:
		<select name = 'forum_select'>
		<option>(NYI)</option>
		<?php foreach($this -> args['forums'] as $forum): ?>
		<option value = <?php echo $forum['forum_id']; ?> > <?php echo $forum['forum_name']; ?> </option>
		<?php endforeach; ?>
		</select>
	</form>

	<form id = 'search_box' class = 'right'>
		Search: <input id = 'search_input' type = 'text' readonly = 'readonly' value = '(NYI)'/>
	</form>
</div>
