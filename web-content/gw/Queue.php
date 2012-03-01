<?php # Queue.php
	/* 
	 *	This page displays the movies in the user queue.
	 */

	// Require the configuration file before any PHP code:
	require_once ('../includes/app_top.php');
	require_once ('../include/process.php');
	require_once ('../gw/DoQueue.php');
	
	$db = &DB::connect($dsn);
	// set fetchmode
	$db->setFetchMode(DB_FETCHMODE_ASSOC);
//	$db->setOption('portability', DB_PORTABILITY_ALL | DB_PORTABILITY_NUMROWS);
	$auth= new Auth('DB', $options);
	// Confirm authorization:
	if(!$auth->checkAuth())
	{
		header("Location:Login.php");				// If user not logged in, route to login page.
	}

	// This class constructs the array that list the movies that will display on the Queue Page
	class QueueList
	{
		public $result;
	
		// class constructor initializes the data tier object
	  	function __construct($queueId)
  		{    
    		$this->mDoQueue = new DoQueue($queueId);
  		}
  		
  		function init()
  		{
	    	$this->result = $this->mDoQueue->ListQueue();	
  		}
  		
  		function movieDelete($movieId)
  		{
	    	$this->result = $this->mDoQueue->DeleteFromQueue($movieId);	
  		}
  		
  		function queueReorder($queueOrder, $movieId, $queueId, $movieCount, $reorderArray)
  		{
	    	$this->result = $this->mDoQueue->ReOrderQueue($queueOrder, $movieId, $queueId, $movieCount, $reorderArray);	
  		}
    }
    
	// Initialize the movieId
	$movieId = NULL;
	$queueId = NULL;
	$errorMsg = NULL;
	$rmQueue = NULL;
	$screenSize = NULL;
	$queueOrder = NULL;
	$movieCount = NULL;
	$movieStatus = 'Available Now';
	$myqueue_row = NULL;
	$queue_query = NULL;
	$showQueue_row = NULL;
	$myqueue_query = NULL;
	$showQueue_query = NULL;
	$availabilityCount = NULL;
	$inventoryNum = NULL;
	$inventoryNum_query = NULL;
	$inventoryNum_query_row = NULL;

    // Get the movieId passed from previous webpage
	$movieId = $_GET['movieId'];
	$rmQueue = $_GET['rmQueue'];
	// get the queue Id
	$myqueue_query =& $db->query("SELECT queueId FROM myqueue WHERE myqueueName ='".$auth->getUsername()."'", array());
	$myqueue_row = array();
	while ( $myqueue_query->fetchInto( $myqueue_row ))
	{
		$queueId = $myqueue_row['queueId'];
	}
	$myqueue_query->free();

	$queue_query =& $db->query("SELECT * FROM queue WHERE queueId = $queueId AND queueOrder > 0", array());
	if (PEAR::isError($queue_query)) {
		die($queue_query->getMessage() . ', ' . $queue_query->getDebugInfo());
	}
	$queueOrder = $queue_query->numRows ();				// Total number of movies active in the user queue		
	$queueOrder++;										// Increment count to position at bottom of the queue
	$queue_query->free();
	
    // Initiate the variable used for the Movie List
    $queue_list = new QueueList($queueId);
	
    // Initiate the variable used for the Movie List
    $delete_queue = new QueueList($queueId);
    
	// Delete movie from the queue
	if ($rmQueue==1)
	{
	    // Get the total count of movies in the user queue
		$movieCount_query =& $db->query("SELECT * FROM queue WHERE queueId = $queueId AND queueOrder > 0", array());
		if (PEAR::isError($movieCount_query)) {
			die($movieCount_query->getMessage() . ', ' . $movieCount_query->getDebugInfo());
		}
		$movieCount = $movieCount_query->numRows ();				// Total number of movies active in the user queue		
		$movieCount_query->free();
		
	    // Create the array to be passed to the ReOrderQueue function
		$delete_queue_query =& $db->query("SELECT queueOrder FROM queue WHERE queueId = $queueId AND movieId = $movieId", array());
		$reorderArray = array();
		$delete_queue_query->fetchInto($reorderArray);
					
		if (PEAR::isError($delete_queue_query)) {
			die($delete_queue_query->getMessage() . ', ' . $delete_queue_query->getDebugInfo());
		}
	    
	    $delete_queue->movieDelete($movieId);
	    
	    $k = $reorderArray['queueOrder'];
		for ($i = ($reorderArray['queueOrder'] + 1); $i <= $movieCount; $i++)
	  	{
	  		$reOrderQueue_query =& $db->query("UPDATE queue SET queueOrder = $k WHERE queueId = $queueId AND queueOrder = $i");
	  		$k++;
	  	}
	  	$delete_queue_query->free();
  		$rmQueue = 0;
	    $queue_list->init();
	    $movieId = 0;
	    $movieCount = 0;
		$queueOrder--;
	}

	if ($movieId == 0)
	{
	    $queue_list->init();
	}

	if ($movieId > 0)
	{
		// Check if the movie is already in the queue
		$queue_query =& $db->query("SELECT * FROM queue WHERE queueId = $queueId AND movieId = $movieId AND queueOrder > 0", array());
		$movieCount = $queue_query->numRows ();
		$queue_query->free();
		if ($movieCount > 0)									// Movie already exists
		{
			// Display message
			echo "Movie already in your queue";
		} else {
			// Check inventory for available movie
			$screenSize = "FullScreen";
//			$inventoryNum_query =& $db->query("SELECT inventoryNum FROM inventory WHERE movieId = $movieId AND screenSize = $screenSize AND availability = 1", array());
			$inventoryNum_query =& $db->query("SELECT inventoryNum, availability FROM inventory WHERE movieId = $movieId AND availability = 1", array());
			if (PEAR::isError($inventoryNum_query)) 
			{
				die($inventoryNum_query->getMessage() . ', ' . $inventoryNum_query->getDebugInfo());
			}
			$availabilityCount = $inventoryNum_query->numRows ();				// Total number of available movies that are in the inventory
			if ($availabilityCount == 0)
			{
				//$inventoryNum_query->free();
				$movieStatus = 'Short Wait';
				// Get an inventory number that has already been used. It will be queued until it is available.
//				$no_InventoryNum_query =& $db->query("SELECT inventoryNum FROM inventory WHERE movieId = $movieId AND screenSize = $screenSize", array());
				$no_InventoryNum_query =& $db->query("SELECT inventoryNum, availability FROM inventory WHERE movieId = $movieId", array());
				$no_InventoryNum_query_row = array();
				if (PEAR::isError($no_InventoryNum_query)) 
				{
					die($no_InventoryNum_query->getMessage() . ', ' . $no_InventoryNum_query->getDebugInfo());
				}
				
				$no_InventoryNum_query->fetchInto( $no_InventoryNum_query_row );

				$inventoryNum = $no_InventoryNum_query_row['inventoryNum'];
					
//				$no_InventoryNum_query->free();
//				echo $inventoryNum;
			} else {
				$movieStatus = 'Available Now';			
				$inventoryNum_query_row = array();
				while ( $inventoryNum_query->fetchInto( $inventoryNum_query_row ))
				{
					$inventoryNum = $inventoryNum_query_row['inventoryNum'];
				}
//				echo $inventoryNum;
				$inventoryNum_query->free();
			}
			
			// Use PEAR DB to insert data into queue table
			$addToQueue = array('queueId' => $queueId, 'queueOrder' => $queueOrder, 'dateRequested' => date('Y-m-d'), 'movieId' => $movieId, 'inventoryNum' => $inventoryNum, 'availabilityStatus' => $movieStatus);
			$db->autoExecute('queue', $addToQueue, DB_AUTOQUERY_INSERT);

			if ($availabilityCount > 0)
			{
				$inventoryNum_update = $db->query ( "UPDATE inventory SET availability = 0 WHERE inventoryNum='". $inventoryNum ."'");
			}
			
		    // Populate the variable with movie data
		    $queue_list->init();
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
		<title>Gullywood Online :: My Queue Page</title>
		<link href="../css/basic.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../css/test.css" rel="stylesheet" type="text/css" media="all" />
		<style type="text/css" media="screen"><!--
			#footer { height: 67px; width: 540px; left: 250px; top: 1070px; position: absolute; visibility: visible; }
			#userinfo { height: 28px; width: 210px; left: 740px; top: 75px; position: absolute; visibility: visible; }
			#mainmenu { height: 48px; width: 500px; left: 450px; top: 88px; position: absolute; z-index: 1; visibility: visible; }
			#idxSearch { height: 37px; width: 360px; left: 20px; top: 101px; position: absolute; visibility: visible; }
		--></style>
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
				<li><a href="http://www.energizer.com/_layouts/Energizer/images/backend/common/background.gif">Media Center</a></li>
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
		<form id="FormName" action="(EmptyReference!)" method="get" name="FormName">
			<div style="position:relative;width:950px;height:885px;-adbe-g:p,10,10;">
				<div style="position:absolute;top:278px;left:778px;width:160px;height:600px;">
					<img src="../images/movies/CN_Archos_MusicHere_sweepstakes_160x600.jpg" alt="" width="160" height="600" border="0" /></div>
				<div style="position:absolute;top:40px;left:30px;width:733px;height:51px;">
					<table width="731" border="1" cellspacing="1" cellpadding="0" bgcolor="#f2f2f2">
						<tr>
							<td colspan="5" width="721"></td>
						</tr>
						<tr>
							<td align="center" width="88"><label>Queue Order</label></td>
							<td align="center" valign="middle" width="366"><label>Title</label></td>
							<td align="center" valign="middle" width="125"><label>Availability</label></td>
							<td align="center" valign="middle" width="62"><label>Purchase</label></td>
							<td align="center" valign="middle" width="72"><label>Remove</label></td>
						</tr>
						<?php
						// Print entire Movie queue
						for ( $i = 0; $i < $queueOrder -1; $i++ )
						{
							if ($queue_list->result[$i]['availability'] = 0) 
							{
								$movieStatus = 'Short Wait';
							} else {
								$movieStatus = 'Available Now';
							}
							print "<tr align=\"center\">";
							print "<td width=\"92\"><input type=\"text\" name=\"textfieldName\" size=\"3\" value=".$queue_list->result[$i]['queueOrder']." /></td>";
							print "<td align=\"left\" width=\"366\"><label><a href=\"Details.php?movieId=".$queue_list->result[$i]['movieId']." \">".$queue_list->result[$i]['movieTitle']."</a></label></td>";
							print "<td align=\"center\" width=\"125\"><label>". $queue_list->result[$i]['availabilityStatus'] ."</label></td>";
							print "<td width=\"62\"></td>";
							print "<td width=\"72\"><a href=\"Queue.php?movieId=".$queue_list->result[$i]['movieId']."&queueId=".$queueId."&rmQueue=1 \">X</a></td>";
							print "</tr>";
						}
					?>
					</table>
				</div>
			</div>
		</form>
		<div id="content">
			<div id="content-inner">
				<div id="contentOnly">
		    		<div id="fullContent" align="center"></div>
				</div>
	</body>
</html>