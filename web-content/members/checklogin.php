<?php
ob_start();
$host = "localhost"; // Host name 
$username = "gabakah_access"; // Mysql username 
$password = "gullyw00d"; // Mysql password 
$db_name = "gabakah_gwdb"; // Database name 
$tbl_name = "member"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password") or die("cannot connect"); 
mysql_select_db("$db_name") or die("cannot select DB");

// Define $myusername and $mypassword 
$myusername = strip_tags($_POST['loginCredentialsUsername']); 
$mypassword = sha1(strip_tags($_POST['loginCredentialsPassword']));

$sql="SELECT * FROM $tbl_name WHERE username = '".mysql_real_escape_string($_POST['loginCredentialsUsername'])."' and password = '".sha1($_POST['loginCredentialsPassword'])."'";
// $sql = sprintf("SELECT * FROM $tbl_name WHERE username = '%s' and password = '%s' LIMIT 1;", mysql_real_escape_string($myusername), $mypassword); 
$result = mysql_query($sql);

// Mysql_num_row is counting table row
$count = mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword"); 
//header("location:login_success.php");
header("location:Members.php");
}
else {
echo "Wrong Username or Password ".$myusername;
//echo mysql_real_escape_string($myusername);
//echo $sql;
//echo $count;
}

ob_end_flush();
?>