<?php
	require_once ( 'settings.php' );

	$query = "SELECT * FROM " . DBPREFIX . "users WHERE ID = " . $db->qstr ( $_GET['ID'] );

	if ( $db->RecordCount ( $query ) == 1 )
	{
		$row = $db->getRow ( $query );
		if ( $row->Temp_pass == $_GET['new'] && $row->Temp_pass_active == 1 )
		{
			$update = $db->query ( "UPDATE " . DBPREFIX . "users SET Password = " . $db->qstr ( md5 ( $row->Temp_pass ) ) . ", Temp_pass_active=0 WHERE ID = " . $db->qstr ( $_GET['ID'] ) );
			$msg = 'Your new password has been confirmed. You may login using it.';
		}
		else
		{
			$error = 'The new password is already confirmed or is incorrect';
		}
	}
	else {
		$error = 'This member does not exist.';
	}

	if ( isset ( $error ) ) {
		echo $error;
	}
	else {
		echo $msg;
	}
?>