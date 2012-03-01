<?php # Script 2.4 - index.php
	/* 
	 *	This is the main page.
	 *	This page includes the configuration file, 
	 *	the templates, and any content-specific modules.
	 */

	// Require the configuration file before any PHP code:		
	require_once ('../includes/app_top.php');
	require_once ('../include/process.php');
	require_once ('../gw/DoMemberCatalog.php');
	
	$db = &DB::connect($dsn);
	// set fetchmode
	$db->setFetchMode(DB_FETCHMODE_ASSOC);
	$auth= new Auth('DB', $options);
	// Confirm authorization:
	if(!$auth->checkAuth())
	{
		header("Location:Login.php");
	}

	// This class constructs the array that list the movies that will display on the Member Page
	class MovieList
	{
		public $result;
	
		// class constructor initializes the data tier object
	  	function __construct()
  		{    
    		$this->mDoMemberCatalog = new DoMemberCatalog();
  		}
  		
  		function init()
  		{
	    	$this->result = $this->mDoMemberCatalog->GetMovies();	
  		}
    }
    
    // Initiate the variable used for the Movie List
    $movie_list = new MovieList();
    
    // Populate the variable with movie data
    $movie_list->init();
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta http-equiv="imagetoolbar" content="false" />
		<title>Gullywood Online :: Member's  Page</title>
		<link href="../css/basic.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../css/test.css" rel="stylesheet" type="text/css" media="all" />
		<style type="text/css" media="screen"><!--
			#footer { height: 67px; width: 540px; left: 250px; top: 1070px; position: absolute; visibility: visible; }
			#userinfo { height: 28px; width: 210px; left: 740px; top: 75px; position: absolute; visibility: visible; }
			#mainmenu { height: 48px; width: 500px; left: 450px; top: 88px; position: absolute; z-index: 1; visibility: visible; }
			#idxSearch { height: 37px; width: 360px; left: 20px; top: 101px; position: absolute; visibility: visible; }
		--></style>
		<meta name="keywords" content="African DVD, African DVD Rental, African Movies, African Netflix, Caribbean Movies, 
					Caribbean Movie Rental, Diaspora movies, Gullywood, Ghana Films, Ghanaian Films, Ghanaian Movies, Kenyan Films, 
					Kenyan Movies, Nigerian Films, Nigerian Movies, Nollywood, Senegalese Films, Senegalese Movies, South African Films, 
					south African Movies, tribal, Witchcraft movies, Yoruba" />
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
				<li><a href="/beta/Queue.php?movieId=0&rmQueue=0&dateRequested=">Queue</a></li>
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
		<div style="position:relative;width:1018px;height:964px;-adbe-g:p,10,10;">
			<div style="position:absolute;top:278px;left:857px;width:160px;height:600px;">
				<img src="../images/movies/CN_Archos_MusicHere_sweepstakes_160x600.jpg" alt="" width="160" height="600" border="0" /></div>
			<div style="position:absolute;top:54px;left:180px;width:652px;height:813px;">
				<table width="652" border="0" cellspacing="2" cellpadding="0" height="813">
					<tr height="197">
						<td align="center" valign="top" width="160" height="197"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[0]['movieId'] ?>">
						<?php echo $movie_list->result[0]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[0]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[0]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[0]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="197"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[1]['movieId'] ?>">
						<?php echo $movie_list->result[1]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[1]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[1]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[1]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="197"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[2]['movieId'] ?>">
						<?php echo $movie_list->result[2]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[2]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[2]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[2]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="197"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[3]['movieId'] ?>">
						<?php echo $movie_list->result[3]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[3]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[3]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[3]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
					</tr>
					<tr height="205">
						<td align="center" valign="top" width="160" height="205"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[4]['movieId'] ?>">
						<?php echo $movie_list->result[4]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[4]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[4]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[4]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="205"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[5]['movieId'] ?>">
						<?php echo $movie_list->result[5]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[5]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[5]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[5]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="205"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[6]['movieId'] ?>">
						<?php echo $movie_list->result[6]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[6]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[6]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[6]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="205"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[7]['movieId'] ?>">
						<?php echo $movie_list->result[7]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[7]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[7]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[7]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
					</tr>
					<tr height="202">
						<td align="center" valign="top" width="160" height="202"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[8]['movieId'] ?>">
						<?php echo $movie_list->result[8]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[8]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[8]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[8]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="202"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[9]['movieId'] ?>">
						<?php echo $movie_list->result[9]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[9]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[9]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[9]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="202"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[10]['movieId'] ?>">
						<?php echo $movie_list->result[10]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[10]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[10]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[10]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="202"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[11]['movieId'] ?>">
						<?php echo $movie_list->result[11]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[11]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[11]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[11]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
					</tr>
					<tr height="180">
						<td align="center" valign="top" width="160" height="180"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[12]['movieId'] ?>">
						<?php echo $movie_list->result[12]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[12]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[12]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[12]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="180"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[13]['movieId'] ?>">
						<?php echo $movie_list->result[13]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[13]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[13]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[13]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="180"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[14]['movieId'] ?>">
						<?php echo $movie_list->result[14]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[14]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[14]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[14]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
						<td align="center" valign="top" width="160" height="180"><label class="title"><a href="Details.php?movieId=<?php echo $movie_list->result[15]['movieId'] ?>">
						<?php echo $movie_list->result[15]['movieTitle'] ?></a></label><br />
							<a href="Details.php?movieId=<?php echo $movie_list->result[15]['movieId'] ?>">
							<img class="img" src="<?php echo $movie_list->result[15]['movieImage'] ?>" alt="" width="130" height="130" border="0" /></a><br />
							<label><a href="Queue.php?movieId=<?php echo $movie_list->result[15]['movieId'] ?>&rmQueue=">Add to Queue</a></label></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>