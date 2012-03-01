<?php

	/**
	 * Elgg status index page
	 * 
	 * @package ElggStatus
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

	// Load Elgg engine
		require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
		
	// Get the current page's owner
		$page_owner = page_owner_entity();
		if ($page_owner === false || is_null($page_owner)) {
			$page_owner = $_SESSION['user'];
			set_page_owner($page_owner->getGUID());
		}
		
	// Display user's status messages
		$area1 = "<div id=\"status_messages\">";
		$area1 .= elgg_view_title(elgg_echo('status:messages')); // set the title
		$area1 .= list_user_objects($page_owner->getGUID(),'status'); // display the user's status messages
		$area1 .= "</div>";
		
    //select the correct canvas area
	    $body = elgg_view_layout("two_column_left_sidebar", '', $area1);
		
	// Display page
		page_draw(sprintf(elgg_echo('status:user'),$page_owner->name),$body);
		
?>