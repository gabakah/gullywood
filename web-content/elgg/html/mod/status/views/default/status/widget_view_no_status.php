<?php

	/**
	 * Elgg status view when the user does not have a current status set.
	 * 
	 * @package ElggStatus
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 *
	 * @uses $vars['status_owner'], if the page is called by the ajax action. Otherwise, on full page load,
	 * the script uses page_owner().
	 */
	 
    //get the page owner if it is the first load of the page, or the status owner, if the 
	//state has been changed via ajax
	if(page_owner()){
        $owner = page_owner();
	} else {
        $owner = $vars['status_owner'];
	}

	 
	 
?>
<script type="text/JavaScript">
$(document).ready(function(){
       
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
        $("#status_message p").append('<?php echo elgg_echo('status:nostatus'); ?>'); // the current status message
        
    });//end of function
    
    //when the user writes a new status message, grab the required information and submit it
    $("#status_save_button").click(function(){
        
        //display the ajax loading gif at the start of the function call
        $('#status_loading').html('<?php echo elgg_view('ajax/loader',array('slashes' => true)); ?>');
        
        //load the results back into the status area and remove the loading gif
        $("#status_widget_container").load("<?php echo $vars['url']; ?>mod/status/ajax_endpoint/load.php", {status:$("#status_update_input").val()}, function(){
                    $('#status_loading').empty(); // remove the loading gif
                }); //end  
                
    }); // end of the main click function
  
});
</script>


<div id="status_widget_container"><!-- start of status_widget_container -->

    <div class="widget_status_statusmessage"><!-- start of widget_status_statusmessage -->

        <?php
	    
	        //if the user is looking at their own status, display it in a input field to enable editing, otherwise, 
	        //just display as normal
	        if ($owner == $_SESSION['user']->getGUID()) {
    	        
    	?>
    	
    	    <div id="status_message" class="status_input_form">
    	        <textarea id="status_update_input"></textarea>
    	        <p><?php echo elgg_echo('status:nostatus'); ?></p>
    	    </div>
    	
    	   <!-- <p>
    			<textarea id="status_message" class="status_input_form"><?php echo elgg_echo('status:nostatus'); ?></textarea>
    		</p> -->
    		
         <?php 
            } else {
         
  			echo "<p>" . elgg_echo('status:nostatus') . "</p>";
    			
	        }
	    ?>

    
    </div><!-- end of widget_status_statusmessage -->
    
	<?php
	
	        //if the shout owner is looking at it, display the various options
			if ($owner == $_SESSION['user']->getGUID()) {
		
	?>
			    
				<div id="status_update_form"><!-- start of status_update_form -->  
				    <input type="button" id="status_save_button" value="<?php echo elgg_echo('save'); ?>" />
				    <input type="button" id="status_cancel_button" value="<?php echo elgg_echo('cancel'); ?>" />
				</div><!-- end of status_update_form -->
				
				<div id="status_view_history"><!-- start of status view history -->  			
				    <a href="<?php echo $vars['url']; ?>pg/status/<?php echo get_user($vars['entity']->owner_guid)->username; ?>"><?php echo elgg_echo('status:viewhistory'); ?></a>	
				</div><!-- end of status view history -->  
				
	<?php
	
			} //end of status owner if statement
		
    ?>

<!-- loading graphic -->
<div id="status_loading" class="loading">  </div>   

</div><!-- end of status_widget_container -->