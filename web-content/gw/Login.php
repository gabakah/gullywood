<?php
	require_once ('../includes/config.inc.php');
	require_once ('../includes/app_top.php');
	require_once ('../include/process.php');
	//require_once ('../include/session.php');
	$db = &DB::connect($dsn);
	// set fetchmode
	$db->setFetchMode(DB_FETCHMODE_ASSOC);
	// Function for showing a login form:
	function show_login_form()
	{
	echo '<img src="../images/bannermenubar.jpg" livesrc="../images/bannermenubar.psd" alt="" width="100%" height="124" border="0"/>
			<div id="userinfo">
				<label for="usrinfoSignIn" class="usrinfoSignIn"><a href="../index.php">Home</a></label>
				<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
				<label for="usrinfoRegister" class="usrinfoRegister"><a href="/gw/Register.php">Register</a></label>
				<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
				<label for="usrinfoMyAccount" class="usrinfoMyAccount"><a href="/gw/MyAccount.php">My Account</a></label></div>
			<div id="mainmenu">
			<ul>
				<li><a href="/gw/Browse.html">Browse DVDs</a></li>
				<li><a href="/gw/Plans.html">Plans &amp; Prices</a></li>
				<li><a href="/gw/Testimonials.html">Testimonials</a></li>
				<li><a href="/gw/Queue.php?movieId=0&rmQueue=">Queue</a></li>
				<li><a href="/gw/Help.html">Help</a></li>
			</ul>
			</div>
			<div id="login">
			<form id="LoginForm" action="Login.php" method="post" name="LoginForm">
				<br/>
				<label for="loginHeader" class="loginHeader">Gullywood Member Sign In</label><br/>
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
				<input type="search" placeholder = "Movie, Actor, Country, Director" autosave="com.domain.search" results="10" name="q" size="36"/>
			</form>
		</div>';
	}// End of show_login_form() function.
	// Create the Auth object:
	$auth= new Auth('DB', $options, 'show_login_form');
			$auth->start();
//	header("Location:Members.php");
//		header("Location:Members.php");
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
		
<title>Gullywood Online :: Home Page</title>
		<link href="../css/basic.css" rel="stylesheet" type="text/css" media="all"/>
		<style type="text/css" media="screen"><!--
			#login { background-image: url(../images/signin.jpg); height: 276px; width: 450px; left: 19px; top: 124px; position: absolute; visibility: visible; }
			#footer { height: 67px; width: 540px; left: 250px; top: 780px; position: absolute; visibility: visible; }
			#userinfo { height: 28px; width: 210px; left: 740px; top: 75px; position: absolute; visibility: visible; }
			#mainmenu { height: 48px; width: 500px; left: 450px; top: 88px; position: absolute; z-index: 1; visibility: visible; }
			#idxSearch { height: 37px; width: 360px; left: 20px; top: 101px; position: absolute; visibility: visible; }
		--></style>
		<meta name="keywords" content="http://www.gullywood.com, Gullywood, gully wood, African Movies, Diaspora movies, Nigerian Movies, Nollywood, Nolly wood,
		Ghanaian Movies, Ghana Films, Yoruba, Senegalese Movies, Senegalese Films, Ghanaian Films, Nigerian Films, Kenyan Movies, Kenyan Films, Swahili, Wolof, Igbo,
		Hausa, Fanti, Ashanti, Twi, south African Movies, South African Films, tribal, African DVD, African Netflix, Accra, Lagos, Nairobi, Cape Town, Cape Coast"/>
	</head>
	<body leftmargin="0" marginheight="0" marginwidth="0" topmargin="0">
	</body>
</html>