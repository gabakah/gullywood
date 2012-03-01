<?php  
// data tier class
class DoMemberCatalog 
{      
  // class constructor
  function __construct()
  {    
    // get the global DbManager instance (created in app_top.php)
    $this->dbManager = $GLOBALS['gDbManager'];
  }    
  // retrieves the first 16 of the latest movies
  public function GetMovies()
  {    
    $query_string = "SELECT movieId, movieTitle, movieImage, movieDescription FROM movie ORDER BY activatedDate DESC LIMIT 16";
    $result = $this->dbManager->DbGetAll($query_string);
    return $result;
  }    
} //end DoMemberCatalog
?>