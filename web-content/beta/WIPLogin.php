<?php
	require_once ('../includes/config.inc.php');
	require_once ('../includes/app_top.php');
	require_once ('../include/process.php');
	//require_once ('../include/session.php');
	$db = &DB::connect($dsn);
	// set fetchmode
	$db->setFetchMode(DB_FETCHMODE_ASSOC);
	// Function for showing a login form:
//	function show_login_form()
//	{
//	echo '<div id="userinfo">
//	}// End of show_login_form() function.
	
	// Create the Auth object:
	$auth= new Auth('DB', $options, 'show_login_form');
//	$auth->start();
?>
<?php
	// Confirm authorization:
	if($auth->checkAuth())
	{
		header("Location:Members.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
		<meta name="generator" content="Adobe GoLive"/>
		<meta http-equiv="imagetoolbar" content="no"/>
		<meta http-equiv="imagetoolbar" content="false"/>
		
<title>Gullywood Online :: Login Page</title>
		<link href="../Theme/Obiara/basic.css" rel="stylesheet" type="text/css" media="all" />
		<style type="text/css" media="screen"><!--
			#login { background-color: #8a8a8a; height: 448px; width: 627px; left: 239px; top: 0; position: absolute; visibility: visible; border-left: 2px solid #fb6c06; border-bottom: 2px solid #fb6c06; border-right: 2px solid #fb6c06; }
			#footer { height: 67px; width: 540px; left: 250px; top: 780px; position: absolute; visibility: visible; }
			#userinfo { height: 28px; width: 210px; left: 640px; top: 60px; position: absolute; z-index: 1; visibility: visible; }
		--></style>
		<meta name="keywords" content="http://www.gullywood.com, Gullywood, gully wood, African Movies, Diaspora movies, Nigerian Movies, Nollywood, Nolly wood,
		Ghanaian Movies, Ghana Films, Yoruba, Senegalese Movies, Senegalese Films, Ghanaian Films, Nigerian Films, Kenyan Movies, Kenyan Films, Swahili, Wolof, Igbo,
		Hausa, Fanti, Ashanti, Twi, south African Movies, South African Films, tribal, African DVD, African Netflix, Accra, Lagos, Nairobi, Cape Town, Cape Coast"/>
	</head>
	<body leftmargin="0" marginheight="0" marginwidth="0" topmargin="0">
		<div id="userinfo">
			<label for="usrinfoSignIn" class="usrinfoSignIn"><a href="../gullywood.html">Home</a></label>
			<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
			<label for="usrinfoRegister" class="usrinfoRegister"><a href="/beta/Register.php">Register</a></label>
			<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
			<label for="usrinfoMyAccount" class="usrinfoMyAccount"><a href="/gw/MyAccount.php">My Account</a></label></div>
			<div id="login">
				<form id="LoginForm" action="Login.php" method="post" name="LoginForm">
					<br/>
				<img src="../images/G-unit_full2.png" alt="" height="140" width="142" border="0" /><br />
				<label for="loginHeader" class="loginHeader">Member Sign In</label><br/>
					<label for="loginCredentials" class="loginCredentialsEmail">Username: </label><input type="text" name="username" size="30"/><br/>
					<label for="loginAssistanceEmailExample" class="loginAssistanceEmailExample">Example: JPublicXYZ</label><br/>
					<br/>
					<label for="loginCredentials" class="loginCredentialsPassword">Password: </label><input type="password" name="password" size="30"/><br/>
					<input class="loginCheckBox" type="checkbox" name="checkboxName" value="checkboxValue" checked="checked"/><label for="loginRemember" class="loginRemember">Remember me on this computer.</label><br/>
					<input type="submit" name="submitButtonName" value="Sign In" class="buttonSignIn"/><br/>
					<input type="hidden" name="sublogin" value="1">
					<br/>
					<label for="loginAssistance" class="loginAssistance"><a href="/gw/ForgotInfo.html">Forgot your username or password?</a></label><br/>
					<label for="loginAssistanceProblems" class="loginAssistanceProblems"><a href="/gw/Support.html">Having problems logging in?</a></label><br/>
					<br/>
					<label for="loginNonMember" class="loginNonMember">Not a member? </label><label for="loginNonMemberClickHere" class="loginNonMemberClickHere"><a href="/beta/Register.php">Click here</a></label>
				</form>
			</div>
		<div id="footer">
			<ul>
				<li><a href="/gw/About.html">About Us</a></li>
				<li><a href="/gw/TermsOfUse.html">Terms of Use</a></li>
				<li><a href="/gw/PrivacyPolicy.html">Privacy Policy</a></li>
				<li><a href="/gw/Contact.html">Contact Us</a></li>
				<li><a href="/gw/News.html">Media Center</a></li>
				<div class="copyright">Copyright © 2008 Gullywood Enterprise. All rights reserved.</div>
			</ul>
		</div>
	
	</body>
</html>