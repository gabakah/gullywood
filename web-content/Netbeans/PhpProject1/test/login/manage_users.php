<?php	
	require_once('settings.php');
	include ( 'lib/Pagination.php' );
	checkLogin ( '1' );
	
	$active_users		=	$db->RecordCount ( "SELECT ID FROM `users` WHERE `Active` = 1" );
	$inactive_users		=	$db->RecordCount ( "SELECT ID FROM `users` WHERE `Active` = 0" );
	$suspended_users	=	$db->RecordCount ( "SELECT ID FROM `users` WHERE `Active` = 2" );
	
	$which_users		=	( numeric ( $_GET['active'] ) ) ? $_GET['active'] : '1';
	
	$pagination = new Pagination();
	$pagination->start = ( @$_GET['start'] ) ? $_GET['start'] : '0';
	$pagination->filePath = APPLICATION_URL . 'manage_users.php';
	$pagination->select_what = '*';
	$pagination->the_table = '`' . DBPREFIX . 'users`';
	$pagination->add_query = ' WHERE `Active` = ' . $db->qstr ( $which_users ) . ' ORDER BY `ID` DESC';
	$pagination->otherParams = '&active=' . $which_users;
	
	$query = $pagination->getQuery ( TRUE );
	$paginate = $pagination->paginate();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>roScripts.com - PHP Login System With Admin Features</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css" />
	<script type="text/JavaScript">
	<!--
		function MM_jumpMenu(targ,selObj,restore){ //v3.0
		  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		  if (restore) selObj.selectedIndex=0;
		}
	//-->
	</script>
<!--
                     ____                               __
                    /\  _`\                  __        /\ \__
          _ __   ___\ \,\L\_\    ___   _ __ /\_\  _____\ \ ,_\   ____
         /\`'__\/ __`\/_\__ \   /'___\/\`'__\/\ \/\ '__`\ \ \/  /',__\
         \ \ \//\ \L\ \/\ \L\ \/\ \__/\ \ \/ \ \ \ \ \L\ \ \ \_/\__, `\
          \ \_\ \____/\ `\____\ \____\ \_\  \ \_\ \ ,__/\ \__\/\____/
           \/_/ \/___/  \/_____/\/____/ \/_/   \/_/\ \ \/  \/__/\/___/
                                                    \ \_\
                                                     \/_/
                                                Making your world easy
-->
</head>

<body>
	
	<div id="container" style="text-align:center;width:400px;">
	
		<TABLE width="98%">
			
			<caption>users control panel for <?=get_username ( $_SESSION['user_id'] )?></caption>
		
			<thead>
				<tr>
					<th><DIV align="center"><a href="manage_users.php"><b>Active</b></a></DIV></th>
					<th><DIV align="center"><a href="manage_users.php?active=0"><b>Inactive</b></a></DIV></th>
					<th><DIV align="center"><a href="manage_users.php?active=2"><b>Suspended</b></a></DIV></th>
				</tr>
			</thead>
			
			<tr>	
				<td width="60px"><DIV align="center"><b><?=$active_users?></b></DIV></td>
				<td width="60px"><DIV align="center"><b><?=$inactive_users?></b></DIV></td>
				<td width="60px"><DIV align="center"><b><?=$suspended_users?></b></DIV></td>
			</tr>
			
		</table>

		<div style="margin:20px 0 20px">
		
		<TABLE border="0" cellpadding="4" cellspacing="3" width="98%">
			
			<caption>users list</caption>
			
			<thead>
				<tr>
					<th><DIV align="center">&nbsp;</DIV></th>
					<th><DIV align="left"><b>Username</b></DIV></th>
					<th><DIV align="center"><b>Options</b></DIV></th>
				</tr>
			</thead>
<?php
	$nr = 1;
	if ( $db->RecordCount ( $query ) > 0 )
	{
		$users = $db->get_results ( $query );
		require_once ( BASE_PATH . "/lib/date_class/date.php" );
		$date = new DateClass ();//Create the date class instance

		foreach ( $users as $row ):
?>
			<tr>
				<th><DIV align="center"><b><?=$nr?></b></DIV></th>
				<td><DIV align="left" style="padding-left:8px"><?=$row->Username?><em>Registered on: <?=$date->ToString( 'd-M-Y', $row->date_registered )?></em></DIV></td>
				<td width="60">
					<DIV align="center">
					
						<select name="option" onChange="MM_jumpMenu('parent',this,0)">
							
							<option>----------</option>
<?php
						if ( $row->Active == 1 || $row->Active == 0 ):
?>
							<option value="admin_options.php?ID=<?=$row->ID?>&action=suspend&active=<?=$_GET['active']?>&start=<?=$_GET['start']?>">Suspend</option>
<?php 
						endif;
?>
							
<?php
						if ( $row->Active == 0 || $row->Active == 2 ):
?>
							<option value="admin_options.php?ID=<?=$row->ID?>&action=activate&active=<?=$_GET['active']?>&start=<?=$_GET['start']?>">Activate</option>
<?php
						endif;
?>
							<option value="admin_options.php?ID=<?=$row->ID?>&action=delete&active=<?=$_GET['active']?>&start=<?=$_GET['start']?>">Delete</option>
							
						</select>
					
					</DIV>
				</td>
			</tr>
<?php
	$nr++;
		endforeach;
	}
	else {
?>
			<tr>
				<td colspan="3">No users to display</td>
			</tr>
<? } ?>
				
		</table>
		
		</div>

		<?=$paginate;?>
		
		<a href="logout.php">logout</a>
	
	</div>
	
</body>

</html>