<?php  
// data tier class
class DoMyqueueId 
{      
  // class constructor
  function __construct()
  {    
    // get the global DbManager instance (created in app_top.php)
    $this->dbManager = $GLOBALS['gDbManager'];
  }    
  // retrieves all departments
  public function GetMyqueueId($user)
  {    
    $query_string = "SELECT myqueueId FROM myqueue WHERE myqueueName = $user";
    $result = $this->dbManager->DbGetOne($query_string);
    return $result;
  }    
} //end DoMyqueueId
?>     
