<?php

    /**
	 * Elgg status widget ajax logic page
	 *
	 * @package ElggStatus
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

    // Load Elgg engine without including plugins
     require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
     
    //get the required info
    
    //the actual message
    $status_message = get_input('status');
    
    //the previous status message guid, if available - this is required so that we can 
    //set its state to 'history'
    $previous_status_guid = $_POST['last_status'];
    
    //stage one - if a message was posted, create a new status object  
    if($status_message){
        
        // Initialise a new ElggObject
			$status = new ElggObject();
	    // Tell the system it's a status post
			$status->subtype = "status";
	    // Set its owner to the current user
			$status->owner_guid = $_SESSION['user']->getGUID();
	    // For now, set its access to public (we'll add an access dropdown shortly)
			$status->access_id = 2;
	    // Set its description appropriately, this is the status
			$status->description = $status_message;
			
	    //set the state metadata field; state=history is your old status messages, state=current is the latest one
	        $status->state = "current";
	    // Before we can set metadata, we need to save the status post
			if (!$status->save()) {
				echo elgg_echo("status:notsaved");
			} else {
    			
    			
			    //now set the previous status message, if one exists, to a history state
			    $previous_status = get_entity($previous_status_guid);
			    if ($previous_status && $previous_status->getSubtype() == "status" && $previous_status->canEdit()){
    			    
    			    //set the metadata
    			    $previous_status->state = "history";
    			    
			    }
			    
		    }
	    
        
    } else {
        
        echo elgg_echo("status:blank");
        
    }
    
    //step two - grab the new status 
   
    $get_status = get_entities_from_metadata("state", "current", "object", "status", $_SESSION['user']->getGUID());
		
    
    //step three - display the status
		if (is_array($get_status) && sizeof($get_status) > 0) {
			
			foreach($get_status as $status) {
    			
				echo elgg_view("status/widget_view", array('entity' => $status));
				
			}
			
		} else {
    		
    		echo elgg_echo("status:nostatus");
    		
		}
    
?>