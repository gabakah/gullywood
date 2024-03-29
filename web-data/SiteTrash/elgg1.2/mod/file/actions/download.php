<?php
	/**
	 * Elgg file browser download action.
	 * 
	 * @package ElggFile
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

	// Get the guid
	$file_guid = get_input("file_guid");
	
	// Get the file
	$file = get_entity($file_guid);
	
	if ($file)
	{
		$mime = $file->getMimeType();
		if (!$mime) $mime = "application/octet-stream";
		
		$filename = $file->originalfilename;
		
		header("Content-type: $mime");
		if (strpos($mime, "image/")!==false)
			header("Content-Disposition: inline; filename=\"$filename\"");
		else
			header("Content-Disposition: attachment; filename=\"$filename\"");

		echo $file->grabFile();
		exit;
	}
	else
		register_error(elgg_echo("file:downloadfailed"));
?>