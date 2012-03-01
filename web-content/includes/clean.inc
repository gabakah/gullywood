<?php
	$hostName = "localhost";
	$databaseName = "gabakah_gwdb";
	$username = "gabakah_access";
	$password = "gullyw00d";

	function clean($input, $maxlength)
	{
	  $input = substr($input, 0, $maxlength);
	  $input = EscapeShellCmd($input);
	  return ($input);
	}
?>
