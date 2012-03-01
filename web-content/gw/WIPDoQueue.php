<?php  
// data tier class
class DoQueue
{
	public $doQueueId;
	public $doMovieId;
	public $doDateRequested;
	
	// class constructor
  	function __construct($queueId)
	{    
    	// get the global DbManager instance (created in app_top.php)
    	$this->dbManager = $GLOBALS['gDbManager'];
    	// Initialize the queueId for the user
  		$this->doQueueId = $queueId;
  	}
  
  	// retrieves all the movies listed in the users queue
  	public function ListQueue()
  	{    
//		$showQueue_query = "SELECT a.queueId, a.queueOrder, a.movieId, b.movieTitle, c.availability FROM queue a INNER JOIN movie b on a.movieId = b.movieId INNER JOIN inventory c on c.movieId = b.movieId WHERE a.queueId = $this->doQueueId ORDER BY a.queueOrder ASC";
//		$showQueue_query = "SELECT a.queueId, a.queueOrder, a.movieId, b.movieTitle FROM queue a INNER JOIN movie b on a.movieId = b.movieId WHERE a.queueId = $this->doQueueId ORDER BY a.queueOrder ASC";
//		$showQueue_query = "SELECT a.queueId, a.queueOrder, a.movieId, a.dateRequested, b.movieTitle FROM queue a INNER JOIN movie b on a.movieId = b.movieId WHERE a.queueId = $this->doQueueId ORDER BY a.queueOrder ASC";
		$showQueue_query = "SELECT mq.queueId, a.queueId, a.queueOrder, a.movieId, a.dateRequested, b.movieTitle FROM member m INNER JOIN myqueue mq on m.myqueueId = mq.myqueueId INNER JOIN queue a INNER JOIN movie b on a.movieId = b.movieId WHERE mq.queueId = $this->doQueueId ORDER BY a.queueOrder ASC";
    	$result = $this->dbManager->DbGetAll($showQueue_query);
    	return $result;
  	}
  
  	public function DeleteFromQueue($movieId, $dateRequested)
  	{
  		$this->doMovieId = $movieId;
  		$this->doDateRequested = $dateRequested;
		// Remove selected movie from queue
// 		$deleteFromQueue_query = "DELETE FROM queue WHERE queueId = $this->doQueueId AND movieId = $this->doMovieId AND dateRequested = $this->doDateRequested";
 		$deleteFromQueue_query = "DELETE FROM queue WHERE queueId = $this->doQueueId AND movieId = $this->doMovieId";
    	$result = $this->dbManager->DbQuery($deleteFromQueue_query);
    	return $result;
  	}
  
  	public function ReOrderQueue()
  	{
  		// Reorder the queue list
  	}
} //end DoQueue
?>