<?php
	require_once('settings.php');
	require_once('functions.php');



	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		if ( $_POST['username'] != '' && $_POST['password'] != '' && $_POST['password'] == $_POST['password_confirmed'] && $_POST['email'] != '' && valid_email ( $_POST['email'] ) == TRUE )
		{
			if ( ! checkUnique ( 'Username', $_POST['username'] ) )
			{
				$error = 'Username already taken. Please try again!';
			}
			elseif ( ! checkUnique ( 'Email', $_POST['email'] ) )
			{
				$error = 'The email you used is associated with another user. Please try again or use the "forgot password" feature!';
			}
			else {		
				$query = $db->query ( "INSERT INTO " . DBPREFIX . "users (`Username` , `Password`, `date_registered`, `Email`, `Random_key`) VALUES (" . $db->qstr ( $_POST['username'] ) . ", " . $db->qstr ( md5 ( $_POST['password'] ) ).", '" . time () . "', " . $db->qstr ( $_POST['email'] ) . ", '" . random_string ( 'alnum', 32 ) . "')" );
				
				$getUser = "SELECT ID, Username, Email, Random_key FROM " . DBPREFIX . "users WHERE Username = " . $db->qstr ( $_POST['username'] ) . "";
		
				if ( $db->RecordCount ( $getUser ) == 1 )
				{			
					$row = $db->getRow ( $getUser );
					
					$subject = "Activation email from " . DOMAIN_NAME;

					$message = "Dear ".$row->Username.", this is your activation link to join our website. In order to confirm your membership please click on the following link: <a href=\"" . APPLICATION_URL . "confirm.php?ID=" . $row->ID . "&key=" . $row->Random_key . "\">" . APPLICATION_URL . "confirm.php?ID=" . $row->ID . "&key=" . $row->Random_key . "</a> <br /><br />Thank you for joining";
					
					if ( send_email ( $subject, $row->Email, $message ) ) {
						$msg = 'Account registered. Please check your email for details on how to activate it.';
					}
					else {
						$error = 'I managed to register your membership but failed to send the validation email. Please contact the admin at ' . ADMIN_EMAIL;
					}
				}
				else {
					$error = 'User not found. Please contact the admin at ' . ADMIN_EMAIL;
				}
			}							
		}
		else {		
			$error = 'There was an error in your data. Please make sure you filled in all the required data, you provided a valid email address and that the password fields match one another.';	
		}
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
<?php	if ( isset ( $error ) )	{ echo '			<p class="error">' . $error . '</p>' . "\n";	}	?>
<?php	if ( isset ( $msg ) )	{ echo '			<p class="msg">' . $msg . '</p>' . "\n";	} else {//if we have a mesage we don't need this form again.?>
	</div>

	<div id="container" style="width:230px;">
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<input type="hidden" name="_submit_check" value="1"/> 
			
		<label for="username">Username</label>
		<input class="input" type="text" id="username" name="username" size="32" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" />
		
		<label for="password">Password</label>
		<input class="input" type="password" id="password" name="password" size="32" value="" />
		
		<label for="password_confirmed">Re-Password</label>
		<input class="input" type="password" id="password_confirmed" name="password_confirmed" size="32" value="" />
		
		<label for="email">Email</label>
		<input class="input" type="text" id="email" name="email" size="32" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" />
		
		<input type="image" name="register" value="register"  class="submit-btn" src="images/btn.gif" alt="submit" title="submit" />
		<div class="clear"></div>
	</form>
	</div>
<? } ?>
</body>

</html>