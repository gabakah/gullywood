<?php # Script 2.4 - index.php

/* 
 *	This is the main page.
 *	This page includes the configuration file, 
 *	the templates, and any content-specific modules.
 */

// Require the configuration file before any PHP code:
require_once ('../includes/config.inc.php');
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
		<link href="../css/test.css" rel="stylesheet" type="text/css" media="all" />
		<style type="text/css" media="screen"><!--
#footer { height: 67px; width: 540px; left: 250px; top: 1070px; position: absolute; visibility: visible; }
			#userinfo { height: 28px; width: 210px; left: 740px; top: 75px; position: absolute; visibility: visible; }
			#mainmenu { height: 48px; width: 500px; left: 450px; top: 88px; position: absolute; z-index: 1; visibility: visible; }
			#idxSearch { height: 37px; width: 360px; left: 20px; top: 101px; position: absolute; visibility: visible; }
		--></style>
		<meta name="keywords" content="African DVD, African DVD Rental, African Movies, African Netflix, Caribbean Movies, Caribbean Movie Rental, Diaspora movies, Gullywood, Ghana Films, Ghanaian Films, Ghanaian Movies, Kenyan Films, Kenyan Movies, Nigerian Films, Nigerian Movies, Nollywood, Senegalese Films, Senegalese Movies, South African Films, south African Movies, tribal, Witchcraft movies, Yoruba" />
	</head>

	<body leftmargin="0" marginheight="0" marginwidth="0" topmargin="0">
		<img src="../images/bannermenubar.jpg" livesrc="../images/bannermenubar.psd" alt="" width="100%" height="124" border="0" />
		<div id="userinfo">
			<label for="usrinfoSignIn" class="usrinfoSignIn"><a href="/gw/Login.html">Name</a></label>
			<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
			<label for="usrinfoMyAccount" class="usrinfoMyAccount"><a href="/gw/MyAccount.html">My Account</a></label>
			<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
			<label for="usrinfoRegister" class="usrinfoRegister"><a href="../index.php">Logout</a></label>
		</div>
		<div id="mainmenu">
			<ul>
				<li><a href="/gw/Browse.html">Browse DVDs</a></li>
				<li><a href="/gw/Plans.html">Plans &amp; Prices</a></li>
				<li><a href="/gw/Testimonials.html">Testimonials</a></li>
				<li><a href="/gw/Queue.html">Queue</a></li>
				<li><a href="/gw/Help.html">Help</a></li>
			</ul>
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
		<br class="clear">
		<div style="position:relative;width:950px;height:885px;-adbe-g:p,10,10;">
			<div style="position:absolute;top:72px;left:180px;width:98px;height:132px;">
				<img class="img" src="../images/movie/1993_DangerousFriends.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:72px;left:340px;width:98px;height:132px;">
				<img class="img" src="../images/movie/1994_DangerousFriends2.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:72px;left:500px;width:98px;height:132px;">
				<img class="img" src="../images/movie/1995_FireInTheWord.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:72px;left:660px;width:98px;height:132px;">
				<img class="img" src="../images/movie/1997_KosiOmoIya.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:54px;left:179px;width:104px;height:16px;">
				<label class="title">Dangerous Friend</label></div>
			<div style="position:absolute;top:54px;left:333px;width:114px;height:16px;">
				<label class="title">Dangerous Friend 2</label></div>
			<div style="position:absolute;top:54px;left:499px;width:98px;height:16px;">
				<label class="title">Fire In The Word</label></div>
			<div style="position:absolute;top:54px;left:670px;width:80px;height:16px;">
				<label class="title">Kosi Omo Iya</label></div>
			<div style="position:absolute;top:280px;left:180px;width:96px;height:130px;">
				<img class="img" src="../images/movie/1998_MissingRib.jpg" alt="" width="94" height="128" border="0" /></div>
			<div style="position:absolute;top:280px;left:340px;width:98px;height:130px;">
				<img class="img" src="../images/movie/1999_MissingRib2.jpg" alt="" width="96" height="128" border="0" /></div>
			<div style="position:absolute;top:280px;left:500px;width:94px;height:130px;">
				<img class="img" src="../images/movie/2000_Monaliza.jpg" alt="" width="92" height="128" border="0" /></div>
			<div style="position:absolute;top:280px;left:660px;width:93px;height:130px;">
				<img class="img" src="../images/movie/2001_Monaliza2.jpg" alt="" width="91" height="128" border="0" /></div>
			<div style="position:absolute;top:262px;left:197px;width:66px;height:16px;">
				<label class="title">Missing Rib</label></div>
			<div style="position:absolute;top:262px;left:354px;width:76px;height:16px;">
				<label class="title">Missing Rib 2</label></div>
			<div style="position:absolute;top:262px;left:520px;width:53px;height:16px;">
				<label class="title">Monaliza</label></div>
			<div style="position:absolute;top:262px;left:680px;width:63px;height:16px;">
				<label class="title">Monaliza 2</label></div>
			<div style="position:absolute;top:488px;left:180px;width:96px;height:130px;">
				<img class="img" src="../images/movie/2002_OdoItunu.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:488px;left:340px;width:96px;height:130px;">
				<img class="img" src="../images/movie/2003_Ogundabede.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:488px;left:500px;width:96px;height:130px;">
				<img class="img" src="../images/movie/2004_OjaDudu.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:488px;left:660px;width:96px;height:130px;">
				<img class="img" src="../images/movie/2009_Oyun.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:696px;left:180px;width:96px;height:130px;">
				<img class="img" src="../images/movie/2010_PowerfulCivilian.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:696px;left:340px;width:96px;height:130px;">
				<img class="img" src="../images/movie/2011_PowerfulCivilian2.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:696px;left:500px;width:96px;height:130px;">
				<img class="img" src="../images/movie/2012_Solero.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:696px;left:660px;width:96px;height:130px;">
				<img class="img" src="../images/movie/2013_SweetBetrayal.jpg" alt="" width="96" height="130" border="0" /></div>
			<div style="position:absolute;top:470px;left:197px;width:61px;height:16px;">
				<label class="title">Odo Itunu</label></div>
			<div style="position:absolute;top:470px;left:354px;width:76px;height:16px;">
				<label class="title">Ogundabede</label></div>
			<div style="position:absolute;top:470px;left:520px;width:56px;height:16px;">
				<label class="title">Oja Dudu</label></div>
			<div style="position:absolute;top:470px;left:690px;width:34px;height:16px;">
				<label class="title">Oyun</label></div>
			<div style="position:absolute;top:678px;left:178px;width:96px;height:16px;">
				<label class="title">Powerful Civilian</label></div>
			<div style="position:absolute;top:678px;left:333px;width:106px;height:16px;">
				<label class="title">Powerful Civilian 2</label></div>
			<div style="position:absolute;top:678px;left:660px;width:92px;height:16px;">
				<label class="title">Sweet Betrayal</label></div>
			<div style="position:absolute;top:678px;left:533px;width:40px;height:16px;">
				<label class="title">Solera</label></div>
			<div style="position:absolute;top:278px;left:778px;width:160px;height:600px;">
				<img src="../images/movie/CN_Archos_MusicHere_sweepstakes_160x600.jpg" alt="" width="160" height="600" border="0" /></div>
		</div>
		<div id="content">
			<div id="content-inner">
				
				<div id="contentOnly">
    <div id="fullContent" align="center">
						
					</div>
</div>
	</body>

</html>















