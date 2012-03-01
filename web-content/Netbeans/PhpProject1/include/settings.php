<?php
require ( '../include/connection.php' );			// - the connection class needed to operate with mysql
//require ( 'functions.php' );				// - the functions


/*
|---------------------------------------------------------------
| SYSTEM VARIABLES
|---------------------------------------------------------------
|
| System variables needed by the application
|
*/
define ( "HOSTNAME", "localhost" );			// - hostname - nedded to access the database
define ( "DATABASE", "gabakah_gwdb" );				// - database name - the name of your mysql database
define ( "DBUSER", "gabakah_admin" );				// - database user - what user should we use to access the database
define ( "DBPASS", "supp0rt" );			// - database password - what password should we use to access the database
define ( "DBPREFIX", "" );				// - db prefix - would you like to use a prefix for your table?
define ( "APPLICATION_URL", "http://www.gullywood.com/test/login/" );// - app. url - the url that points to our application ( ! with trailing slash )
define ( "APPLICATION_FOLDER", "temp" );		// - do we have a folder where we store our scripts? ( ! no slashes )
define ( "REDIRECT_TO_LOGIN", "http://www.gullywood.com/test/login.php" );		// - where should we redirect visitors if the access is restricted?
define ( "REDIRECT_AFTER_LOGIN", "http://www.gullywood.com/gw/Members.php" );	// - where should we redirect members after logging in?
define ( "REDIRECT_ON_LOGOUT", "http://www.gullywood.com/index.php" );		// - where should we redirect on logout?
define ( "ADMIN_EMAIL", "gabakah@mac.com" );	// - what email should we use to contact our members?
define ( "KEEP_LOGGED_IN_FOR", 60*60*24*100 );		// - if they chose to be remembered, how long should the cookies remain active ( default is 100 days )
define ( "COOKIE_PATH", "/" );				// - where should the cookies be active ( '/' means the whole domain. )
define ( "DOMAIN_NAME", "gullywood.com" );		// - the domain name that we use
define ( "RUN_ON_DEVELOPMENT", FALSE );			// - TRUE if you wish to see the nasty errors for debugging, FALSE to hide them
define ( "REDIRECT_AFTER_CONFIRMATION", TRUE );		// - TRUE if you want to redirect your users to the members page after they confirm their membership
define ( "ALLOW_USERNAME_CHANGE", FALSE );		// - do we let our members update their usernames as well? ( FALSE stands for no )
define ( "ALLOW_REMEMBER_ME", TRUE );			// - do we let our members use the "remember me" feature


/*
|---------------------------------------------------------------
| EMAILING VARIABLES
|---------------------------------------------------------------
|
| Emailing variables needed by phpmailer
|
*/
define ( "USE_SMTP", FALSE );				// - do you want to use SMTP to send out emails? TRUE or FALSE ( mail() will be used )
define ( "SMTP_PORT", "" );				// - what port should we use for smtp ( only needed if SMTP is set to TRUE )
define ( "SMTP_HOST", "" );		// - what host should we use for smtp ( only needed if SMTP is set to TRUE )
define ( "SMTP_USER", "" );		// - what user should we use for smtp ( only needed if SMTP is set to TRUE )
define ( "SMTP_PASS", "" );		// - what password should we use for smtp (only needed if SMTP is set to TRUE)
define ( "MAIL_IS_HTML", TRUE );			// - send emails as html or text? ( TRUE for html and FALSE for text )
############################################################# DON'T EDIT BELOW THIS LINE ########################################


/*
|---------------------------------------------------------------
| SET THE SERVER PATH
|---------------------------------------------------------------
|
| Let's attempt to determine the full-server path to the "system"
| folder in order to reduce the possibility of path problems.
|
*/
if ( function_exists ( 'realpath' ) AND @realpath ( dirname (__FILE__) ) !== FALSE )
{
	define ( "BASE_PATH", str_replace ( "\\", "/", realpath ( dirname(__FILE__) ) ) . '/' );
}


//how do we handle errors
error_reporting ( ( RUN_ON_DEVELOPMENT ) ? E_ALL : E_WARNING );
if ( file_exists ( BASE_PATH . 'install.php' ) )
{
	die ( "Please delete install.php from your server before continuing!" );
}


$db = new db ( DBUSER, DBPASS, DATABASE, HOSTNAME );	// - and away we go
?>