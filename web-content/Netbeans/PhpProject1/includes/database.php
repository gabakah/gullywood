<?php
// reference the PEAR DB library
require_once ('Auth.php');
require_once ('DB.php');
// class providing generic data access functionality
class DbManager
{
  public $db;
  // open database connection in the constructor
  function __construct($connectionString)
  {
    $this->db = DB::connect($connectionString,USE_PERSISTENT_CONNECTIONS);
    if (DB::isError($this->db))
       trigger_error($this->db->getMessage(), E_USER_ERROR);
    $this->db->setFetchMode(DB_FETCHMODE_ASSOC);
  }
  // close the connection
  public function DbDisconnect()
  {
    $this->db->disconnect();
  }
  public function DbQuery($queryString)
  {
    $result = $this->db->query($queryString);
    if (DB::isError($result))
       trigger_error($result->getMessage(), E_USER_ERROR);
    return $result;
  }
  // wrapper class for PEAR DB's getAll() method
  public function DbGetAll($queryString)
  {
    $result = $this->db->getAll($queryString);
    if (DB::isError($result))
       trigger_error($result->getMessage(), E_USER_ERROR);
    return $result;
  }
  // wrapper class for PEAR DB's getRow() method
  public function DbGetRow($queryString)
  {
    $result = $this->db->getRow($queryString);
    if (DB::isError($result))
       trigger_error($result->getMessage(), E_USER_ERROR);
    return $result;
  }
  // wrapper class for PEAR DB's getOne() method
  public function DbGetOne($queryString)
  {
    $result = $this->db->getOne($queryString);
//    if (DB::isError($result))
//       trigger_error($result->getMessage(), E_USER_ERROR);
    return $result;
  }
}
?>