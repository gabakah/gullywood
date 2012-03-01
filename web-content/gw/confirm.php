<?php
	require_once ('../include/settings.php');
	require_once ('../include/connection.php');
	define ( "REDIRECT_TO_LOGIN", "http://www.gullywood.com/gw/Login.php" );	// - where should we redirect visitors if the access is restricted?
	define ( "REDIRECT_AFTER_LOGIN", "http://www.gullywood.com/gw/Members.php" );	// - where should we redirect members after logging in?
	define ( "REDIRECT_ON_LOGOUT", "http://www.gullywood.com/index.php" );		// - where should we redirect on logout?
	define ( "REDIRECT_AFTER_CONFIRMATION", TRUE );					// - TRUE if you want to redirect your users to the members page after they confirm their membership

//	if (($_GET['memberName'] != '') == TRUE) && ((strlen($_GET['key']) == 32))
	if (($_GET['memberName'] != '')) //&& ((strlen($_GET['key']) = 32))
	{
		$membername = $_GET['memberName'];
		$key = $_GET['key'];
//		$query = "SELECT memberName, randomKey, Active FROM member WHERE memberName = $membername ORDER BY memberName ASC";
		$query = "SELECT * FROM member WHERE memberName = '". $membername ."'";
//		if ( $db->RecordCount ( $query ) == 1 )
//		{
			$row = $db->getRow ( $query );
			if ( $row->Active == 1 )
			{
				$error = 'This member is already active !';
//			} elseif ( $row->randomKey != $_GET['key'] ) {
			} elseif ( $row->randomKey != $key ) {
				$error = 'The confirmation key that was generated for this member does not match with the one entered !';
			} else {
				$update = $db->query ( "UPDATE member SET Active = 1, userStatus = 'Approved' WHERE memberName='". $row->memberName ."'");
//				if ( REDIRECT_AFTER_CONFIRMATION )
//				{
					//don't echo put anything before this line
//					set_login_sessions ( $row->memberName, $row->memberPassword, FALSE );
//					header ( "Location: " . REDIRECT_AFTER_LOGIN );
//				} else {
					$msg = 'Congratulations !  You just confirmed your membership !';
//				}
			}
		//} else {		
		//	$error = 'User not found !';		
		//}
	} else {
		$error = 'Invalid data provided !';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Gullywood::Confirmation Page</title>
		<link href="../test/login/css/styles.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="log">
			<?php if ( isset( $error ) ) { echo '			<p class="error">' . $error . '</p>' . "\n";}?>
			<?php if ( isset( $msg ) ) { echo '			<p class="msg">' . $msg . '</p>' . "\n";}?>
		</div>
	</body>
</html>