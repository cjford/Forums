<?php
session_start();
require('/home/cjford/.forum_config.php');
require(INCLUDE_DIR . 'connect.php');

/* 
On attempted Login/Register, form input is sent to this page via $_POST.
It is processed and redirected to the original page with the appropriate 
error/success info as $_GET values.
*/

if (isset($_POST['login']))
{
	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	$user_query =	$dbh -> prepare('SELECT username, password FROM users WHERE username = :username');
	$user_query -> execute(array(':username' => $username));
	$user_result = $user_query -> fetch();
	
	if ($username == '' || $password == sha1(''))
	{
		$login_fail = true;
		$blank_fail = true;
	}

	if (!$user_result)
	{
		$login_fail = true;
		$name_fail = true;
	}

	if ($user_result['password'] != $password)
	{
		$login_fail = true;
		$password_fail = true;
	}
	
	if (isset($login_fail))
	{	
		// f_ indicates end of current page-specific $_GET values and beginning of login error $_GET values
		$url = explode('f_', $_POST['curr_url']);		
		$redirect_addr = HOME_URL . '/' . trim($url[0], '&/?');
		$redirect_addr .= (strpos($redirect_addr, '?') ? '&f_&login_fail' : '?f_&login_fail');
	
		if (isset($blank_fail)) {$redirect_addr .= '&blank_fail=1';}
		if (isset($name_fail)) {$redirect_addr .= '&name_fail=1';}
		if (isset($password_fail)) {$redirect_addr .= '&password_fail=1';}
		header('Location:' . $redirect_addr);
	}
	else
	{
		$_SESSION['logged_in'] = true;
		$_SESSION['username'] = $username;
	
		$url = explode('f_', $_POST['curr_url']);	
		$redirect_addr = HOME_URL . '/' . trim($url[0], '&/?');
		header('Location:' . $redirect_addr);
	}
}
else if (isset($_POST['register']))
{
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = sha1($_POST['password']);
	$password_confirm = sha1($_POST['password_confirm']);
	
	$user_query = $dbh -> prepare('SELECT username, email, password FROM users WHERE username = :username OR email = :email');
	$user_query -> execute(array(':username' => $username, ':email' => $email));
	$user_result = $user_query -> fetch(); 

	if ($username == '' || $email == '' || $password == sha1('') || $password_confirm == sha1(''))
	{
		$register_fail = true;
		$blank_fail = true;
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$register_fail = true;
		$email_fail = true;
	}
			
	if ($user_result)
	{
		$register_fail = true;
		$name_fail = true;
	}
	
	if ($password != $password_confirm)  
	{
		$register_fail = true;
		$password_fail = true;
	}

	if (isset($register_fail))
	{	
		// f_ indicates end of current page-specific $_GET values and beginning of login error $_GET values
		$url = explode('f_', $_POST['curr_url']);
		$redirect_addr = HOME_URL . '/' . trim($url[0], '&/?');
		$redirect_addr .= (strpos($redirect_addr, '?') ? '&f_&register_fail' : '?f_&register_fail');

		if (isset($blank_fail)) {$redirect_addr .= '&blank_fail=1';}
		if (isset($name_fail)) {$redirect_addr .= '&name_fail=1';}
		if (isset($email_fail)) {$redirect_addr .= '&email_fail=1';}
		if (isset($password_fail)) {$redirect_addr .= '&password_fail=1';}
		header('Location:' . $redirect_addr);
	}
	else 
	{
		/* Registration Disabled

		$user_insert = $dbh -> prepare('INSERT INTO users (username, email, password, reg_date, post_count, privileges) VALUES (:username, :email, :password, CURDATE(), 0, 0)');
		$user_insert -> execute(array(':username' => $username, ':email' => $email, ':password' => $password));

		$_SESSION['logged_in'] = true;
		$_SESSION['username'] = $username;
		*/

		$url = explode('f_', $_POST['curr_url']);
		$redirect_addr = HOME_URL . '/' . trim($url[0], '&/?');
		$redirect_addr .= (strpos(trim($_POST['curr_url'], '/')) > 0 ? '&register_success' : '?register_success');
		header('Location:' . $redirect_addr);

		
	}				
}
else
{	
	// In normal website flow, this shouldn't be reached.	
	header('Location:' . HOME_URL);
}
?>
