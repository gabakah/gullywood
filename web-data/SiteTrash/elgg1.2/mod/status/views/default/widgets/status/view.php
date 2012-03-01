<?php

    /**
	 * Elgg status plugin view page
	 *
	 * @package ElggStatus
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

    // Get any status posts to display
	// Get the current page's owner
	$page_owner = page_owner_entity();
	if ($page_owner === false || is_null($page_owner)) {
		$page_owner = $_SESSION['user'];
	    set_page_owner($page_owner->getGUID());
	}
		
	//get the user's current status - this is determined by the metadata field on the status object state=current
	$status_message = get_entities_from_metadata("state", "current", "object", "status", $page_owner->getGUID());
		
		
	// If there is a current status message, view it
	if (is_array($status_message) && sizeof($status_message) > 0) {
			
		foreach($status_message as $status) {
    			
			echo elgg_view("status/widget_view", array('entity' => $status));
			
	    }
			
	} else {
    		
    	echo elgg_view("status/widget_view_no_status");
    		
	}
	
?>