<?php

    /**
	 * Elgg status widget ajax clear page. This lets a user clear there current status on the profile 
	 * widget. It is not the same a delete!
	 *
	 * @package ElggStatus
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

    // Load Elgg engine without including plugins
     require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
     
    //the current status guid
    $status_guid = $_POST['status_guid'];
    
    //get the status object
    $status = get_entity($status_guid);
    
    //check that the object is of type 'status' and that the logged in user can edit it
    if ($status->getSubtype() == "status" && $status->canEdit()) {
        
        //clear it by changing the state to history
			$status->state = "history";
			
		//Display the no status view
   	        echo elgg_view("status/widget_view_no_status", array('status_owner' => $status->owner_guid));
			
	} else {
    	
    	echo elgg_echo("status:problem");
    	
	}
	
?>