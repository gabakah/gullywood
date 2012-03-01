<?php
require_once('settings.php');
error_reporting(E_WARNING);
checkLogin ( '1' );
$installed_config_file = "settings.php";

if ( array_key_exists ( '_submit_check', $_POST ) )
{
	$go_back = "<hr><a href=\"javascript:history.go(-1)\">&lt;&lt; Click here to go back &lt;&lt;</a>";

	if ( $_REQUEST ):
		foreach ( $_REQUEST AS $key => $value ):
			$$key = $value;
		endforeach;
	endif;

	if ( empty ( $APPLICATION_URL ) ): 			$error[] = 'APPLICATION_URL is required'; endif; 
	if ( empty ( $APPLICATION_FOLDER ) ): 			$error[] = 'APPLICATION_FOLDER is required'; endif; 
	if ( empty ( $REDIRECT_TO_LOGIN ) ): 			$error[] = 'REDIRECT_TO_LOGIN is required'; endif; 
	if ( empty ( $REDIRECT_AFTER_LOGIN ) ): 		$error[] = 'REDIRECT_AFTER_LOGIN is required'; endif; 
	if ( empty ( $REDIRECT_ON_LOGOUT ) ): 			$error[] = 'REDIRECT_ON_LOGOUT is required'; endif; 
	if ( empty ( $ADMIN_EMAIL ) ): 				$error[] = 'ADMIN_EMAIL is required'; endif; 
	if ( empty ( $DOMAIN_NAME ) ): 				$error[] = 'DOMAIN_NAME is required'; endif;
	
	if ( empty ( $RUN_ON_DEVELOPMENT ) ): 			$error[] = 'RUN_ON_DEVELOPMENT is required'; endif;
	if ( empty ( $REDIRECT_AFTER_CONFIRMATION ) ): 		$error[] = 'REDIRECT_AFTER_CONFIRMATION is required'; endif;
	if ( empty ( $ALLOW_USERNAME_CHANGE ) ): 		$error[] = 'ALLOW_USERNAME_CHANGE is required'; endif;
	if ( empty ( $ALLOW_REMEMBER_ME ) ): 			$error[] = 'ALLOW_REMEMBER_ME is required'; endif;
	if ( empty ( $USE_SMTP ) ): 				$error[] = 'USE_SMTP is required'; endif;

	if ( $USE_SMTP == 1 ):
		if ( empty ( $SMTP_PORT ) ): 			$error[] = 'SMTP_PORT is required'; endif; 
		if ( empty ( $SMTP_HOST ) ): 			$error[] = 'SMTP_HOST is required'; endif; 
		if ( empty ( $SMTP_USER ) ): 			$error[] = 'SMTP_USER is required'; endif; 
		if ( empty ( $SMTP_PASS ) ): 			$error[] = 'SMTP_PASS is required'; endif; 
	endif;
	
	if ( empty ( $MAIL_IS_HTML ) ): 			$error[] = 'MAIL_IS_HTML is required'; endif;
	
	function create_config_file ( $APPLICATION_URL, $APPLICATION_FOLDER, $REDIRECT_TO_LOGIN, $REDIRECT_AFTER_LOGIN, $REDIRECT_ON_LOGOUT, $ADMIN_EMAIL, $DOMAIN_NAME, $RUN_ON_DEVELOPMENT, $REDIRECT_AFTER_CONFIRMATION, $ALLOW_USERNAME_CHANGE, $ALLOW_REMEMBER_ME, $USE_SMTP, $SMTP_PORT, $SMTP_HOST, $SMTP_USER, $SMTP_PASS, $MAIL_IS_HTML )
	{
		global $installed_config_file, $fp;
		$msg[] = "Attempting to create configuration file: $installed_config_file ...";
		$config_data = '<?php' .  "\n";
		
	
		$config_data .= 'require ( \'lib/connection.php\' );			// - the connection class needed to operate with mysql' .  "\n";
		$config_data .= 'require ( \'functions.php\' );				// - the functions' .  "\n\n\n";
			
		$config_data .= '/*' .  "\n";
		$config_data .= '|---------------------------------------------------------------' .  "\n";
		$config_data .= '| SYSTEM VARIABLES' .  "\n";
		$config_data .= '|---------------------------------------------------------------' .  "\n";
		$config_data .= '|' .  "\n";
		$config_data .= '| System variables needed by the application' .  "\n";
		$config_data .= '|' .  "\n";
		$config_data .= '*/' .  "\n";

		$config_data .= 'define ( "HOSTNAME", "' . HOSTNAME . '" );			// - hostname - nedded to access the database' .  "\n";
		$config_data .= 'define ( "DATABASE", "' . DATABASE . '" );				// - database name - the name of your mysql database' .  "\n";
		$config_data .= 'define ( "DBUSER", "' . DBUSER . '" );				// - database user - what user should we use to access the database' .  "\n";
		$config_data .= 'define ( "DBPASS", "' . DBPASS . '" );			// - database password - what password should we use to access the database' .  "\n";
		$config_data .= 'define ( "DBPREFIX", "' . DBPREFIX . '" );				// - db prefix - would you like to use a prefix for your table?' .  "\n";
		$config_data .= 'define ( "APPLICATION_URL", "' . $APPLICATION_URL . '" );// - app. url - the url that points to our application ( ! with trailing slash )' .  "\n";
		$config_data .= 'define ( "APPLICATION_FOLDER", "' . $APPLICATION_FOLDER . '" );		// - do we have a folder where we store our scripts? ( ! no slashes )' .  "\n";
		$config_data .= 'define ( "REDIRECT_TO_LOGIN", "' . $REDIRECT_TO_LOGIN . '" );		// - where should we redirect visitors if the access is restricted?' .  "\n";
		$config_data .= 'define ( "REDIRECT_AFTER_LOGIN", "' . $REDIRECT_AFTER_LOGIN . '" );	// - where should we redirect members after logging in?' .  "\n";
		$config_data .= 'define ( "REDIRECT_ON_LOGOUT", "' . $REDIRECT_ON_LOGOUT . '" );		// - where should we redirect on logout?' .  "\n";
		$config_data .= 'define ( "ADMIN_EMAIL", "' . $ADMIN_EMAIL . '" );	// - what email should we use to contact our members?' .  "\n";
		$config_data .= 'define ( "KEEP_LOGGED_IN_FOR", 60*60*24*100 );		// - if they chose to be remembered, how long should the cookies remain active ( default is 100 days )' .  "\n";
		$config_data .= 'define ( "COOKIE_PATH", "/" );				// - where should the cookies be active ( \'/\' means the whole domain. )' .  "\n";
		$config_data .= 'define ( "DOMAIN_NAME", "' . $DOMAIN_NAME . '" );		// - the domain name that we use' .  "\n";
		if ( $RUN_ON_DEVELOPMENT == 1 ) {
			$config_data .= 'define ( "RUN_ON_DEVELOPMENT", TRUE );			// - TRUE if you wish to see the nasty errors for debugging, FALSE to hide them' .  "\n";
		}
		else {
			$config_data .= 'define ( "RUN_ON_DEVELOPMENT", FALSE );			// - TRUE if you wish to see the nasty errors for debugging, FALSE to hide them' .  "\n";
		}

		if ( $REDIRECT_AFTER_CONFIRMATION == 1 ) {
			$config_data .= 'define ( "REDIRECT_AFTER_CONFIRMATION", TRUE );		// - TRUE if you want to redirect your users to the members page after they confirm their membership' .  "\n";
		}
		else {
			$config_data .= 'define ( "REDIRECT_AFTER_CONFIRMATION", FALSE );		// - TRUE if you want to redirect your users to the members page after they confirm their membership' .  "\n";
		}

		if ( $ALLOW_USERNAME_CHANGE == 1 ) {
			$config_data .= 'define ( "ALLOW_USERNAME_CHANGE", TRUE );		// - do we let our members update their usernames as well? ( FALSE stands for no )' .  "\n";
		}
		else {
			$config_data .= 'define ( "ALLOW_USERNAME_CHANGE", FALSE );		// - do we let our members update their usernames as well? ( FALSE stands for no )' .  "\n";
		}

		if ( $ALLOW_REMEMBER_ME == 1 ) {
			$config_data .= 'define ( "ALLOW_REMEMBER_ME", TRUE );			// - do we let our members use the "remember me" feature' .  "\n\n\n";
		}
		else {
			$config_data .= 'define ( "ALLOW_REMEMBER_ME", FALSE );			// - do we let our members use the "remember me" feature' .  "\n\n\n";
		}


		$config_data .= '/*' .  "\n";
		$config_data .= '|---------------------------------------------------------------' .  "\n";
		$config_data .= '| EMAILING VARIABLES' .  "\n";
		$config_data .= '|---------------------------------------------------------------' .  "\n";
		$config_data .= '|' .  "\n";
		$config_data .= '| Emailing variables needed by phpmailer' .  "\n";
		$config_data .= '|' .  "\n";
		$config_data .= '*/' .  "\n";

		if ( $USE_SMTP == 1 ) {
			$config_data .= 'define ( "USE_SMTP", TRUE );				// - do you want to use SMTP to send out emails? TRUE or FALSE ( mail() will be used )' .  "\n";
		}
		else {
			$config_data .= 'define ( "USE_SMTP", FALSE );				// - do you want to use SMTP to send out emails? TRUE or FALSE ( mail() will be used )' .  "\n";
		}

		$config_data .= 'define ( "SMTP_PORT", "' . $SMTP_PORT . '" );				// - what port should we use for smtp ( only needed if SMTP is set to TRUE )' .  "\n";
		$config_data .= 'define ( "SMTP_HOST", "' . $SMTP_HOST . '" );		// - what host should we use for smtp ( only needed if SMTP is set to TRUE )' .  "\n";
		$config_data .= 'define ( "SMTP_USER", "' . $SMTP_USER . '" );		// - what user should we use for smtp ( only needed if SMTP is set to TRUE )' .  "\n";
		$config_data .= 'define ( "SMTP_PASS", "' . $SMTP_PASS . '" );		// - what password should we use for smtp (only needed if SMTP is set to TRUE)' .  "\n";

		if ( $MAIL_IS_HTML == 1 ) {
			$config_data .= 'define ( "MAIL_IS_HTML", TRUE );			// - send emails as html or text? ( TRUE for html and FALSE for text )' .  "\n";
		}
		else {
			$config_data .= 'define ( "MAIL_IS_HTML", FALSE );			// - send emails as html or text? ( TRUE for html and FALSE for text )' .  "\n\n\n";
		}



		$config_data .= '############################################################# DON\'T EDIT BELOW THIS LINE ########################################' .  "\n\n\n";
			
		$config_data .= '/*' .  "\n";
		$config_data .= '|---------------------------------------------------------------' .  "\n";
		$config_data .= '| SET THE SERVER PATH' .  "\n";
		$config_data .= '|---------------------------------------------------------------' .  "\n";
		$config_data .= '|' .  "\n";
		$config_data .= '| Let\'s attempt to determine the full-server path to the "system"' .  "\n";
		$config_data .= '| folder in order to reduce the possibility of path problems.' .  "\n";
		$config_data .= '|' .  "\n";
		$config_data .= '*/' .  "\n";

		$config_data .= 'if ( function_exists ( \'realpath\' ) AND @realpath ( dirname (__FILE__) ) !== FALSE )' .  "\n";
		$config_data .= '{' .  "\n";
		$config_data .= '	define ( "BASE_PATH", str_replace ( "\\\", "/", realpath ( dirname(__FILE__) ) ) . \'/\' );' .  "\n";
		$config_data .= '}' .  "\n\n\n";

		$config_data .= '//how do we handle errors' .  "\n";
		$config_data .= 'error_reporting ( ( RUN_ON_DEVELOPMENT ) ? E_ALL : E_WARNING );' .  "\n";
		$config_data .= 'if ( file_exists ( BASE_PATH . \'install.php\' ) )' .  "\n";
		$config_data .= '{' .  "\n";
		$config_data .= '	die ( "Please delete install.php from your server before continuing!" );' .  "\n";
		$config_data .= '}' .  "\n\n\n";
		$config_data .= '$db = new db ( DBUSER, DBPASS, DATABASE, HOSTNAME );	// - and away we go' .  "\n";
		$config_data .= '?>' .  "\n";
		
		$fp = fopen ( $installed_config_file, "w" );
		if ( ! $fp ) {
			die ( "<strong><font color=\"#FF0000\">ERROR - $installed_config_file does not have write permissions. Please CHMOD it to 777</a></strong>" );
		}
		else {
			set_file_buffer ( $fp, 0 );
			$file_write = fputs ( $fp, $config_data );
			fclose ( $fp );
			return TRUE;
		}
	}

	if ( count ( $error ) == 0 && create_config_file ( $APPLICATION_URL, $APPLICATION_FOLDER, $REDIRECT_TO_LOGIN, $REDIRECT_AFTER_LOGIN, $REDIRECT_ON_LOGOUT, $ADMIN_EMAIL, $DOMAIN_NAME, $RUN_ON_DEVELOPMENT, $REDIRECT_AFTER_CONFIRMATION, $ALLOW_USERNAME_CHANGE, $ALLOW_REMEMBER_ME, $USE_SMTP, $SMTP_PORT, $SMTP_HOST, $SMTP_USER, $SMTP_PASS, $MAIL_IS_HTML ) ):
		$msg[] = 'Settings saved successfully';
	endif;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>roScripts.com - PHP Login System With Admin Features</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" />
<?php
	if ( count ( $msg ) > 0 ):
?>
	<meta http-equiv="refresh" content="1" />
<?php
	endif;
?>
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
<?php 
		if ( count ( $error ) > 0 ):
			foreach ( $error as $err ):
				echo '<p class="error">' . $err . '</p>' . "\n";
			endforeach;
		endif;
		
		if ( count ( $msg ) > 0 ):
			foreach ( $msg as $ms ):
				echo '<p class="msg">' . $ms . '</p>' . "\n";
			endforeach;
		endif;
?>
	<form id="form1" name="form1" method="post" action="">
	<input type="hidden" name="_submit_check" value="1"/> 
	<table width="500">
		<tr>
			<td width="170"><div style="padding-left:10px"><label for="APPLICATION_URL">APPLICATION_URL</label></div></td>
			<td width="120">
				<input name="APPLICATION_URL" type="text" class="input" id="APPLICATION_URL" value="<?php if(isset($_POST['APPLICATION_URL'])){echo $_POST['APPLICATION_URL'];}else{echo APPLICATION_URL;}?>" />
			</td>
			<td><div style="padding-left:10px">app. url - the url that points to our application ( ! with trailing slash ) ex: <strong>http://www.domain.com/login/ </strong></div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px"><label for="APPLICATION_FOLDER">APPLICATION_FOLDER</label></div></td>
			<td width="120">
				<input name="APPLICATION_FOLDER" type="text" class="input" id="APPLICATION_FOLDER" value="<?php if(isset($_POST['APPLICATION_FOLDER'])){echo $_POST['APPLICATION_FOLDER'];}else{echo APPLICATION_FOLDER;}?>" />
			</td>
			<td><div style="padding-left:10px">do we have a folder where we store our scripts? ( ! no slashes ) ex: <strong>login </strong></div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px"><label for="REDIRECT_TO_LOGIN">REDIRECT_TO_LOGIN</label></div></td>
			<td width="120">
				<input name="REDIRECT_TO_LOGIN" type="text" class="input" id="REDIRECT_TO_LOGIN" value="<?php if(isset($_POST['REDIRECT_TO_LOGIN'])){echo $_POST['REDIRECT_TO_LOGIN'];}else{echo REDIRECT_TO_LOGIN;}?>" />
			</td>
			<td><div style="padding-left:10px">where should we redirect visitors if the access is restricted?</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px"><label for="REDIRECT_AFTER_LOGIN">REDIRECT_AFTER_LOGIN</label></div></td>
			<td width="120">
				<input name="REDIRECT_AFTER_LOGIN" type="text" class="input" id="REDIRECT_AFTER_LOGIN" value="<?php if(isset($_POST['REDIRECT_AFTER_LOGIN'])){echo $_POST['REDIRECT_AFTER_LOGIN'];}else{echo REDIRECT_AFTER_LOGIN;}?>" />
			</td>
			<td><div style="padding-left:10px">where should we redirect members after logging in?</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px"><label for="REDIRECT_ON_LOGOUT">REDIRECT_ON_LOGOUT</label></div></td>
			<td width="120">
				<input name="REDIRECT_ON_LOGOUT" type="text" class="input" id="REDIRECT_ON_LOGOUT" value="<?php if(isset($_POST['REDIRECT_ON_LOGOUT'])){echo $_POST['REDIRECT_ON_LOGOUT'];}else{echo REDIRECT_ON_LOGOUT;}?>" />
			</td>
			<td><div style="padding-left:10px">where should we redirect on logout?</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px"><label for="ADMIN_EMAIL">ADMIN_EMAIL</label></div></td>
			<td width="120">
				<input name="ADMIN_EMAIL" type="text" class="input" id="ADMIN_EMAIL" value="<?php if(isset($_POST['ADMIN_EMAIL'])){echo $_POST['ADMIN_EMAIL'];}else{echo ADMIN_EMAIL;}?>" />
			</td>
			<td><div style="padding-left:10px">what email should we use to contact our members?</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px"><label for="DOMAIN_NAME">DOMAIN_NAME</label></div></td>
			<td width="120">
				<input name="DOMAIN_NAME" type="text" class="input" id="DOMAIN_NAME" value="<?php if(isset($_POST['DOMAIN_NAME'])){echo $_POST['DOMAIN_NAME'];}else{echo DOMAIN_NAME;}?>" />
			</td>
			<td><div style="padding-left:10px">the domain name that we use</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px">RUN_ON_DEVELOPMENT</div></td>
			<td width="120">
			<p>			
				<input type="radio" name="RUN_ON_DEVELOPMENT" value="1" id="RUN_ON_DEVELOPMENT_Y" <?php if(RUN_ON_DEVELOPMENT){echo 'checked';}?> />
				<label for="RUN_ON_DEVELOPMENT_Y">YES</label>
				<br />
				<input type="radio" name="RUN_ON_DEVELOPMENT" value="2" id="RUN_ON_DEVELOPMENT_N" <?php if( ! RUN_ON_DEVELOPMENT){echo 'checked';}?> />
				<label for="RUN_ON_DEVELOPMENT_N">NO</label>
			</p></td>
			<td><div style="padding-left:10px">YES if you wish to see the nasty errors for debugging, FALSE to hide them</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px">REDIRECT_AFTER_CONFIRMATION</div></td>
			<td width="120">
				<input type="radio" name="REDIRECT_AFTER_CONFIRMATION" value="1" id="REDIRECT_AFTER_CONFIRMATION_Y" <?php if(REDIRECT_AFTER_CONFIRMATION){echo 'checked';}?> />
				<label for="REDIRECT_AFTER_CONFIRMATION_Y">YES</label>
				<br />
				
				<input type="radio" name="REDIRECT_AFTER_CONFIRMATION" value="2" id="REDIRECT_AFTER_CONFIRMATION_N" <?php if( ! REDIRECT_AFTER_CONFIRMATION){echo 'checked';}?> />
				<label for="REDIRECT_AFTER_CONFIRMATION_N">NO</label></td>
			<td><div style="padding-left:10px">YES if you want to redirect your users to the members page after they confirm their membership</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px">ALLOW_USERNAME_CHANGE</div></td>
			<td width="120">
				<input type="radio" name="ALLOW_USERNAME_CHANGE" value="1" id="ALLOW_USERNAME_CHANGE_Y" <?php if(ALLOW_USERNAME_CHANGE){echo 'checked';}?> />
				<label for="ALLOW_USERNAME_CHANGE_Y">YES</label>
				<br />
				
				<input type="radio" name="ALLOW_USERNAME_CHANGE" value="2" id="ALLOW_USERNAME_CHANGE_N" <?php if( ! ALLOW_USERNAME_CHANGE){echo 'checked';}?> />
				<label for="ALLOW_USERNAME_CHANGE_N">NO</label></td>
			<td><div style="padding-left:10px">do we let our members update their usernames as well?</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px">ALLOW_REMEMBER_ME</div></td>
			<td width="120">
				<input type="radio" name="ALLOW_REMEMBER_ME" value="1" id="ALLOW_REMEMBER_ME_Y" <?php if( ALLOW_REMEMBER_ME){echo 'checked';}?> />
				<label for="ALLOW_REMEMBER_ME_Y">YES</label>
				<br />
				
				<input type="radio" name="ALLOW_REMEMBER_ME" value="2" id="ALLOW_REMEMBER_ME_N" <?php if( ! ALLOW_REMEMBER_ME){echo 'checked';}?> />
				<label for="ALLOW_REMEMBER_ME_N">NO</label></td>
			<td><div style="padding-left:10px">do we let our members use the &quot;remember me&quot; feature</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px">USE_SMTP</div></td>
			<td width="120">
				<input type="radio" name="USE_SMTP" value="1" id="USE_SMTP_Y" <?php if( USE_SMTP){echo 'checked';}?> />
				<label for="USE_SMTP_Y">YES</label>
				<br />
				
				<input type="radio" name="USE_SMTP" value="2" id="USE_SMTP_N" <?php if( ! USE_SMTP){echo 'checked';}?> />
				<label for="USE_SMTP_N">NO</label></td>
			<td><div style="padding-left:10px">do you want to use SMTP to send out emails? TRUE or FALSE ( mail() will be used )</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px"><label for="SMTP_PORT">SMTP_PORT</label></div></td>
			<td width="120">
				<input name="SMTP_PORT" type="text" class="input" id="SMTP_PORT" value="<?php if(isset($_POST['SMTP_PORT'])){echo $_POST['SMTP_PORT'];}else{echo SMTP_PORT;}?>" />
			</td>
			<td><div style="padding-left:10px">what port should we use for smtp ( only needed if SMTP is set to YES )</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px"><label for="SMTP_HOST">SMTP_HOST</label></div></td>
			<td width="120">
				<input name="SMTP_HOST" type="text" class="input" id="SMTP_HOST" value="<?php if(isset($_POST['SMTP_HOST'])){echo $_POST['SMTP_HOST'];}else{echo SMTP_HOST;}?>" />
			</td>
			<td><div style="padding-left:10px">what host should we use for smtp ( only needed if SMTP is set to YES )</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px"><label for="SMTP_USER">SMTP_USER</label></div></td>
			<td width="120">
				<input name="SMTP_USER" type="text" class="input" id="SMTP_USER" value="<?php if(isset($_POST['SMTP_USER'])){echo $_POST['SMTP_USER'];}else{echo SMTP_USER;}?>" />
			</td>
			<td><div style="padding-left:10px">what user should we use for smtp ( only needed if SMTP is set to YES )</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px"><label for="SMTP_PASS">SMTP_PASS</label></div></td>
			<td width="120">
				<input name="SMTP_PASS" type="password" class="input" id="SMTP_PASS" value="<?php if(isset($_POST['SMTP_PASS'])){echo $_POST['SMTP_PASS'];}else{echo SMTP_PASS;}?>" />
			</td>
			<td><div style="padding-left:10px">what password should we use for smtp (only needed if SMTP is set to YES )</div></td>
		</tr>
		<tr>
			<td width="170"><div style="padding-left:10px">MAIL_IS_HTML</div></td>
			<td width="120">
				<input type="radio" name="MAIL_IS_HTML" value="1" id="MAIL_IS_HTML_Y" <?php if( MAIL_IS_HTML ){echo 'checked';}?> />
				<label for="MAIL_IS_HTML_Y">YES</label>
				<br />
				
				<input type="radio" name="MAIL_IS_HTML" value="2" id="MAIL_IS_HTML_N" <?php if( ! MAIL_IS_HTML ){echo 'checked';}?> />
				<label for="MAIL_IS_HTML_N">NO</label></td>
			<td><div style="padding-left:10px">send emails as html or text? ( YES for html and NO for text )</div></td>
		</tr>
		<tr>
			<td colspan=3>
				<input type="image" name="Submit" value="Submit"  class="submit-btn" src="images/btn.gif" alt="submit" title="submit" />
			</td>
	  </tr>
	</table>
	</form>
</body>

</html>