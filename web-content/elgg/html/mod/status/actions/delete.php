<?php

	/**
	 * Elgg status: delete status action
	 * 
	 * @package ElggStatus
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.org/
	 */

	// Make sure we're logged in (send us to the front page if not)
		if (!isloggedin()) forward();

	// Get input data
		$guid = (int) get_input('status');
		
	// Make sure we actually have permission to edit and that the object is of type 'status'
		$status = get_entity($guid);
		if ($status->getSubtype() == "status" && $status->canEdit()) {
	
		// Get owning user
				$owner = get_entity($status->getOwner());
		// Delete it!
				$rowsaffected = $status->delete();
				if ($rowsaffected > 0) {
		// Success message
					system_message(elgg_echo("status:deleted"));
				} else {
					register_error(elgg_echo("status:notdeleted"));
				}
		// Forward to the main status page
				forward("mod/status/?username=" . $owner->username);
		
		}
		
?>