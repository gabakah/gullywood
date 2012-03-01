<?php
	require_once ('../includes/config.inc.php');
	require_once ('../includes/app_top.php');
	require_once ('../include/process.php');
	$db = & DB::connect($dsn);
	// set fetchmode
	$db->setFetchMode(DB_FETCHMODE_ASSOC);
	// Create the Auth object:
	$auth = new Auth('DB', $options, 'show_login_form');
	//$auth->start();			
	// Confirm authorization:
	if ($auth->checkAuth())
	{
		$auth->logout();
		header("Location: ../index.php");
	}
?>