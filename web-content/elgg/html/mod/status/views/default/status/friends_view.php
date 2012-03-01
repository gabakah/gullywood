<?php

	/**
	 * Elgg status friends view. This is used when you look at your friends list.
	 * 
	 * @package ElggStatus
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 *
	 * @uses $vars['entity'] Optionally, the status message to view
	 */
	 
		if (isset($vars['entity'])) {
    		
    		
?>

<div class="friends_status"><!-- start the friends status message -->
     
	<div class="friends_status_message">
	
	    <!-- display the message -->
        <p>
    			<?php
    				echo elgg_echo("status") . ": " . parse_urls(elgg_view("output/text",array("value" => $vars['entity']->description)));
    			?>
        </p>
    		
    </div><!-- end friends_status_message -->
				
    <div class="status_timestamp">
		<p><small>
		<?php
		
		    //display the time posted
		    echo elgg_echo("status:set") . " " . sprintf(elgg_echo("status:strapline"),
								friendly_time($vars['entity']->time_created));
			
		?>
		</small></p>
	</div><!-- close  div -->
	
</div><!-- end the friends status message -->
	
<?php

		}

?>