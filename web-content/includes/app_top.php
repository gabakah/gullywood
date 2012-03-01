<?php
	// include utility files
	require_once 'config.inc.php';
	require_once 'tss_error_handler.php';
	require_once 'setup_smarty.php';
	require_once 'database.php';
	// global DbManager instance
	$gDbManager = new DbManager(MYSQL_CONNECTION_STRING);
?>