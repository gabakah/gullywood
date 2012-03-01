<?php
	/**
	 * Elgg file saver
	 * 
	 * @package ElggFile
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	gatekeeper();

	// Render the file upload page
	
	$file = (int) get_input('file_guid');
	$title = elgg_view_title($title = elgg_echo('file:edit'));
	if ($file = get_entity($file)) {
		if ($file->canEdit()) { 
    		$area2 = elgg_view("file/upload",array('entity' => $file));
			$body = elgg_view_layout('two_column_left_sidebar', '', $title . $area2);
			page_draw(elgg_echo("file:upload"), $body);
		}
	} else {
		forward();
	}
	
?>