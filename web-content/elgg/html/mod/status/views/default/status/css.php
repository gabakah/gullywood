<?php

	/**
	 * Elgg status CSS extender
	 * 
	 * @package ElggStatus
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

?>

/* status clear and cancel buttons */
#status_clear #status_clear_button,
#status_update_form #status_cancel_button {

	font: 11px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #999999;
	background:#dddddd;
	border: 1px solid #999999;
	-webkit-border-radius: 3px; 
	-moz-border-radius: 3px;
	width: auto;
	padding:1px 3px 1px 3px;
	margin:5px 0 5px 0;
	cursor: pointer;

}

#status_clear #status_clear_button:hover,
#status_update_form #status_cancel_button:hover {
	color: #ffffff;
	background:#0054a7;
}

/* status save button */
#status_update_form #status_save_button {
	font: 11px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:#4690d6;
	border: 1px solid #4690d6;
	-webkit-border-radius: 3px; 
	-moz-border-radius: 3px;
	width: auto;
	padding: 1px 3px 1px 3px;
	margin:5px 10px 5px 0;
	cursor: pointer;
}

#status_update_form #status_save_button:hover {
	background: #0054a7;
}

/* current displayed status message */
#status_message p,
.widget_status_statusmessage p {
	font-size:1.2em;
	line-height:1.2em;
	font-weight:bold;
	color:#666666;
	padding:3px;
	margin:0;	
}

/* widget status box - input */
.widget_status_statusmessage {
/*
	font-size:1.2em;
	line-height:1.2em;
	font-weight:bold;
*/
	color:#666666;
	background:#fdffc3;
	padding:3px;
}
/* widget status box - time */
.widget_status_messagetimestamp {
	font-size:0.9em;
	color:#999999;
	margin:0;
}

#status_update_form {
	display:none;
}

.status_input_form {
	border:0;
	background:transparent;
}

.status_input_form:focus {
	border: none;
	background:transparent;
	color:#333333;
}
/* textarea for writing new message */
#status_update_input {
	display:none;
	background:transparent;
	border:none;
	font-size:1.2em;
	line-height:1.2em;
	font-weight:bold;
	color:#666666;
	padding:3px;
	width:274px;
	height:66px;
}


/* status messages history */

/* wraps each status msg */
.status_message {
	border-bottom: 1px solid #aaaaaa;
	margin:10px 0 10px 0;
}
/* current status message */
.status_statusmessage p {
	margin:0;
	color:#666666;
	background:#fdffc3;
	padding:10px;
	font-size: 1.5em;
	line-height: 1.1em;
}
/* previous status messages */
.status_statusmessage_history p {
	margin:0;
}
/* status message timestamp */
.widget_status_messagetimestamp p {
	margin:0;
}


/* friends status on 'friends' page */
.friends_status {
	float:right;
	width:370px;
	text-align:right;
	margin: 0 4px 0 0;
	padding:0;
}
.friends_status p {
	margin: 0;
	padding:0;
	line-height:1.1em;
}
.friends_status_message {
	height:29px;
	overflow:hidden;
}
.status_timestamp {
	color:#666666;
	margin:0;
	padding:0;
}
/* IE 6 fix */
* html .friends_status p { 
	line-height:1.3em;
}
* html .friends_status_message {
	height: 30px;
}
/* IE7 */
*:first-child+html .friends_status_message {
	height: 30px;
}
*:first-child+html .friends_status p { 
	line-height:1.3em;
}




