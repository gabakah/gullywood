<?php # Details.php
	/* 
	 *	This is the main page.
	 *	This page includes the configuration file, 
	 *	the templates, and any content-specific modules.
	 */
	
	// Require the configuration file before any PHP code:
	require_once ('../includes/config.inc.php');
	require_once ('../includes/app_top.php');
	require_once ('../include/process.php');
	
	$db = &DB::connect($dsn);
	// set fetchmode
	$db->setFetchMode(DB_FETCHMODE_ASSOC);
	$auth= new Auth('DB', $options);
	// Confirm authorization:
//	if(!$auth->checkAuth())
//	{
//		header("Location:Login.php");
//	}

?>
<?php
	$dbc = mysql_connect ('localhost', 'gabakah_access', 'gullyw00d', 'gabakah_gwdb') OR die ('Cannot connect to the database.');
	$db_selected = mysql_select_db("gabakah_gwdb",$dbc);
	// Check for the movieId in the URL.
	$ccid = NULL;
	$rating = NULL;
	$movieId = NULL;		
	$myqueueId = NULL;		
	$movieTitle = NULL;
	$movieImage = NULL;
	$movieLength = NULL;
	$releaseDate = NULL;
	$personnelId = NULL;
	$personnelType = NULL;
	$personnelFirstname = NULL;
	$personnelLastname = NULL;
	$personnelImage = NULL;
	$personnelBio = NULL;
	$movieDescription = NULL;
	
	$personnelId = (INT) $_GET['personnelId'];
	$getPersonnel = "SELECT personnelId, personnelType, personnelFirstname, personnelLastname, personnelImage, personnelBio from personnel WHERE personnelId = $personnelId";
	$result = mysql_query($getPersonnel, $dbc);
	$getMovies = "SELECT movieId, movieTitle, movieImage, movieDescription, movieLength, releaseDate from movie m INNER JOIN castcrew c on m.ccId = c.ccId INNER JOIN personnel p on c.personnelId = p.personnelId WHERE m.discNumber = 1 and p.personnelId = $personnelId";

	list($personnelId, $personnelType, $personnelFirstname, $personnelLastname, $personnelImage, $personnelBio) = mysql_fetch_array($result, MYSQL_NUM);

	$movieList = mysql_query($getMovies, $dbc);
	$movieCount = mysql_num_rows($movieList);
