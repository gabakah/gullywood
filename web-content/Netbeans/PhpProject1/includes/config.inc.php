<?php # Script 2.1 - config.inc.php

/* 
 *	File name: config.inc.php
 *	Created by: Larry E. Ullman of DMC Insights, Inc. 
 *	Contact: LarryUllman@DMCInsights.com, http://www.dmcinsights.com
 *	Last modified: November 8, 2006
 *	
 *	Configuration file does the following things:
 *	- Has site settings in one location.
 *	- Stores URLs and URIs as constants.
 *	- Sets how errors will be handled.
 */

# ******************** #
# ***** SETTINGS ***** #

// Errors are emailed here.
$contact_email = 'admin@gullywood.com'; 

// Determine whether we're working on a local server
// or on the real server:
if (stristr($_SERVER['HTTP_HOST'], 'local') || (substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168')) {
	$local = TRUE;
} else {
	$local = FALSE;
}

// Determine location of files and the URL of the site:
// Allow for development on different servers.
if ($local) {

	// Always debug when running locally:
	$debug = TRUE;
	
	// Define the constants:
	define ('BASE_URI', '/path/to/html/folder/');
	define ('BASE_URL',	'http://localhost/directory/');
	define ('DB', '/path/to/mysql.inc.php');
	
} else {

	define ('BASE_URI', '/public_html/');
	define ('BASE_URL',	'http://www.gullywood.com/');
	define ('DB', '/includes/gwd/mysql.inc.php');
	
}
	
/* 
 *	Most important setting...
 *	The $debug variable is used to set error management.
 *	To debug a specific page, add this to the index.php page:

if ($p == 'thismodule') $debug = TRUE;
require_once('./includes/config.inc.php');

 *	To debug the entire site, do

$debug = TRUE;

 *	before this next conditional.
 */

// Assume debugging is off. 
if (!isset($debug)) {
	$debug = FALSE;
}

# ***** SETTINGS ***** #
# ******************** #


# **************************** #
# ***** ERROR MANAGEMENT ***** #

// Create the error handler.
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

	global $debug, $contact_email;
	
	// Build the error message.
	$message = "An error occurred in script '$e_file' on line $e_line: \n<br />$e_message\n<br />";
	
	// Add the date and time.
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n<br />";
	
	// Append $e_vars to the $message.
	$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n<br />";
	
	if ($debug) { // Show the error.
	
		echo '<p class="error">' . $message . '</p>';
		
	} else { 
	
		// Log the error:
		error_log ($message, 1, $contact_email); // Send email.
		
		// Only print an error message if the error isn't a notice or strict.
		if ( ($e_number != E_NOTICE) && ($e_number < 2048)) {
			echo '<p class="error">A system error occurred. We apologize for the inconvenience.</p>';
		}
		
	} // End of $debug IF.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler ('my_error_handler');

# ***** ERROR MANAGEMENT ***** #
# **************************** #

// SITE_ROOT contains the full path to the gullywood folder
define("SITE_ROOT", dirname(dirname(__FILE__)));
// Settings needed to configure the Smarty template engine
define("SMARTY_DIR", SITE_ROOT."/libs/smarty/");
define("TEMPLATE_DIR", SITE_ROOT."/templates");
define("COMPILE_DIR", SITE_ROOT."/templates_c");
define("CONFIG_DIR", SITE_ROOT."/configs");
// these should be true while developing the web site        
define("IS_WARNING_FATAL", true);                            
define("DEBUGGING", true);                                   
// settings about mailing the error messages to admin        
define("SEND_ERROR_MAIL", false);                            
define("ADMIN_ERROR_MAIL", "admin@gullywood.com");          
define("SENDMAIL_FROM", "errors@gullywood.com");            
ini_set("sendmail_from", SENDMAIL_FROM);                     
// by default we don't log errors to a file                  
define("LOG_ERRORS", false);                                 
define("LOG_ERRORS_FILE", "/var/tmp/gullywood_errors.log"); // Unix
// Generic error message to be diplayed instead of debug info
// (when DEBUGGING is false)                                 
define("SITE_GENERIC_ERROR_MESSAGE", "<h2>Gullywood Error!</h2>");
if ((substr(strtoupper(PHP_OS), 0, 3)) == "WIN") 
  define("PATH_SEPARATOR", ";");
else      
  define("PATH_SEPARATOR", ":");
ini_set('include_path', SITE_ROOT . '/libs/PEAR' . 
         PATH_SEPARATOR . ini_get('include_path'));
// database login info
define("USE_PERSISTENT_CONNECTIONS", "true");
define("DB_SERVER", "localhost");
define("DB_USERNAME", "gabakah_access");
define("DB_PASSWORD", "gullyw00d");
define("DB_DATABASE", "gabakah_gwdb");
define("MYSQL_CONNECTION_STRING", "mysql://" . DB_USERNAME . ":" . 
        DB_PASSWORD . "@" . DB_SERVER . "/" . DB_DATABASE);
// Configure product display options
define("SHORT_PRODUCT_DESCRIPTION_LENGTH",130);
define("PRODUCTS_PER_PAGE",4);
?>