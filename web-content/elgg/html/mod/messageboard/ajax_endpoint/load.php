<?php

    /**
	 * Elgg message board widget ajax logic page
	 *
	 * @package ElggMessageBoard
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

    // Load Elgg engine will not include plugins
     require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
    
    //get the required info
    
    //the actual message
    $message = get_input('messageboard_content');
    //the number of messages to display
    $numToDisplay = get_input('numToDisplay');    
    //get the full page owner entity
    $user = get_entity($_POST['pageOwner']);
    
    //stage one - if a message was posted, add it as an annotation    
    if($message){
        
       //attach the annotation to the user object
       $user->annotate('messageboard',$message,$user->access_id, $_SESSION['user']->getGUID()); 
        
    } else {
        
        echo "Something went wrong when trying to save your message, make sure you actually wrote a message.";
        
    }
    
    //step two - grab the latest messageboard contents, this will include the message above, unless an issue 
    //has occurred.
    $contents = $user->getAnnotations('messageboard', $numToDisplay, 0, 'desc'); 
    
    //step three - display the latest results
    if($contents){
        
        foreach($contents as $content) {
				
			echo elgg_view("messageboard/messageboard_content", array('annotation' => $content));
				
		}
        
    }

    
?>