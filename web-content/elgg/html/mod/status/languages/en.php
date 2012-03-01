<?php

	$english = array(
	
		/**
		 * Menu items and titles
		 */
	
			'status' => "Status",
			'status:user' => "%s's status",
			'status:current'=> "Current status",
			'status:desc'=> "This status widget shows your latest status.",
			'status:posttitle' => "%s's status: %s",
			'status:everyone' => "All site status",
			'status:strapline' => "%s",
			'status:addstatus' => "Set your status",
		    'status:messages' => "Status messages",
			'status:text' => "Status:",
			'status:set' => "set ",
			'status:clear' => "clear status",
			'status:delete' => "delete status",
			'status:nostatus' => "No status has been set.",
			'status:viewhistory' => "view history",
	
			'item:object:status' => 'Status messages',
	
	
        /**
	     * Status river
	     **/
	        
	        //generic terms to use
	        'status:river:created' => "%s updated",
	        
	        //these get inserted into the river links to take the user to the entity
	        'status:river:create' => "their status.",
	        
	        
	
		/**
		 * Status messages
		 */
	
			'status:posted' => "Your new status was successfully posted.",
			'status:deleted' => "Your status was successfully deleted.",
	
		/**
		 * Error messages
		 */
	
			'status:blank' => "Sorry; you need to actually write a status message before we can save it.",
			'status:notfound' => "Sorry; we could not find the specified status message.",
			'status:notdeleted' => "Sorry; we could not delete this status message.",
			'status:notsaved' => "Something has gone wrong when saving, please try again or check with your adminstrator.",
			'status:problem' => "There has been a problem. It looks like you can't edit this status.",
	
	);
					
	add_translation("en",$english);

?>