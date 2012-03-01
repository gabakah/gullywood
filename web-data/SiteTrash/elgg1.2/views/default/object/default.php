<?php
	/**
	 * ElggEntity default view.
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.org/
	 */

	if ($vars['full']) {
		echo elgg_view('export/entity', $vars);
	} else {
		
		$icon = elgg_view(
				'graphics/icon', array(
				'entity' => $vars['entity'],
				'size' => 'small',
			)
		);
		
		
		$title = $vars['entity']->title;
		if (!$title) $title = $vars['entity']->name;
		if (!$title) $title = get_class($vars['entity']);
			
		$controls = "";
		if ($vars['entity']->canEdit())
		{
			$controls .= " (<a href="%5c%22%7b$vars%5b'url'%5d%7dactions/entities/delete?guid={$vars['entity']-">guid}\">" . elgg_echo('delete') . "</a>)";
		}
		
		$info = "<div><p><b><a href=%5c%22%22 . $vars['entity']->getUrl() . "\">" . $title . "</a></b> $controls </p></div>";
		
		if (get_input('search_viewtype') == "gallery") {
			
			$icon = "";
			
		} 
		
		$owner = $vars['entity']->getOwnerEntity();
		$ownertxt = elgg_echo('unknown');
		if ($owner)
			$ownertxt = "<a href=%5c%22%22 . $owner->getURL() . "\">" . $owner->name ."</a>";
		
		$info .= "<div>".sprintf(elgg_echo("entity:default:strapline"),
						friendly_time($vars['entity']->time_created),
						$ownertxt
		);
		
		$info .= "</div>";
		
		$info = "<span title=\"" . elgg_echo('entity:default:missingsupport:popup') . "\">$info</span>";
		$icon = "<span title=\"" . elgg_echo('entity:default:missingsupport:popup') . "\">$icon</span>";
	
		echo elgg_view_listing($icon, $info);
	}
