<?
/**
 * Database.php
 * 
 * The Database class is meant to simplify the task of accessing
 * information from the website's database.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 17, 2004
 */
include("constants.php");
      
class MySQLDB
{
   var $connection;         //The MySQL database connection
   var $num_active_users;   //Number of active users viewing site
   var $num_active_guests;  //Number of active guests viewing site
   var $num_members;        //Number of signed-up users
   /* Note: call getNumMembers() to access $num_members! */

   /* Class constructor */
   function MySQLDB(){
      /* Make connection to database */
      $this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
      mysql_select_db(DB_NAME, $this->connection) or die(mysql_error());
      
      /**
       * Only query database to find out number of members
       * when getNumMembers() is called for the first time,
       * until then, default value set.
       */
      $this->num_members = -1;
      
      if(TRACK_VISITORS){
         /* Calculate number of users at site */
         $this->calcNumActiveUsers();
      
         /* Calculate number of guests at site */
         $this->calcNumActiveGuests();
      }
   }

   /**
    * confirmUserPass - Checks whether or not the given
    * memberName is in the database, if so it checks if the
    * given memberPassword is the same memberPassword in the database
    * for that user. If the user doesn't exist or if the
    * memberPasswords don't match up, it returns an error code
    * (1 or 2). On success it returns 0.
    */
   function confirmUserPass($memberName, $memberPassword){
      /* Add slashes if necessary (for query) */
      if(!get_magic_quotes_gpc()) {
	      $memberName = addslashes($memberName);
      }

      /* Verify that user is in database */
      $q = "SELECT memberPassword FROM ".TBL_USERS." WHERE memberName = '$memberName'";
      $result = mysql_query($q, $this->connection);
      if(!$result || (mysql_numrows($result) < 1)){
         return 1; //Indicates memberName failure
      }

      /* Retrieve memberPassword from result, strip slashes */
      $dbarray = mysql_fetch_array($result);
      $dbarray['memberPassword'] = stripslashes($dbarray['memberPassword']);
      $memberPassword = stripslashes($memberPassword);

      /* Validate that memberPassword is correct */
      if($memberPassword == $dbarray['memberPassword']){
         return 0; //Success! memberName and memberPassword confirmed
      }
      else{
         return 2; //Indicates memberPassword failure
      }
   }
   
   /**
    * confirmmemberId - Checks whether or not the given
    * memberName is in the database, if so it checks if the
    * given memberId is the same memberId in the database
    * for that user. If the user doesn't exist or if the
    * memberIds don't match up, it returns an error code
    * (1 or 2). On success it returns 0.
    */
   function confirmmemberId($memberName, $memberId){
      /* Add slashes if necessary (for query) */
      if(!get_magic_quotes_gpc()) {
	      $memberName = addslashes($memberName);
      }

      /* Verify that user is in database */
      $q = "SELECT memberId FROM ".TBL_USERS." WHERE memberName = '$memberName'";
      $result = mysql_query($q, $this->connection);
      if(!$result || (mysql_numrows($result) < 1)){
         return 1; //Indicates memberName failure
      }

      /* Retrieve memberId from result, strip slashes */
      $dbarray = mysql_fetch_array($result);
      $dbarray['memberId'] = stripslashes($dbarray['memberId']);
      $memberId = stripslashes($memberId);

      /* Validate that memberId is correct */
      if($memberId == $dbarray['memberId']){
         return 0; //Success! memberName and memberId confirmed
      }
      else{
         return 2; //Indicates memberId invalid
      }
   }
   
   /**
    * memberNameTaken - Returns true if the memberName has
    * been taken by another user, false otherwise.
    */
   function memberNameTaken($memberName){
      if(!get_magic_quotes_gpc()){
         $memberName = addslashes($memberName);
      }
      $q = "SELECT memberName FROM ".TBL_USERS." WHERE memberName = '$memberName'";
      $result = mysql_query($q, $this->connection);
      return (mysql_numrows($result) > 0);
   }
   
