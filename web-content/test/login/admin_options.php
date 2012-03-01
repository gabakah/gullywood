<?php
	require_once('settings.php');
	checkLogin ( '1' );
	
	if ( numeric ( $_GET['ID'] ) && $_GET['action'] != '' )
	{
		$get_user = "SELECT ID FROM `" . DBPREFIX . "users` WHERE `ID` = " . $db->qstr ( $_GET['ID'] );
		
		if ( $db->RecordCount ( $get_user ) == 1 )
		{
			switch ( $_GET['action'] )
			{
				case 'suspend':
					$db->query ( "UPDATE `" . DBPREFIX . "users` SET `Active` = '2' WHERE `ID` = " . $db->qstr ( $_GET['ID'] ) );
				break;
				
				case 'delete':
					$db->query ( "DELETE FROM `" . DBPREFIX . "users` WHERE `ID` = " . $db->qstr ( $_GET['ID'] ) );
				break;
				
				case 'activate':
					$db->query ( "UPDATE `" . DBPREFIX . "users` SET `Active` = '1' WHERE `ID` = " . $db->qstr ( $_GET['ID'] ) );
				break;
			}
		}
	}
	
	header ( "Location: manage_users.php?active=" . $_GET['active'] . "&start=" . $_GET['start'] );	
?>