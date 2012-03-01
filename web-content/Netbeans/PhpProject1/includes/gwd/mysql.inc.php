<?php # Script 2.7 - mysql.inc.php

// Connect to the database:
$dbc = @mysql_connect ('localhost', 'gabakah_access', 'gullyw00d', 'gabakah_gwdb') 
OR die ('<p>Could not connect to the database!</p></body></html>');
?>