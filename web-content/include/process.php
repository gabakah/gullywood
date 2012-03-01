<?php
	// Define the database connection
	$dsn = 'mysql://gabakah_access:gullyw00d@localhost/gabakah_gwdb';
	
	// All options:
	// Use specific username and password columns.
	// Use SHA1() to encrypt the passwords.
	// Retrieve all fields.
	$options = array(
		'dsn' => $dsn,
		'table' => 'member',
		'usernamecol' => 'memberName',
		'passwordcol' => 'memberPassword',
		'cryptType' => 'sha1',
		'db_fields' => '*'
	);
	
?>