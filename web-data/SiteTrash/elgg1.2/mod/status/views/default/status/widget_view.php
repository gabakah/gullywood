<?php

	/**
	 * Elgg status view and edit for the widget
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
<script type="text/JavaScript">
$(document).ready(function(){
       
    //function to clear the current status
    $("#status_clear_button").click(function(){
        
        //display the ajax loading gif at the start of the function call
        $('#status_loading').html('<?php echo elgg_view('ajax/loader',array('slashes' => true)); ?>');
        
        //send the status guid to the clear.php end point to have its state changed to 'history'
        $("#status_widget_container").load("<?php echo $vars['url']; ?>mod/status/ajax_endpoint/clear.php", 
            {status_guid:<?php echo $vars['entity']->guid; ?>}); //end  
        
    });//end of function
    
    //when a user clicks into the message area, clear the current message and display the required menu option
    //while hiding the menu options not required
    $("#status_message").click(function(){
        
        $('#status_message p').empty(); //clear the previous status message
        $('#status_update_input').show().focus(); //display the hidden textarea
        $('#status_update_form').show(); //show the required menu options
        $('#status_clear').hide(); //hide the clear message button
       
    });//end of function
    
    //if the user decides not to proceed with a new status message, hide the submit controls and 
    //put the current status back. 
    $("#status_cancel_button").click(function(){
        
        //sort out the various fields 
        $('#status_update_form').hide();
        $('#status_update_input').val('').hide(); //empty any content and hide the hidden textarea
        $('#status_clear').show();
        $("#status_message p").append('<?php echo addslashes(str_replace("\r", ' ', str_replace("\n", ' ', $vars['entity']->description))); ?>'); // the current status message
        
    });//end of function
    
    //when the user has written a new message submit the details to the required end point for processing
    $("#status_save_button").focus(function(){
        
        //display the ajax loading gif at the start of the function call
        $('#status_loading').html('<?php echo elgg_view('ajax/loader',array('slashes' => true)); ?>');
        
        //load the results back into the main status_widget_container div and remove the loading gif
        $("#status_widget_container").load("<?php echo $vars['url']; ?>mod/status/ajax_endpoint/load.php", {status:$("#status_update_input").val(), last_status:<?php echo $vars['entity']->guid; ?>}, function(){
                    $('#status_loading').empty(); // remove the loading gif
                }); //end  
                
    }); // end of function
  
}); //end of function
</script>


<div id="status_widget_container"><!-- start of status_widget_container div -->

    <!-- display the status message -->
	<div class="widget_status_statusmessage"><!-- start of widget_status_statusmessage div -->
	
	    <?php
	    
	        //if the user is looking at their own status message, display it in a input field to enable editing, otherwise, 
	        //just display as normal
	        if ($vars['entity']->canEdit()) {
    	        
    	?>
    	
    	    <div id="status_message" class="status_input_form">
    	        <textarea id="status_update_input"></textarea>
    	        <p><?php echo str_replace("\r", ' ', str_replace("\n", ' ', $vars['entity']->description)); ?></p>
    	    </div>
    		
         <?php 
            } else {
         ?>

    		<p>
    			<?php
    				echo parse_urls(elgg_view("output/longtext",array("value" => $vars['entity']->description)));
    			?>
    		</p>
    		
    	<?php 
	        }
	    ?>
    	
    </div><!-- end of widget_status_statusmessage div -->
				
    <!-- display the timestamp -->
    <div class="widget_status_messagetimestamp"><!-- start of widget_status_messagetimestamp div -->
		<p>
		<?php
		
		    echo elgg_echo("status:set") . " " . sprintf(elgg_echo("status:strapline"),
								friendly_time($vars['entity']->time_created));
			
		?>
		</p>
	</div><!-- close widget_status_messagetimestamp div -->
		
	<?php

	    // if the status owner is looking at it, display the relevant options
		if ($vars['entity']->canEdit()) {
		
			?>
			    
				<div id="status_update_form"><!-- start of status_update_form div -->
				    <input type="button" id="status_save_button" value="save" />
				    <input type="button" id="status_cancel_button" value="cancel" />
				</div><!-- end of status_update_form div -->   			
				
				<div id="status_clear"><!-- start of status clear div -->
				    <input type="button" id="status_clear_button" value="<?php echo elgg_echo('status:clear'); ?>" />
				</div><!-- end of of status clear div -->
				
	<?php
			
		} // end of owner options if statement
		
	?>
		
	<!-- display the show history link -->
	<a href="<?php echo $vars['url']; ?>pg/status/<?php echo get_user($vars['entity']->owner_guid)->username; ?>"><?php echo elgg_echo('status:viewhistory'); ?></a>
		
	<!-- loading graphic -->
    <div id="status_loading" class="loading">  </div>   

</div><!-- end of status_widget_container -->

<?php

	} // end of entity check if statement on line 15

?>