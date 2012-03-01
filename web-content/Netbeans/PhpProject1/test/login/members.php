<?php 
	require_once('settings.php');
	checkLogin('1 2');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>roScripts.com - PHP Login System With Admin Features</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" />
<!--
                     ____                               __
                    /\  _`\                  __        /\ \__
          _ __   ___\ \,\L\_\    ___   _ __ /\_\  _____\ \ ,_\   ____
         /\`'__\/ __`\/_\__ \   /'___\/\`'__\/\ \/\ '__`\ \ \/  /',__\
         \ \ \//\ \L\ \/\ \L\ \/\ \__/\ \ \/ \ \ \ \ \L\ \ \ \_/\__, `\
          \ \_\ \____/\ `\____\ \____\ \_\  \ \_\ \ ,__/\ \__\/\____/
           \/_/ \/___/  \/_____/\/____/ \/_/   \/_/\ \ \/  \/__/\/___/
                                                    \ \_\
                                                     \/_/
                                                Making your world easy
-->
</head>

<body>

	<div id="container" style="text-align:center;width:230px;">

<?php
	echo 'Hello <em><b><u>' . get_username ( $_SESSION['user_id'] ) . '</u></b></em>!<br />You are now logged in.<br /><br /><a href="update_profile.php" title="update your profile">Click here</a> to update your profile.';
	
	/* we show the manage users link only if the logged in member has admin rights */
	if ( isadmin ( $_SESSION['user_id'] ) ):
?>
	<br /><br />
	It seems that you're an admin. You may <a href="manage_users.php" title="manage users">manage users</a> or <a href="admin_settings.php" title="edit site settings">edit site settings</a>.
<?php
	endif;
?>
	<br /><br />
	
	<a href="logout.php">logout</a>
		
	</div>
	
</body>

</html>