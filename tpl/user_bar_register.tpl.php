<a class = 'form_back' onClick = "toggleForm('default');")> << </a> 
<form action = 'process_login.php' method = 'POST'> 
	Username: <input type = 'text' name = 'username'/>
	Email: <input type = 'text' name = 'email'/>
	Password: <input type = 'password' name = 'password'/> 
	Confirm Password: <input type = 'password' name = 'password_confirm'/> 
	<input type = 'hidden' name = 'curr_url' value = '<?php echo $this->args['curr_url']; ?>' />
	<input type = 'hidden' name = 'register'/>
	<input type = 'submit' value = 'Submit' onClick = "alert('Registration is currently disabled for display purposes.');"/> 
</form>
