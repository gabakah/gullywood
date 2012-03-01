<?php  
// data tier class
class DoCustomerId 
{      
  // class constructor
  function __construct()
  {    
    // get the global DbManager instance (created in app_top.php)
    $this->dbManager = $GLOBALS['gDbManager'];
  }    
  // retrieves all departments
  public function GetCustomerId($user)
  {    
    $query_string = "SELECT customerId FROM customer WHERE customerName = $user";
    $result = $this->dbManager->DbGetOne($query_string);
    return $result;
  }    
} //end DoCustomerId
?>     
