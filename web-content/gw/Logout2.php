<?php
	require_once ('../includes/config.inc.php');
	require_once ('../includes/app_top.php');
	require_once ('../include/process.php');
	$db = & DB::connect($dsn);
	// set fetchmode
	$db->setFetchMode(DB_FETCHMODE_ASSOC);
	// Function for showing a login form:
	function show_login_form()
	{
		echo ' <img src="../images/bannermenubar.jpg" livesrc="../images/bannermenubar.psd" alt="" width="100%" height="124" border="0" />
			<div id="userinfo">
				<label for="usrinfoSignIn" class="usrinfoSignIn"><a href="/gw/Login.html">Sign In</a></label>
				<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
				<label for="usrinfoRegister" class="usrinfoRegister"><a href="/gw/Register.php">Register</a></label>
				<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
				<label for="usrinfoMyAccount" class="usrinfoMyAccount"><a href="/gw/MyAccount.html">My Account</a></label></div>
			<div id="mainmenu">
			<ul>
				<li><a href="/gw/Browse.html">Browse DVDs</a></li>
				<li><a href="/gw/Plans.html">Plans &amp; Prices</a></li>
				<li><a href="/gw/Testimonials.html">Testimonials</a></li>
				<li><a href="/gw/Queue.html">Queue</a></li>
				<li><a href="/gw/Help.html">Help</a></li>
			</ul>
			</div>		
			<div id="login">
			<form id="LoginForm" action="Login.php" method="post" name="LoginForm">
				<br />
				<label for="loginHeader" class="loginHeader">Gullywood Member Sign In</label><br />
				<label for="loginCredentials" class="loginCredentialsEmail">Username: </label><input type="text" name="username" size="30" /><br />
				<label for="loginAssistanceEmailExample" class="loginAssistanceEmailExample">Example: me@mymail.com or JPublicXYZ</label><br />
				<br />
				<label for="loginCredentials" class="loginCredentialsPassword">Password: </label><input type="password" name="password" size="30" /><br />
				<input class="loginCheckBox" type="checkbox" name="checkboxName" value="checkboxValue" checked="checked" /><label for="loginRemember" class="loginRemember">Remember me on this computer.</label><br />
				<input type="submit" name="submitButtonName" value="Sign In" class="buttonSignIn"/><br />
				<input type="hidden" name="sublogin" value="1">
				<br />
				<label for="loginAssistance" class="loginAssistance"><a href="/gw/ForgotInfo.html">Forgot your username or password?</a></label><br />
				<label for="loginAssistanceProblems" class="loginAssistanceProblems"><a href="/gw/Support.html">Having problems logging in?</a></label><br />
				<br />
				<label for="loginNonMember" class="loginNonMember">Not a member? </label><label for="loginNonMemberClickHere" class="loginNonMemberClickHere"><a href="/gw/Register.php">Click here</a></label>
			</form>
		</div>
				<div id="footer">
			<ul>
				<li><a href="/gw/About.html">About Us</a></li>
				<li><a href="/gw/TermsOfUse.html">Terms of Use</a></li>
				<li><a href="/gw/PrivacyPolicy.html">Privacy Policy</a></li>
				<li><a href="/gw/Contact.html">Contact Us</a></li>
				<li><a href="/gw/News.html">Media Center</a></li>
				<div class="copyright">Copyright © 2007 Gullywood Enterprise. All rights reserved.</div>
			</ul>
		</div>
		<div id="idxSearch">
			<form id="idxSearchForm" action="(EmptyReference!)" method="get" name="idxSearchForm">
				<label for="q">Search</label>
				<input type="search" placeholder = "Movie, Actor, Country, Director" autosave="com.domain.search" results="10" name="q" size="36" />
			</form>
		</div>';	
	} // End of show_login_form() function.

	// Create the Auth object:
	$auth = new Auth('DB', $options, 'show_login_form');
	//$auth->start();			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>Gullywood Online :: Logout</title>
		<link href="../css/basic.css" rel="stylesheet" type="text/css" media="all" />
	</head>

	<body leftmargin="0" marginheight="0" marginwidth="0" topmargin="0">
		<?php
			// Confirm authorization:
			if ($auth->checkAuth())
			{
				$auth->logout();
				$auth->start();
//				header("Location: ../gw/Members.php");
			}
		?>
	</body>
</html>