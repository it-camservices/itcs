<?php
	defined("DS")?null:define("DS",DIRECTORY_SEPARATOR);
	defined("LIB_PATH")?null : define("LIB_PATH",dirname(__FILE__));
	
	require_once(LIB_PATH.DS."config.php");
	require_once(LIB_PATH.DS."database.php");
	require_once(LIB_PATH.DS."function.php");
?>