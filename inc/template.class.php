<?php

/*
Class for loading template files containing page HTML. The output() function outputs
the contents of a template file to a page while inserting the dynamic arg values.
Arguments can be set in the constructor or with setArg().
*/

class Template
{
	public $template;
	public $args;

	function __construct($filepath, $args)
	{
		$this -> template = $filepath;
		$this -> args = $args;
	}

	
	function setArg($arg, $value)
	{
		$this -> args[$arg] = $value; 
	}

	function output()
	{
		extract($this -> args);
		include($this -> template);
	}
}
?>
