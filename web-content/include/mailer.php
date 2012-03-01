<? 
/**
 * Mailer.php
 *
 * The Mailer class is meant to simplify the task of sending
 * emails to users. Note: this email system will not work
 * if your server is not setup to send mail.
 *
 * If you are running Windows and want a mail server, check
 * out this website to see a list of freeware programs:
 * <http://www.snapfiles.com/freeware/server/fwmailserver.html>
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 19, 2004
 */
// - app. url - the url that points to our application ( ! with trailing slash )
define ( "APPLICATION_URL", "http://www.gullywood.com/gw/" );

require_once('Mail.php');
require_once('Mail/mime.php');

$text = ' You have just registered with Gullywood.com, the premier African Movie Rental Site.';
$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>message</title>
		<link href="../css/basic.css" type="text/css" rel="stylesheet" media="all" />
	</head>

	<body>
		<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Welcome $fname $lname</font></p>
		<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">             You have just registered with Gullywood.com, the premier African Movie Rental Site.<br />
					The following is your login information:<br />
				Username: $user<br />
				Password: $pass<br />
			</font></p>
		<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">In order to confirm your membership please click on the following link: <a href="http://www.gullywood.com/gw/confirm.php?memberName=$user&key=$randomKey">http://www.gullywood.com/gw/confirm.php?memberName=gabakah&amp;key=12345678</a><br />
				<br />
					Thank you for joining<br />
					- Gullywood</font></p>
	</body>

</html>'; 

// Create the Mail_Mime object:
$mime = new Mail_Mime();

// Set the email body:
$mime->setTXTBody($text);
$mime->setHTMLBody($html);

// Set the headers:
$mime->setFrom('admin@gullywood.com');
$mime->setSubject('Welcome To Gullywood.');

// Get the formatted code:
$body = $mime->get();
$headers = $mime->headers();

// Invoke the Mail class's factory() method:
$mail =& Mail::factory('mail');

// Send the email.
$mail->send('admin@gullywood.com', $headers, $body);

// Delete the objects:
unset($mime, $mail);
?>