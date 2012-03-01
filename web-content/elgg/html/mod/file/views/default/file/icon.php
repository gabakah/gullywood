<?php
	/**
	 * Elgg file icons.
	 * Displays an icon, depending on its mime type, for a file. 
	 * Optionally you can specify a size.
	 * 
	 * @package ElggFile
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

	global $CONFIG;
	
	$mime = $vars['mimetype'];
	if (isset($vars['thumbnail'])) {
		$thumbnail = $vars['thumbnail'];
	} else {
		$thumbnail = false;
	}
	
	$size = $vars['size'];
	if ($size != 'large') {
		$size = 'small';
	}
	
	// Handle 
	switch ($mime)
	{
		case 'image/jpg' 	:
		case 'image/jpeg' 	:
		case 'image/png' 	:
		case 'image/gif' 	:
		case 'image/bmp' 	: 
			//$file = get_entity($file_guid);
			if ($thumbnail) {
				if ($size == 'small') {
					echo "<img src=\"{$vars['url']}action/file/icon?file_guid={$vars['file_guid']}\" border=\"0\" />";
				} else {
					echo "<img src=\"{$vars['url']}mod/file/thumbnail.php?file_guid={$vars['file_guid']}\" border=\"0\" />";
				}
				
			} else 
			{
				if ($size == 'large') {
					echo "<img src=\"{$CONFIG->wwwroot}mod/file/graphics/icons/general_lrg.gif\" border=\"0\" />";
				} else {
					echo "<img src=\"{$CONFIG->wwwroot}mod/file/graphics/icons/general.gif\" border=\"0\" />";
				}
			}
			
		break;
		default :
			if (!empty($mime) && elgg_view_exists("file/icon/{$mime}", $vars)) {
				echo elgg_view("file/icon/{$mime}", $vars);
			} else if (!empty($mime) && elgg_view_exists("file/icon/" . substr($mime,0,strpos($mime,'/')) . "/default", $vars)) {
				echo elgg_view("file/icon/" . substr($mime,0,strpos($mime,'/')) . "/default", $vars);
			} else {
				echo "<img src=\"{$CONFIG->wwwroot}mod/file/graphics/icons/general.gif\" border=\"0\" />";
			}	 
		break;
	}

?>