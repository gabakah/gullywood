<?php # Script: Check Username availability - checkusername.php

/*	This page checks a database to see if
 *	$_GET['username'] has already been registered.
 *	The page will be called by JavaScript.
 *	The page returns a simple text message.
 *	No HTML is required by this script!
 */
 
 function showerror()
 {
 	die("Error ". mysql_errno() . " : " . mysql_errno());
 }
 
// Validate that the page received $_GET['username']:
if (isset($_GET['memberName'])) {

	// Connect to the database:
	$dbc = @mysql_connect ('localhost', 'gabakah_access', 'gullyw00d') OR die ('<p>Could not connect to the database!</p></body></html>');
	
	// Define the query:
	$q = sprintf("SELECT memberName FROM member WHERE memberName = '%s'", mysql_real_escape_string(trim($_GET['memberName'], $dbc)));
	if (!(mysql_select_db(gabakah_gwdb, $dbc)))
		showerror();
	
	// Execute the query:
	$r = mysql_query($q, $dbc);

	// Report upon the results:
	if (mysql_num_rows($r) == 1) {
		echo 'The username is unavailable!';
	} else {
		echo 'The username is available!';
	}
	
	mysql_close($dbc);

	} else { // No username supplied!
		echo 'Please enter a username.';
	}
?>