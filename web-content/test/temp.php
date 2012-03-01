<?php

	// Initialize the movieId
	$movieId = NULL;
	$queueId = NULL;
	$screenSize = NULL;
	$queueOrder = NULL;
	$movieCount = NULL;
	$movieStatus = NULL;
	$myqueue_row = NULL;
	$queue_query = NULL;
	$showQueue_row = NULL;
	$myqueue_query = NULL;
	$showQueue_query = NULL;
	$availabilityCount = NULL;
	$inventoryNum_query = NULL;
	$inventoryNum_query_row = NULL;
	
    // Get the movieId passed from previous webpage
	$movieId = $_GET['movieId'];
	
	if ($movieId != NULL)
	{
		// get the queue Id
		$myqueue_query =& $db->query("SELECT queueId FROM myqueue WHERE myqueueName ='".$auth->getUsername()."'", array());
		$myqueue_row = array();
		while ( $myqueue_query->fetchInto( $myqueue_row ))
		{
			$queueId = $myqueue_row['queueId'];
		}
		$myqueue_query->free();
  		
		// Check if the movie is already in the queue
		$queue_query =& $db->query("SELECT * FROM queue WHERE queueId = $queueId AND movieId = $movieId AND queueOrder > 0", array());
		$movieCount = $queue_query->numRows ();
		$queue_query->free();
		if ($movieCount > 0)									// Movie already exists
		{
			// Display message
			echo $movieCount;
		} else {
			// Get total count of movies in the user queue
			$queue_query =& $db->query("SELECT * FROM queue WHERE queueId = $queueId AND queueOrder > 0", array());
			$queueOrder = $queue_query->numRows ();				// Total number of movies active in the user queue		
			$queueOrder++;										// Increment count to position at bottom of the queue
			$queue_query->free();
		
			// Check inventory for available movie
			$screenSize = 'FullScreen';
			$inventoryNum_query =& $db->query("SELECT inventoryNum FROM inventory WHERE movieId = $movieId AND screenSize = $screenSize AND availability = 1", array());
			$availabilityCount = $inventoryNum_query->numRows ();				// Total number of available movies that are in the inventory
			if ($availabilityCount = 0)
			{
				$inventoryNum_query->free();
				$movieStatus = 'Short Wait';
				$inventoryNum_query =& $db->query("SELECT inventoryNum FROM inventory WHERE movieId = $movieId AND screenSize = $screenSize", array());
			} else {
				$movieStatus = 'Available Now';			
			}
			$inventoryNum_query_row = array();
			while ( $inventoryNum_query->fetchInto( $inventoryNum_query_row ))
			{
				$inventoryNum = $inventoryNum_query_row['inventoryNum'];
			}
			$inventoryNum_query->free();
			
			// Use PEAR DB to insert data into queue table
			$addToQueue = array('queueId' => $queueId, 'queueOrder' => $queueOrder, 'dateRequested' => time(), 'movieId' => $movieId, 'inventoryNum' => $inventoryNum);
			$db->autoExecute('queue', $data, DB_AUTOQUERY_INSERT);
		}
		
//		$showQueue_query =& $db->query("SELECT * FROM queue WHERE queueId = $queueId AND movieId = $movieId ORDER BY queueOrder ASC", array());
//		$showQueue_row = array();
//		while ( $showQueue_query->fetchInto( $myqueue_row ))
//		{
//			$queueId = $showQueue_row['queueId'];
//		}
//		$showQueue_query->free();
	}
?>