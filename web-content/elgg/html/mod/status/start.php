<?php

	/**
	 * Elgg status plugin
	 * This plugin lets user set a status message
	 * 
	 * @package ElggStatus
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

	/**
	 * status initialisation
	 *
	 * These parameters are required for the event API, but we won't use them:
	 * 
	 * @param unknown_type $event
	 * @param unknown_type $object_type
	 * @param unknown_type $object
	 */

		function status_init() {
			
			// Load system configuration
				global $CONFIG;
				
			// Load the language file
				register_translations($CONFIG->pluginspath . "status/languages/");
				
			// Extend system CSS with our own styles, which are defined in the status/css view
				extend_view('css','status/css');
				
			// Register a page handler, so we can have nice URLs
				register_page_handler('status','status_page_handler');
				
			// Register a URL handler for status posts
				register_entity_url_handler('status_url','object','status');
				
			// Your status widget
			    add_widget_type('status',elgg_echo("status:current"),elgg_echo("status:desc"));
			    
		}
		
		/**
		 * status page handler; allows the use of fancy URLs
		 *
		 * @param array $page From the page_handler function
		 * @return true|false Depending on success
		 */
		function status_page_handler($page) {
			
			// The first component of a status URL is the username
			if (isset($page[0])) {
				set_input('username',$page[0]);
			}
			
			// The second part dictates what we're doing
			if (isset($page[1])) {
				switch($page[1]) {
					case "read":		set_input('statuspost',$page[2]);
										@include(dirname(__FILE__) . "/read.php");
										break;
					case "friends":		// TODO: add friends status page here
										break;
				}
			// If the URL is just 'status/username', or just 'status/', load the standard status index
			} else {
				@include(dirname(__FILE__) . "/index.php");
				return true;
			}
			
			return false;
			
		}

		function status_url($statuspost) {
			
			global $CONFIG;
			return $CONFIG->url . "pg/status/" . $statuspost->getOwnerEntity()->username;
			
		}
	
	// Make sure the status initialisation function is called on initialisation
		register_elgg_event_handler('init','system','status_init');
		
	// Register actions
		global $CONFIG;
		register_action("status/delete",false,$CONFIG->pluginspath . "status/actions/delete.php");
		
?>