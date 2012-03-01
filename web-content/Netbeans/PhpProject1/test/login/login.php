<?php
	require_once ( 'settings.php' );

	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		if ( $_POST['username'] != '' && $_POST['password'] != '' )
		{
			$query = 'SELECT ID, Username, Active, Password FROM ' . DBPREFIX . 'users WHERE Username = ' . $db->qstr ( $_POST['username'] ) . ' AND Password = ' . $db->qstr ( md5 ( $_POST['password'] ) );

			if ( $db->RecordCount ( $query ) == 1 )
			{
				$row = $db->getRow ( $query );
				if ( $row->Active == 1 )
				{
					set_login_sessions ( $row->ID, $row->Password, ( $_POST['remember'] ) ? TRUE : FALSE );
					header ( "Location: " . REDIRECT_AFTER_LOGIN );
				}
				elseif ( $row->Active == 0 ) {
					$error = 'Your membership was not activated. Please open the email that we sent and click on the activation link.';
				}
				elseif ( $row->Active == 2 ) {
					$error = 'You are suspended!';
				}
			}
			else {		
				$error = 'Login failed!';		
			}
		}
		else {
			$error = 'Please use both your username and password to access your account';
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>roScripts.com - PHP Login System With Admin Features</title>
	<link href="/test/login/css/styles.css" rel="stylesheet" type="text/css" />
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
	</div>
	<div id="container" style="width:230px;">

		<form class="form" action="<?=$_SERVER['PHP_SELF']?>" method="post">

			<input type="hidden" name="_submit_check" value="1"/> 
		
			<div style="margin-top:12px; margin-bottom:10px">
				<img src="/test/login/images/username.gif" alt="username" border="0" />
				<input class="input" type="text" name="username" id="username" size="25" maxlength="40" value="" />
			</div>
			<div style="margin-bottom:6px">
				<img src="/test/login/images/password.gif" alt="password" border="0" />
				<input class="input" type="password" name="password" id="password" size="25" maxlength="32" />
			</div>
			<?php if ( ALLOW_REMEMBER_ME ):?>
			<div style="margin-bottom:6px">
				<input type="checkbox" name="remember" id="remember" />
				<label for="remember">Remember me</label>
			</div>
			<?php endif;?>
			<input type="image" name="Login" value="Login"  class="submit-btn" src="/test/login/images/btn.gif" alt="submit" title="submit" />
			<br class="clear" />
			<a href="/test/login/register.php">Register</a> / <a href="/test/login/forgot_password.php">Password recovery?</a>
			
		</form>
		
		<!--
			Keeping the link below not only gives respect to the large amount of time given freely by me
			but also helps build interest, traffic and use of this script. It's not required but
			recommended since it also might affect my support priorities on the forums.
			
			Thank you, Mihalcea Romeo - roScripts.com
		// -->

		
		
	</div>
	
</body>

</html>