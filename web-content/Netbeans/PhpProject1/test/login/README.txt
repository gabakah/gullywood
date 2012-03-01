/* 
		This is a php login script by roScripts
		Author: Mihalcea Romeo office@roscripts.com http://www.roscripts.com
		License: GPL
*/

==================================================================================
	HOW TO INSTALL
==================================================================================
	Run install.php in your browser and enter the configuration details
	If you have any problems, you can use the SQL file attached (database.sql)



==================================================================================
	WHERE TO ASK HELP
==================================================================================
	For any help please use the forums. I won't respond to direct 
	emails that require programming help http://www.roscripts.com/forum



==================================================================================
	HOW TO CREATE ADMIN USER
==================================================================================
	To create an admin user you need to change the level access to any user to 1.



==================================================================================
	HOW TO APPLY RESTRICTIONS
==================================================================================
	Simply use the checkLogin() functions at the top of your file with the allowed 
	levels inside the paranthesis



==================================================================================
	FROM THE DATABASE:
==================================================================================
	Level_access 
	
		1 = admin
		2 = normal user
	
	Active
	
		0 = inactive
		1 = active
		2 = suspended



==================================================================================
	TO DISPLAY CONTENT ONLY TO LOGGED IN MEMBERS:
==================================================================================
	<?php
		if ( $_SESSION['logged_in'] ):
	?>
			Content here
	<?php
		endif;
	?>



===================================================================================
	TO DISPLAY CONTENT ONLY TO MEMBERS THAT ARE NOT LOGGED IN:
===================================================================================
	<?php
		if ( ! $_SESSION['logged_in'] ):
	?>
			Content here
	<?php
		endif;
	?>



===================================================================================
	TO DISPLAY CONTENT ONLY TO ADMIN(S):
===================================================================================
	<?php
		if ( isadmin ( $_SESSION['user_id'] ) ):
	?>
			Content here
	<?php
		endif;
	?>