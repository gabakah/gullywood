<?php

	// Require the configuration file before any PHP code:		
	require_once ('../includes/app_top.php');
	require_once ('../include/process.php');
	require_once ('../gw/DoMemberCatalog.php');
	
	$db = &DB::connect($dsn);
	// set fetchmode
	$db->setFetchMode(DB_FETCHMODE_ASSOC);
	$auth= new Auth('DB', $options);
	// Confirm authorization:
//	if(!$auth->checkAuth())
//	{
//		header("Location:Login.php");
//	}

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

	// Array indexes are 0-based, jCarousel positions are 1-based.
//	$first = max(0, intval($_GET['first']) - 1);
//	$last  = max($first + 1, intval($_GET['last']) - 1);

//	$length = $last - $first + 1;

	// ---
$first = 0;
$last = 15;

//	$total    = count($images);
//	$total    = count($movie_list);
//	$selected = array_slice($movie_list->result[0], $first, $length);
	$selected = array_slice($movie_list->result[15], 0, 5);

	header('Content-Type: text/xml');

	echo '<data>';

	// Return total number of images so the callback
	// can set the size of the carousel.
//	echo '  <total>' . $total . '</total>';
	
	for ($i = 0; $i < 16; $i++)
	{
		$total = $i;
		echo '	<movie>';
		echo '	<movieId>' . $movie_list->result[$i]['movieId'] . '</movieId>';
		echo '	<movieTitle>' . $movie_list->result[$i]['movieTitle'] . '</movieTitle>';
//		echo '	<movieDescription>' . $movie_list->result[$i]['movieDescription'] . '</movieDescription>';
		echo '	<movieImage>' . $movie_list->result[$i]['movieImage'] . '</movieImage>';
		echo '	</movie>';
	}
	echo '  <total>' . $total . '</total>';
	echo '</data>';

?>