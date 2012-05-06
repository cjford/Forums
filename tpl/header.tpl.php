<html>
<head>
	<title><?php echo $this -> args['title']; ?></title>
	<link rel = 'stylesheet' type = 'text/css' href = '<?php echo STYLE_DIR; ?>/stylesheet.css' />
	<script type = 'text/javascript' src = '<?php echo SCRIPT_DIR; ?>/functions.js'></script>
	<script type = 'text/javascript' src = '<?php echo SCRIPT_DIR; ?>/jquery-1.7.1.js'></script>
</head>

<body>
<div id = 'header'>
	<div id = 'banner'>
		<a href = '/forums'><img src = '<?php echo BANNER; ?>' alt = 'forums.net'/></a>
	</div>
	
	<div id = 'user_bar'>
		<?php echo $this -> args['user_bar'] -> output(); ?>	
		<span id = 'error_box' class = 'error'>
			<?php foreach(($this -> args['errors']) as $error): ?>
			<br/> <?php echo $error; ?>		
			<?php endforeach; ?>
		</span>
	</div>
</div>
<div id = 'content'>
