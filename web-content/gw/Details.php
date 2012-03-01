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
<?php
	$dbc = mysql_connect ('localhost', 'gabakah_access', 'gullyw00d', 'gabakah_gwdb') OR die ('Cannot connect to the database.');
	$db_selected = mysql_select_db("gabakah_gwdb",$dbc);
	// Check for the movieId in the URL.
	$ccid = NULL;
	$rating = NULL;
	$movieId = NULL;		
	$movieTitle = NULL;
	$movieImage = NULL;
	$movieLength = NULL;
	$releaseDate = NULL;
	$movieDescription = NULL;
	if (isset($_GET['movieId']))
	{
		// Typecast it to an integer:	
		$movieId = (INT) $_GET['movieId'];
		
		// $movieId must have a valid value.
		if ($movieId > 0)
		{
			// Get the information from the database
			// for this movie
			$q = "SELECT movieId, movieTitle, movieImage, movieDescription, movieLength, ccid, releaseDate, rating FROM movie WHERE movieId = $movieId";
			$r = mysql_query($q, $dbc);
			
			if (mysql_num_rows($r) == 1)
			{
				list($movieId, $movieTitle, $movieImage, $movieDescription, $movieLength, $ccid, $releaseDate, $rating) = mysql_fetch_array($r, MYSQL_NUM);
			}	// End of mysql_num_rows() IF
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
		<title>Gullywood Online :: Movie Details Page</title>
		<link href="../css/basic.css" rel="stylesheet" type="text/css" media="all" />
		
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
				<li><a href="/gw/Queue.php?movieId=0&rmQueue=">Queue</a></li>
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
		<div style="position:relative;width:1029px;height:885px;-adbe-g:p,10,10;">
			<div style="position:absolute;top:40px;left:250px;width:170px;height:170px;">
				<a href='<?php echo"$movieImage" ?>' target="_blank"><img class="img" src='<?php echo"$movieImage" ?>' alt="" height="170" width="170" /></a></div>
			<div style="position:absolute;top:278px;left:857px;width:160px;height:600px;">
				<img src="../images/movies/CN_Archos_MusicHere_sweepstakes_160x600.jpg" alt="" width="160" height="600" border="0" /></div>
			<div style="position:absolute;top:270px;left:268px;width:65px;height:22px;">
				<label>Synopsis:</label></div>
			<div style="position:absolute;top:300px;left:268px;width:580px;height:176px;">
				<table width="580" border="0" cellspacing="2" cellpadding="0" height="176">
					<tr>
						<td align="left" valign="top"><?php echo "$movieDescription" ?></td>
					</tr>
				</table>
			</div>
			<div style="position:absolute;top:40px;left:440px;width:417px;height:145px;">
				<table width="320" border="0" cellspacing="2" cellpadding="0">
					<tr>
						<td colspan="3" width="413"><?php echo "$movieTitle" ?> (<?php echo $releaseDate ?>)</td>
					</tr>
					<tr>
						<td width="67"><label>Starring: </label></td>
						<td width="13"></td>
						<td width="329"></td>
					</tr>
					<tr>
						<td width="67"><label>Director: </label></td>
						<td width="13"></td>
						<td width="329"></td>
					</tr>
					<tr>
						<td width="67"><label>Rating: </label></td>
						<td width="13"></td>
						<td width="329"><?php echo $rating ?></td>
					</tr>
					<tr>
						<td width="67"><label>Genre: </label></td>
						<td width="13"></td>
						<td width="329"></td>
					</tr>
					<tr>
						<td width="67"><label>Length: </label></td>
						<td width="13"></td>
						<td width="329"><?php echo $movieLength ?><label> min.</label></td>
					</tr>
				</table>
			</div>
			<div style="position:absolute;top:220px;left:290px;width:100px;height:22px;">
				<label>Add To Queue</label></div>
		</div>
		<div id="content">
			<div id="content-inner">
				<div id="contentOnly">
		    		<div id="fullContent" align="center"></div>
				</div>
	</body>
</html>



