//	echo $movieCount;
//	list($movieId, $movieTitle, $movieImage, $movieDescription, $movieLength) = mysql_fetch_array($movieList, MYSQL_NUM);
//	echo $movieDescription;
?>
<?php
	/**
	 * Cut string to n symbols and add delim but do not break words.
	 *
	 * Example:
	 * <code>
	 *  $string = 'this sentence is way too long';
	 *  echo neat_trim($string, 16);
	 * </code>
	 *
	 * Output: 'this sentence is…'
	 *
	 * @access public
	 * @param string string we are operating with
	 * @param integer character count to cut to
	 * @param string|NULL delimiter. Default: '…'
	 * @return string processed string
	 **/
	function neat_trim($str, $n, $delim='…') {
	   $len = strlen($str);
	   if ($len > $n) {
    	   preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
	       return rtrim($matches[1]) . $delim;
	   }
	   else {
    	   return $str;
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
			#userinfo { height: 28px; width: 210px; left: 740px; top: 75px; position: absolute; visibility: visible; }
			#mainmenu { height: 48px; width: 500px; left: 450px; top: 88px; position: absolute; z-index: 1; visibility: visible; }
			#idxSearch { height: 37px; width: 360px; left: 20px; top: 101px; position: absolute; visibility: visible; }
			#movieDetails { height: 542px; width: 709px; left: 130px; top: 98px; position: absolute; visibility: visible; }
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
		<div id="idxSearch">
			<form id="idxSearchForm" action="(EmptyReference!)" method="get" name="idxSearchForm">
				<label for="q">Search</label>
				<input type="search" placeholder = "Movie, Actor, Country, Director" autosave="com.domain.search" results="10" name="q" size="36" />
			</form>
		</div>
		<br class="clear">
		
		<form id="FormName" action="(EmptyReference!)" method="get" name="FormName">
			<div id="movieDetails">
				<div style="position:relative;width:709px;height:542px;-adbe-g:p,10,10;">
					<div style="position:absolute;top:64px;left:60px;width:164px;height:164px;">
						<img class="img" src='<?php echo"$personnelImage" ?>' alt="" height="164" align="left" />
					</div>
					<div style="position:absolute;top:64px;left:224px;width:435px;height:163px;">
						<table id="synopsisTxtArea" width="435" border="0" cellspacing="2" cellpadding="0" height="163">
							<tr height="20">
								<td align="left" valign="top" height="20"><span id="pgActorName" class="pgActorName"><?php echo "$personnelFirstname"," ","$personnelLastname" ?></span></td>
							</tr>
							<tr>
								<td align="justify" valign="top"><span class="pgDetailsSynopsis"><?php print "".neat_trim($personnelBio, 500).""; ?></span></td>
							</tr>
						</table>
					</div>
					<div style="position:absolute;top:250px;left:60px;width:200px;height:20px;">
						<table width="600" border="0" cellspacing="2" cellpadding="0">
							<?php 
								// if user is already logged in, check if movie is already in their queue
								if($auth->checkAuth())
								{
									$myqueueId = $auth->getAuthData('myqueueId');
									$getQueue = "SELECT movieId from queue q INNER JOIN myqueue mq on q.queueId = mq.queueId INNER JOIN member m on m.myqueueId = mq.myqueueId where m.myqueueId = $myqueueId";
									$queueList = mysql_query($getQueue, $dbc);
									$queueMovieId = NULL;
									$queueArray = array();
									while(list($queueMovieId) = mysql_fetch_array($queueList, MYSQL_NUM))
									{
										$queueArray[$queueMovieId] = $queueMovieId;
									}
								}
								// Print all movies associated with actor
								for ( $i = 0; $i < $movieCount; $i++ )
								{
									list($movieId, $movieTitle, $movieImage, $movieDescription, $movieLength, $releaseDate) = mysql_fetch_array($movieList, MYSQL_NUM);
									print "<tr align=\"right\">";
									print "	<td width=\"70\" align=\"center\"><a href=\"../beta/Details.php?movieId=$movieId\"><img src=".$movieImage." alt=\"\" height=\"100\" /><br></a>";
									?>
									<?php
										if($auth->checkAuth())
										{
											if (in_array($movieId, $queueArray))
											{
												// If movie already in queue, disable ability to add movie to queue
												print "<a><img class=\"img\" src='/images/queue/INQueue.png' alt=\"\" width=\"70\"></a>";
											} else {
												// If movie not in queue, enable ability to add movie
												print "<a href=\"../beta/Queue.php?movieId=$movieId&rmQueue=\"><img class=\"img\" src='/images/queue/AMNormal.png' alt=\"\"  width=\"70\"></a>";
											}
										} else {
											// If movie not in queue, enable ability to add movie
											print "<a href=\"../beta/Queue.php?movieId=$movieId&rmQueue=\"><img class=\"img\" src='/images/queue/AMNormal.png' alt=\"\" width=\"70\"></a>";
										}
									?>
									<?php
									print "</td>";
									print "<td width =\"5\"></td>";
									print "<td align=\"justify\" valign=\"top\"><span class =\"pgDetailsSynopsisFont\"><a href=\"../beta/Details.php?movieId=$movieId\">$movieTitle</a></span><br><span class=\"pgDetailsSynopsis\">".neat_trim($movieDescription, 250, $delim='…')."</span><br></td>";
									print "</tr>";
									print "<tr>";
									print "<td colspan=\"3\" align=\"center\" height=\"20\">";
									print "</td>";
									print "</tr>";
								}
								print "<tr>";
								print "</tr>";
								print "<tr>";
								print "<td colspan=\"3\" align=\"center\">";
								print "<div class=\"pgDetailsFooter\" ><ul><li><a href=\"/gw/About.html\">About Us</a></li><li><a href=\"/gw/TermsOfUse.html\">Terms of Use</a></li><li><a href=\"/gw/PrivacyPolicy.html\">Privacy Policy</a></li><li><a href=\"/gw/Contact.html\">Contact Us</a></li><li><a href=\"/gw/News.html\">Media Center</a></li><div class=\"copyright\">Copyright © 2007 Gullywood Enterprise. All rights reserved.</div></ul></td></div>";
								print "</tr>";
							?>
						</table>
					</div>
				</div>
			</div>
		</form>
		
		<div id="content">
			<div id="content-inner">
				<div id="contentOnly">
		    		<div id="fullContent" align="center">
					</div>
				</div>
	</body>
</html>