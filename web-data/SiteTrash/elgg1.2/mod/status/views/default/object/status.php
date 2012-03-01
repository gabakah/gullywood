<?php

	/**
	 * Elgg status individual view
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
        
        //set the status wrapper div
        echo "<div class=\"status_message\">";
        
            //select the correct message div depending on whether it is the current message
            //or not
            if($vars['entity']->state == "current"){		
    		
                echo "<div class=\"status_statusmessage\">";
            
            }else{
            
                echo "<div class=\"status_statusmessage_history\">";
            
            }
?>

	
	
	        <!-- the status message -->
			    <?php

				    echo parse_urls(elgg_view("output/longtext",array("value" => $vars['entity']->description)));
	
			    ?>
		
		</div><!-- end widget_status_statusmessage or widget_status_statusmessage_history div-->
				
	    <!-- display the time the status message was posted -->
		<div class="widget_status_messagetimestamp"><!-- open widget_status_messagetimestamp div -->
		    <p>
		        <?php
		
		            echo elgg_echo("status:set") . " " . sprintf(elgg_echo("status:strapline"),
								friendly_time($vars['entity']->time_created));
			
		        ?>
		    </p>
		</div><!-- close widget_status_messagetimestamp div -->
		
		<?php
            
		    //if the shout owner is looking at it, display the delete link
			if ($vars['entity']->canEdit()) {
				
			?>
				<?php
				
					echo elgg_view("output/confirmlink", array(
																'href' => $vars['url'] . "action/status/delete?status=" . $vars['entity']->getGUID(),
																'text' => elgg_echo('status:delete'),
																'confirm' => elgg_echo('deleteconfirm'),
															));
				
				?>
			<?php
			
			}
		
		?>
		
	

<?php

        echo "</div>"; //close the status wrapper div

    }//end of initial isset if statement
		
?>