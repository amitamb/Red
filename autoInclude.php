<?php

// add following line at the top of every file
// require_once("autoInclude.php");

function __autoload($class_name) 
{
	if ($class_name == "smarty")
	{
		require_once "smarty/Smarty.class.php";
		return;
	}
	
    require_once "model/". $class_name .'.php';
}

?>
