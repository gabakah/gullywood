<?php # Script 2.4 - index.php
	/* 
	 *	This is the main page.
	 *	This page includes the configuration file, 
	 *	the templates, and any content-specific modules.
	 */

	// Require the configuration file before any PHP code:
	require_once ('../includes/config.inc.php');
	require_once ('../includes/app_top.php');
	require_once ('../include/process.php');
//	require_once ('../include/session.php');
	
	$db = &DB::connect($dsn);
	// set fetchmode
	$db->setFetchMode(DB_FETCHMODE_ASSOC);
	$auth= new Auth('DB', $options);
	// Confirm authorization:
	if(!$auth->checkAuth())
	{
		header("Location:Login.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="imagetoolbar" content="false" />
		<title>Gullywood Online :: Member's  Page</title>
		<link href="../../css/basic.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../../css/test.css" rel="stylesheet" type="text/css" media="all" />
		<style type="text/css" media="screen"><!--
			#footer { height: 67px; width: 540px; left: 250px; top: 1070px; position: absolute; visibility: visible; }
			#userinfo { height: 28px; width: 210px; left: 740px; top: 75px; position: absolute; visibility: visible; }
			#mainmenu { height: 48px; width: 500px; left: 450px; top: 88px; position: absolute; z-index: 1; visibility: visible; }
			#idxSearch { height: 37px; width: 360px; left: 20px; top: 101px; position: absolute; visibility: visible; }
		--></style>
		<meta name="keywords" content="African DVD, African DVD Rental, African Movies, African Netflix, Caribbean Movies, Caribbean Movie Rental, Diaspora movies, Gullywood, Ghana Films, Ghanaian Films, Ghanaian Movies, Kenyan Films, Kenyan Movies, Nigerian Films, Nigerian Movies, Nollywood, Senegalese Films, Senegalese Movies, South African Films, south African Movies, tribal, Witchcraft movies, Yoruba" />
	</head>
	<body leftmargin="0" marginheight="0" marginwidth="0" topmargin="0">
		<img src="../../images/bannermenubar.jpg" livesrc="../../images/bannermenubar.psd" alt="" width="100%" height="124" border="0" />
		<div id="userinfo">
			<label for="usrinfoSignIn" class="usrinfoSignIn"><a href="/gw/PersonalInfo.php"><?php echo $auth->getUsername();?></a></label>
			<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
			<label for="usrinfoMyAccount" class="usrinfoMyAccount"><a href="/gw/MyAccount.php">My Account</a></label>
			<label for="usrinfoSlashes" class="usrinfoSlashes">|</label>
			<label for="usrinfoRegister" class="usrinfoRegister"><a href="/gw/Logout.php">Logout</a></label>
		</div>
		<div id="mainmenu">
			<ul>
				<li><a href="/gw/Browse.html">Browse DVDs</a></li>
				<li><a href="/gw/Plans.html">Plans &amp; Prices</a></li>
				<li><a href="/gw/Testimonials.html">Testimonials</a></li>
				<li><a href="/gw/Queue.php">Queue</a></li>
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
		<div style="position:relative;width:1018px;height:897px;-adbe-g:p,10,10;">
			<div style="position:absolute;top:278px;left:857px;width:160px;height:600px;">
				<img src="../../images/movies/CN_Archos_MusicHere_sweepstakes_160x600.jpg" alt="" width="160" height="600" border="0" /></div>
			<div style="position:absolute;top:54px;left:180px;width:652px;height:813px;">
				<table width="652" border="0" cellspacing="2" cellpadding="0" height="813">
					<tr height="197">
						<td align="center" valign="top" width="160" height="197"><label class="title">$movieTitle</label><br />
							<img class="img" src="../$movieImage" alt="" width="96" height="130" border="0" /></td>
						<td align="center" valign="top" width="160" height="197"><label class="title">Dangerous Friend 2</label><br />
							<img class="img" src="../../images/movies/1994_DangerousFriends2.jpg" alt="" width="96" height="130" border="0" /></td>
						<td align="center" valign="top" width="160" height="197"><label class="title">Fire In The Word</label><br />
							<img class="img" src="../../images/movies/1995_FireInTheWord.jpg" alt="" width="96" height="130" border="0" /></td>
						<td align="center" valign="top" width="160" height="197"><label class="title">Kosi Omo Iya</label><br />
							<img class="img" src="../../images/movies/1997_KosiOmoIya.jpg" alt="" width="96" height="130" border="0" /></td>
					</tr>
					<tr height="205">
						<td align="center" valign="top" width="160" height="205"><label class="title">Missing Rib</label><br />
							<img class="img" src="../../images/movies/1998_MissingRib.jpg" alt="" width="94" height="128" border="0" /></td>
						<td align="center" valign="top" width="160" height="205"><label class="title">Missing Rib 2</label><br />
							<img class="img" src="../../images/movies/1999_MissingRib2.jpg" alt="" width="96" height="128" border="0" /></td>
						<td align="center" valign="top" width="160" height="205"><label class="title">Monaliza</label><br />
							<img class="img" src="../../images/movies/2000_Monaliza.jpg" alt="" width="92" height="128" border="0" /></td>
						<td align="center" valign="top" width="160" height="205"><label class="title">Monaliza 2</label><br />
							<img class="img" src="../../images/movies/2001_Monaliza2.jpg" alt="" width="91" height="128" border="0" /></td>
					</tr>
					<tr height="202">
						<td align="center" valign="top" width="160" height="202"><label class="title">Odo Itunu</label><br />
							<img class="img" src="../../images/movies/2002_OdoItunu.jpg" alt="" width="96" height="130" border="0" /></td>
						<td align="center" valign="top" width="160" height="202"><label class="title">Ogundabede</label><br />
							<img class="img" src="../../images/movies/2003_Ogundabede.jpg" alt="" width="96" height="130" border="0" /></td>
						<td align="center" valign="top" width="160" height="202"><label class="title">Oja Dudu</label><br />
							<img class="img" src="../../images/movies/2004_OjaDudu.jpg" alt="" width="96" height="130" border="0" /></td>
						<td align="center" valign="top" width="160" height="202"><label class="title">Oyun</label><br />
							<img class="img" src="../../images/movies/2009_Oyun.jpg" alt="" width="96" height="130" border="0" /></td>
					</tr>
					<tr height="180">
						<td align="center" valign="top" width="160" height="180"><label class="title">Powerful Civilian</label><br />
							<img class="img" src="../../images/movies/2010_PowerfulCivilian.jpg" alt="" width="96" height="130" border="0" /></td>
						<td align="center" valign="top" width="160" height="180"><label class="title">Powerful Civilian 2</label><br />
							<img class="img" src="../../images/movies/2011_PowerfulCivilian2.jpg" alt="" width="96" height="130" border="0" /></td>
						<td align="center" valign="top" width="160" height="180"><label class="title">Solera</label><br />
							<img class="img" src="../../images/movies/2012_Solero.jpg" alt="" width="96" height="130" border="0" /></td>
						<td align="center" valign="top" width="160" height="180"><label class="title">Sweet Betrayal</label><br />
							<img class="img" src="../../images/movies/2013_SweetBetrayal.jpg" alt="" width="96" height="130" border="0" /></td>
					</tr>
				</table>
			</div>
		</div>
		<div id="content">
			<div id="content-inner">
				<div id="contentOnly">
		    		<div id="fullContent" align="center"></div>
				</div>
	<?php
		$dbc = mysql_connect ('localhost', 'gabakah_access', 'gullyw00d', 'gabakah_gwdb') OR die ('Cannot connect to the database.');
		$db_selected = mysql_select_db("gabakah_gwdb",$dbc);
		// List the movies on this page
		$q = "SELECT movieId, movieTitle, movieImage, movieDescription FROM movie";
		$r = mysql_query($q, $dbc);
		if (mysql_num_rows($r) > 1)
		{
			$row_count = 1;
			// Print each:
			while (list($movieId, $movieTitle, $movieImage, $movieDescription) = mysql_fetch_array($r, MYSQL_NUM))
			{
				if ($row_count == 5)
				{
					echo "<br />";
					$row_count = 1;
				} else
				{
					// Link to the details.php page:
					echo "<a href=\"Details.php?movieId=$movieId\">$movieTitle</a><a href=\"Details.php?movieId=$movieId\"><img src=$movieImage width=\"100\" height=\"100\" border=\"0\"/></a>";
					$row_count++ ;
				}	
			}
		}
		?>
	</body>
</html>