   /**
    * memberNameBanned - Returns true if the memberName has
    * been banned by the administrator.
    */
   function memberNameBanned($memberName){
      if(!get_magic_quotes_gpc()){
         $memberName = addslashes($memberName);
      }
      $q = "SELECT memberName FROM ".TBL_BANNED_USERS." WHERE memberName = '$memberName'";
      $result = mysql_query($q, $this->connection);
      return (mysql_numrows($result) > 0);
   }

   /**
    * addNewCustomer - Inserts the given info into the database.
    * Returns true on success, false otherwise.
    */
   function addNewCustomer($customerName, $mailingAddress1, $mailingAddress2, $mailingCity, $mailingState, $mailingZipcode,
   						   $phoneNumber, $billingAddress1, $billingAddress2, $billingCity, $billingState, $billingZipcode,
   						   $ccType, $ccNumber, $ccCode, $ccExpiration)
   {
      $q = "INSERT INTO ".TBL_CUSTOMERS." VALUES (NULL, '$customerName', '$mailingAddress1', '$mailingAddress2', 
      '$mailingCity', '$mailingState', '$mailingZipcode', '$phoneNumber', '$billingAddress1', '$mailingAddress2',
      '$billingCity', '$billingState', '$billingZipcode', 'No Status', '$ccType', '$ccNumber', '$ccCode', '$ccExpiration',
      $billingZipcode, 'True')";
      return mysql_query($q, $this->connection);
   }
   
   /**
    * addNewMyQueue - Inserts the given info into the database.
    * Returns true on success, false otherwise.
    */
   function addNewMyQueue($myqueueName)
   {
      $time = time();   
      $q = "INSERT INTO ".TBL_MYQUEUE." VALUES (NULL, '$myqueueName', $time )";
      return mysql_query($q, $this->connection);
   }

   /**
    * addNewUser - Inserts the given (memberName, memberPassword, email)
    * info into the database. Appropriate user level is set.
    * Returns true on success, false otherwise.
    */
   function addNewUser($memberName, $memberPassword, $firstName, $lastName, $userEmail, $phoneNumber, $customerId, $myqueueId,
   					   $securityQuestion, $securityAnswer, $membershipPlan )
   {
      $time = time();
      /* If admin sign up, give admin user level */
      if(strcasecmp($memberName, ADMIN_NAME) == 0){
         $ulevel = ADMIN_LEVEL;
      }else{
         $ulevel = USER_LEVEL;
      }
      $q = "INSERT INTO ".TBL_USERS." VALUES (NULL, '$memberName', '$memberPassword', '$firstName', '$lastName', '$userEmail',
      'Approved', '$phoneNumber', '', '$customerId', '$myqueueId', '$securityQuestion', '$securityAnswer', '$membershipPlan',
      $time, '', 0, $ulevel)";
      return mysql_query($q, $this->connection);
   }
   
   /**
    * updateUserField - Updates a field, specified by the field
    * parameter, in the user's row of the database.
    */
   function updateUserField($memberName, $field, $value){
      $q = "UPDATE ".TBL_USERS." SET ".$field." = '$value' WHERE memberName = '$memberName'";
      return mysql_query($q, $this->connection);
   }
   
   /**
    * getUserInfo - Returns the result array from a mysql
    * query asking for all information stored regarding
    * the given memberName. If query fails, NULL is returned.
    */
   function getUserInfo($memberName){
      $q = "SELECT * FROM ".TBL_USERS." WHERE memberName = '$memberName'";
      $result = mysql_query($q, $this->connection);
      /* Error occurred, return given name by default */
      if(!$result || (mysql_numrows($result) < 1)){
         return NULL;
      }
      /* Return result array */
      $dbarray = mysql_fetch_array($result);
      return $dbarray;
   }
   
   /**
    * getNumMembers - Returns the number of signed-up users
    * of the website, banned members not included. The first
    * time the function is called on page load, the database
    * is queried, on subsequent calls, the stored result
    * is returned. This is to improve efficiency, effectively
    * not querying the database when no call is made.
    */
   function getNumMembers(){
      if($this->num_members < 0){
         $q = "SELECT * FROM ".TBL_USERS;
         $result = mysql_query($q, $this->connection);
         $this->num_members = mysql_numrows($result);
      }
      return $this->num_members;
   }
   
   /**
    * calcNumActiveUsers - Finds out how many active users
    * are viewing site and sets class variable accordingly.
    */
   function calcNumActiveUsers(){
      /* Calculate number of users at site */
      $q = "SELECT * FROM ".TBL_ACTIVE_USERS;
      $result = mysql_query($q, $this->connection);
      $this->num_active_users = mysql_numrows($result);
   }
   
   /**
    * calcNumActiveGuests - Finds out how many active guests
    * are viewing site and sets class variable accordingly.
    */
   function calcNumActiveGuests(){
      /* Calculate number of guests at site */
      $q = "SELECT * FROM ".TBL_ACTIVE_GUESTS;
      $result = mysql_query($q, $this->connection);
      $this->num_active_guests = mysql_numrows($result);
   }
   
   /**
    * addActiveUser - Updates memberName's last active timestamp
    * in the database, and also adds him to the table of
    * active users, or updates timestamp if already there.
    */
   function addActiveUser($memberName, $time){
      $q = "UPDATE ".TBL_ACTIVE_USERS." SET timestamp = '$time' WHERE memberName = '$memberName'";
   //   $q = "INSERT INTO ".TBL_ACTIVE_USERS." VALUES ('$memberName', '$time')";
      // timestamp = '$time' WHERE memberName = '$memberName'";
      mysql_query($q, $this->connection);
      
      if(!TRACK_VISITORS) return;
      $q = "REPLACE INTO ".TBL_ACTIVE_USERS." VALUES ('$memberName', '$time')";
      mysql_query($q, $this->connection);
      $this->calcNumActiveUsers();
   }
   
   /* addActiveGuest - Adds guest to active guests table */
   function addActiveGuest($ip, $time){
      if(!TRACK_VISITORS) return;
      //$q = "UPDATE ".TBL_ACTIVE_GUESTS." VALUES ('$ip', '$time')";
      //$q = "REPLACE INTO ".TBL_ACTIVE_GUESTS." VALUES ('$ip', '$time')";
      $q = "INSERT INTO ".TBL_ACTIVE_GUESTS." VALUES ('$ip', '$time')";
      mysql_query($q, $this->connection);
      $this->calcNumActiveGuests();
   }
   
   /* These functions are self explanatory, no need for comments */
   
   /* removeActiveUser */
   function removeActiveUser($memberName){
      if(!TRACK_VISITORS) return;
      $q = "DELETE FROM ".TBL_ACTIVE_USERS." WHERE memberName = '$memberName'";
      mysql_query($q, $this->connection);
      $this->calcNumActiveUsers();
   }
   
   /* removeActiveGuest */
   function removeActiveGuest($ip){
      if(!TRACK_VISITORS) return;
      $q = "DELETE FROM ".TBL_ACTIVE_GUESTS." WHERE ip = '$ip'";
      mysql_query($q, $this->connection);
      $this->calcNumActiveGuests();
   }
   
   /* removeInactiveUsers */
   function removeInactiveUsers(){
      if(!TRACK_VISITORS) return;
      $timeout = time()-USER_TIMEOUT*60;
      $q = "DELETE FROM ".TBL_ACTIVE_USERS." WHERE timestamp < $timeout";
      mysql_query($q, $this->connection);
      $this->calcNumActiveUsers();
   }

   /* removeInactiveGuests */
   function removeInactiveGuests(){
      if(!TRACK_VISITORS) return;
      $timeout = time()-GUEST_TIMEOUT*60;
      $q = "DELETE FROM ".TBL_ACTIVE_GUESTS." WHERE timestamp < $timeout";
      mysql_query($q, $this->connection);
      $this->calcNumActiveGuests();
   }
   
   /**
    * query - Performs the given query on the database and
    * returns the result, which may be false, true or a
    * resource identifier.
    */
   function query($query){
      return mysql_query($query, $this->connection);
   }
};

/* Create database connection */
$database = new MySQLDB;

?>
