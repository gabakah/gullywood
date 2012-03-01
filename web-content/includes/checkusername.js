// Script 13.3 - checkusername.js

/*	This page does all the magic for applying
 *	Ajax principles to a registration form.
 *	The users's chosen username is sent to a PHP 
 *	script which will confirm its availability.
 */

// Function that starts the Ajax process:
function check_username(memberName) {

	// Confirm that the object is usable:
	if (ajax) { 
		
		// Call the PHP script.
		// Use the GET method.
		// Pass the username in the URL.
		ajax.open('get', '../includes/checkusername.php?memberName=' + encodeURIComponent(memberName));
		
		// Function that handles the response:
		ajax.onreadystatechange = handle_check;
		
		// Send the request:
		ajax.send(null);

	} else { // Can't use Ajax!
		document.getElementById('username_label').innerHTML = 'The availability of this username will be confirmed upon form submission.';
	}
	
} // End of check_username() function.

// Function that handles the response from the PHP script:
function handle_check() {

	// If everything's OK:
	if ( (ajax.readyState == 4) && (ajax.status == 200) ) {

		// Assign the returned value to a document element:
		document.getElementById('username_label').innerHTML = ajax.responseText;
		
	}
	
} // End of handle_check() function.