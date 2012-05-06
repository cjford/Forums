<a class = 'form_back' onClick = "toggleForm('default');"> << </a>
<form action = 'process_login.php' method = 'POST'>
	Username: <input type = 'text' name = 'username' /> 
	Password: <input type = 'password' name = 'password' />
	<input type = 'hidden' name = 'curr_url' value = '<?php echo $this->args['curr_url']; ?>' />
	<input type = 'hidden' name = 'login' />
	<input type = 'submit' value = 'Submit' />
</form>
