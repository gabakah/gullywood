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
			// Get the information from the database for this movie
			$q = "SELECT movieId, movieTitle, movieImage, movieDescription, movieLength, ccid, releaseDate, rating FROM movie WHERE movieId = $movieId";
			$r = mysql_query($q, $dbc);
			
			if (mysql_num_rows($r) == 1)
			{
				list($movieId, $movieTitle, $movieImage, $movieDescription, $movieLength, $ccid, $releaseDate, $rating) = mysql_fetch_array($r, MYSQL_NUM);
			}	// End of mysql_num_rows() IF

			// Get the Actors & Actresses which star in the movie
			$actor_queue = "SELECT p.personnelId, p.personnelFirstname, p.personnelLastname from castcrew c INNER JOIN personnel p on c.personnelId = p.personnelId where c.ccId = $ccid and p.personnelType LIKE \"Act%\"";
			$actor_list = mysql_query($actor_queue, $dbc);
			$actorCount = mysql_num_rows($actor_list);

			// Get the Directors info
			$director_queue = "SELECT p.personnelId, p.personnelFirstname, p.personnelLastname from castcrew c INNER JOIN personnel p on c.personnelId = p.personnelId where c.ccId = $ccid and p.personnelType LIKE \"Direct%\"";
			$director_list = mysql_query($director_queue, $dbc);
			$directorCount = mysql_num_rows($director_list);
		}
	}

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
			#footer { height: 67px; width: 540px; left: 210px; top: 610px; position: absolute; visibility: visible; }
			#userinfo { height: 28px; width: 210px; left: 740px; top: 75px; position: absolute; visibility: visible; }
			#mainmenu { height: 48px; width: 500px; left: 450px; top: 88px; position: absolute; z-index: 1; visibility: visible; }
			#idxSearch { height: 37px; width: 360px; left: 20px; top: 101px; position: absolute; visibility: visible; }
			#movieDetails { height: 440px; width: 630px; left: 170px; top: 150px; position: absolute; visibility: visible; }
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
		<div id="movieDetails">
			<div style="position:relative;width:709px;height:457px;-adbe-g:p,10,10;">
				<div style="position:absolute;top:70px;left:12px;width:170px;height:170px;">
					<a href='<?php echo"$movieImage" ?>' target="_blank"><img class="img" src='<?php echo"$movieImage" ?>' alt="" height="164" width="164" align="right" /></a></div>
				<div style="position:absolute;top:290px;left:30px;width:69px;height:19px;">
					<label><span class="pgDetailsSynopsisFont">Synopsis:</span></label></div>
				<div style="position:absolute;top:310px;left:34px;width:567px;height:134px;">
					<table id="synopsisTxtArea" width="567" border="0" cellspacing="2" cellpadding="0" height="134">
						<tr>
							<td align="justify" valign="top"><span class="pgDetailsSynopsis"><?php echo "$movieDescription" ?></span></td>
						</tr>
					</table>
				</div>
				<div style="position:absolute;top:28px;left:10px;width:690px;height:31px;">
					<table width="690" border="0" cellspacing="2" cellpadding="0">
						<tr>
							<td colspan="3"><span class="pgDetailsMovieCaption"><?php echo "$movieTitle" ?> (<?php print date("Y", strtotime($releaseDate)) ?>)</span></td>
						</tr>
					</table>
				</div>
				<div style="position:absolute;top:70px;left:196px;width:504px;height:105px;">
					<table width="500" border="0" cellspacing="2" cellpadding="0">
						<tr>
							<td width="62"><label><span class="pgDetailsFontBold">Starring: </span></label></td>
							<td width="7"></td>
							<td width="427"><span class="pgDetailsFont"><?php
								while (list($personnelId, $personnelFirstname, $personnelLastname) = mysql_fetch_array($actor_list, MYSQL_NUM))
								{ 
									print "<a href=\"personDetails.php?personnelId=$personnelId\">".$personnelFirstname." ".$personnelLastname."</a>";
//									print $personnelFirstname." ".$personnelLastname;
									$actorCount--;
									if ($actorCount<>0)
										print ", ";
									else
										echo ".";
								}
							?></span></td>
						</tr>
						<tr>
							<td width="62"><label><span class="pgDetailsFontBold">Director: </span></label></td>
							<td width="7"></td>
							<td width="427"><span class="pgDetailsFont"><?php
								while (list($personnelId, $personnelFirstname, $personnelLastname) = mysql_fetch_array($director_list, MYSQL_NUM))
								{ 
									print $personnelFirstname." ".$personnelLastname;
									$directorCount--;
									if ($directorCount<>0)
										print ", ";
									else
										echo ".";
								}
							?></span></td>
						</tr>
						<tr>
							<td width="62"><label><span class="pgDetailsFontBold">Rating: </span></label></td>
							<td width="7"></td>
							<td width="427"><span class="pgDetailsFont"><?php echo $rating ?></span></td>
						</tr>
						<tr>
							<td width="62"><label><span class="pgDetailsFontBold">Genre: </span></label></td>
							<td width="7"></td>
							<td width="427"></td>
						</tr>
						<tr>
							<td width="62"><label><span class="pgDetailsFontBold">Length: </span></label></td>
							<td width="7"></td>
							<td width="427"><span class="pgDetailsFont"><?php echo $movieLength ?></span><label><?php echo " "?><span class="pgDetailsFont">min.</span></label></td>
						</tr>
					</table>
				</div>
				<div style="position:absolute;top:240px;left:36px;width:35px;height:14px;">
					<?php
						if($auth->checkAuth())
						{
							if (in_array($movieId, $queueArray))
							{
								// If movie already in queue, disable ability to add movie to queue
								print "<a><img class=\"img\" src='/images/queue/INQueue.png'></a>";
							} else {
								// If movie not in queue, enable ability to add movie
								print "<a href=\"../beta/Queue.php?movieId=$movieId&rmQueue=\"><img class=\"img\" src='/images/queue/AMNormal.png'></a>";
							}
						} else {
							// If movie not in queue, enable ability to add movie	<label>Add To Queue</label>
							print "<a href=\"../beta/Queue.php?movieId=$movieId&rmQueue=\"><img class=\"img\" src='/images/queue/AMNormal.png'></a>";
						}
					?></div>
			</div>
		</div>
		<div id="content">
			<div id="content-inner">
				<div id="contentOnly">
		    		<div id="fullContent" align="center">
						
					</div>
				</div>
			</div>
		</div>
	</body>
</html>