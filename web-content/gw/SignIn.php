<?php # Login Script - SignIn.php
	function &db_connect()
	{ 
//		require_once 'DB.php'; 
		require_once '../includes/app_top.php'; 
		PEAR::setErrorHandling(PEAR_ERROR_DIE); 
		$db_host = 'localhost'; 
		$db_user = 'gabakah_access'; 
		$db_pass = 'gullyw00d'; 
		$db_name = 'gabakah_gwdb'; 
		$dsn = "mysql://$db_user:$db_pass@unix+$db_host/$db_name"; 
		$db = DB::connect($dsn); 
		$db->setFetchMode(DB_FETCHMODE_OBJECT); 
		return $db; 
	}

	function session_defaults()
	{ 
		$_SESSION['logged'] = false; 
		$_SESSION['uid'] = 0; 
		$_SESSION['username'] = ''; 
		$_SESSION['cookie'] = 0; 
		$_SESSION['remember'] = false; 
	}

	if (!isset($_SESSION['uid']) )
	{ 
		session_defaults(); 
	}

	class User
	{
		var $db = null; // PEAR::DB pointer
		var $failed = false; // failed login attempt
		var $date; // current date GMT
		var $id = 0; // the current user's id
		function User(&$db)
		{
			$this->db = $db;
			$this->date = $GLOBALS['date'];
			if ($_SESSION['logged'])
			{
				$this->_checkSession();
			} elseif (isset($_COOKIE['mtwebLogin']))
			{
				$this->_checkRemembered($_COOKIE['mtwebLogin']);
			}
		}
	}

	$date = gmdate("'Y-m-d'"); 
	$db = db_connect(); 
	$user = new User($db);

	function _checkLogin($username, $password, $remember)
	{
		$username = $this->db->quote($username);
		$password = $this->db->quote(sha1($password));
		$sql = "SELECT * FROM member WHERE " .
		"username = $username AND " .
		"password = $password";
		$result = $this->db->getRow($sql);
		if ( is_object($result) ){
		$this->_setSession($result, $remember);
		return true;
		} else {
		$this->failed = true;
		$this->_logout();
		return false;
	}

	function _setSession(&$values, $remember, $init = true)
	{
		$this->id = $values->id;
		$_SESSION['uid'] = $this->id;
		$_SESSION['username'] = htmlspecialchars($values->username);
		$_SESSION['cookie'] = $values->cookie;
		$_SESSION['logged'] = true;
		if ($remember)
		{ 
			$this->updateCookie($values->cookie, true);
		}
		if ($init)
		{
			$session = $this->db->quote(session_id());
			$ip = $this->db->quote($_SERVER['REMOTE_ADDR']);
			$sql = "UPDATE member SET session = $session, ip = $ip WHERE " .
			"id = $this->id";
			$this->db->query($sql);
		}
	}

	function updateCookie($cookie, $save)
	{
		$_SESSION['cookie'] = $cookie;
		if ($save)
		{
			$cookie = serialize(array($_SESSION['username'], $cookie) );
			set_cookie('mtwebLogin', $cookie, time() + 31104000, '/directory/');
		}
	}

	function _checkRemembered($cookie) {
	list($username, $cookie) = @unserialize($cookie);
	if (!$username or !$cookie) return;
	$username = $this->db->quote($username);
	$cookie = $this->db->quote($cookie);
	$sql = "SELECT * FROM member WHERE " .
	"(username = $username) AND (cookie = $cookie)";
	$result = $this->db->getRow($sql);
	if (is_object($result) ) 
		{
	$this->_setSession($result, true);
	}
}

function _checkSession() { 
$username = $this->db->quote($_SESSION['username']); 
$cookie = $this->db->quote($_SESSION['cookie']); 
$session = $this->db->quote(session_id()); 
$ip = $this->db->quote($_SERVER['REMOTE_ADDR']); 
$sql = "SELECT * FROM member WHERE " . 
"(username = $username) AND (cookie = $cookie) AND " . 
"(session = $session) AND (ip = $ip)"; 
$result = $this->db->getRow($sql); 
if (is_object($result) ) { 
$this->_setSession($result, false, false); 
} else { 
$this->_logout(); 
} 
}



}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="imagetoolbar" content="false" />
		<title>Gullywood Online :: Home Page</title>
		<link href="../css/basic.css" rel="stylesheet" type="text/css" media="all" />
		<style type="text/css" media="screen"><!--
#login { background-image: url(../images/signin.jpg); height: 276px; width: 450px; left: 19px; top: 124px; position: absolute; visibility: visible; }
			#footer { height: 67px; width: 540px; left: 250px; top: 780px; position: absolute; visibility: visible; }
			#userinfo { height: 28px; width: 210px; left: 740px; top: 75px; position: absolute; visibility: visible; }
			#mainmenu { height: 48px; width: 500px; left: 450px; top: 88px; position: absolute; z-index: 1; visibility: visible; }
			#idxSearch { height: 37px; width: 360px; left: 20px; top: 101px; position: absolute; visibility: visible; }
		--></style>
		<meta name="keywords" content="http://www.gullywood.com, Gullywood, gully wood, African Movies, Diaspora movies, Nigerian Movies, Nollywood, Nolly wood, Ghanaian Movies, Ghana Films, Yoruba, Senegalese Movies, Senegalese Films, Ghanaian Films, Nigerian Films, Kenyan Movies, Kenyan Films, Swahili, Wolof, Igbo, Hausa, Fanti, Ashanti, Twi, south African Movies, South African Films, tribal, African DVD, African Netflix, Accra, Lagos, Nairobi, Cape Town, Cape Coast" />
	</head>

	<body leftmargin="0" marginheight="0" marginwidth="0" topmargin="0">
		<img src="../images/bannermenubar.jpg" livesrc="../images/bannermenubar.psd" alt="" width="100%" height="124" border="0" />
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
			<form id="LoginForm" action="(EmptyReference!)" method="get" name="LoginForm">
				<br />
				<label for="loginHeader" class="loginHeader">Gullywood Member Sign In</label><br />
				<label for="loginCredentials" class="loginCredentialsEmail">Email/Username: </label><input type="text" name="loginCredentialsUsername" size="30" /><br />
				<label for="loginAssistanceEmailExample" class="loginAssistanceEmailExample">Example: me@mymail.com or JPublicXYZ</label><br />
				<br />
				<label for="loginCredentials" class="loginCredentialsPassword">Password: </label><input type="password" name="loginCredentialsPassword" size="30" /><br />
				<input class="loginCheckBox" type="checkbox" name="checkboxName" value="checkboxValue" checked="checked" /><label for="loginRemember" class="loginRemember">Remember me on this computer.</label><br />
				<input type="submit" name="submitButtonName" value="Sign In" class="buttonSignIn"/><br />
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
		</div>
	</body>

</html>