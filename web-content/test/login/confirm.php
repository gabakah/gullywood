<?php
	require_once ( 'settings.php' );

	if ( $_GET['ID'] != '' && numeric ( $_GET['ID'] ) == TRUE && strlen ( $_GET['key'] ) == 32 && alpha_numeric ( $_GET['key'] ) == TRUE ) {
		$query = "SELECT ID, Random_key, Active FROM " . DBPREFIX . "users WHERE ID = " . $db->qstr ( $_GET['ID'] );
		
		if ( $db->RecordCount ( $query ) == 1 ) {
			$row = $db->getRow ( $query );
			if ( $row->Active == 1 ) {
				$error = 'This member is already active !';
			}
			elseif ( $row->Random_key != $_GET['key'] ) {
				$error = 'The confirmation key that was generated for this member does not match with the one entered !';
			}
			else {
				$update = $db->query ( "UPDATE " . DBPREFIX . "users SET Active = 1 WHERE ID=" . $db->qstr ( $row->ID ) );
				if ( REDIRECT_AFTER_CONFIRMATION ) {
					//don't echo put anything before this line
					set_login_sessions ( $row->ID, $row->Password, FALSE );
					header ( "Location: " . REDIRECT_AFTER_LOGIN );
				}
				else {
					$msg = 'Congratulations !  You just confirmed your membership !';
				}
			}
		}
		else {		
			$error = 'User not found !';		
		}
	}
	else {
		$error = 'Invalid data provided !';
	}
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
	<div id="log">
	<?php if ( isset( $error ) ) { echo '			<p class="error">' . $error . '</p>' . "\n";}?>
	<?php if ( isset( $msg ) ) { echo '			<p class="msg">' . $msg . '</p>' . "\n";}?>
	</div>
</body>

</html>