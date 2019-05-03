<?php
require_once('connect2.php'); // import page
// import reminder checker
$email=$_GET['email'];

if(isset($_REQUEST['submit']))
{
	if(!empty($_REQUEST['title']))
	{
		
		$title = addslashes(ucwords($_REQUEST['title']));
		$desc = addslashes(ucfirst($_REQUEST['description']));	
	
		$sql->dbQuery("insert into contacts (title,description,email)values('$title','$desc','$email')"); // add reminder
	}
	else
	{
	$Status_message = "Title  missing, no reminder added";
	}
}
$Result = $sql->dbQuery("select * from `contacts` where email='$email'");
$Reminder_Result = $sql->dbQuery("SELECT * FROM `contacts` where email='$email'"); // select expired reminders
?>
<!DOCTYPE html >
<html>
<head>
<meta content="charset=UTF-8" />
<title>MyDairy</title>
<link rel="stylesheet" href="css2/style.css" />
<link rel="stylesheet" href="css2/ui-lightness/jquery-ui-1.8.18.custom.css">
<script src="js2/jquery-1.7.1.min.js"></script>
<script src="js2/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js2/jquery.ui.tabs.js"></script>
<script>			
		$(function() {
					$( "#tabs" ).tabs();
				});
				
</script>
</head>
<body>
<div id="Container" >
	<div id="tabs">
		<ul>
			<li><a href="#tabs-3">All contacts</a></li>
			<li><a href="#tabs-2">Add contacts</a></li>
			<div><li><a href="dashboard.php">Dashboard</a></li></div>
			<div><li style="float:right;"><a href="./index.php">Logout</a></li></div>

		</ul>
		
		
		
			
		<div id="tabs-2">		
				<form name="add_reminder" action="" method="post">
					<table width="60%" border="0">
					<tr>
					<td colspan="2" align="center" id="message"></td>
					</tr>
				  <tr>
					<td width="32%">Title</td>
					<td><input type="text" name="title" ></td>
				  </tr>
				  <tr>
					<td>Phone number</td>
					<td><input type="text" name="description" id="description" maxlength="10"></td>
					</tr>
				 
				  <tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Save contact" name="submit" /></td>
				  </tr>
				</table>
				</form>
		</div>
		
		<div id="tabs-3">
					<?php 					
			while($row = $sql->dbFetchAssoc($Result)){?>
			<div id="reminder"  >
			<a href="edit2.php?id=<?php echo $row['id']?>&email=<?php echo $email?>">
			<?php echo $row['title'];?>
			</a>

			</div>
			<?php }
			$sql->dbFreeResult($Result); ?>		
		</div>				
		
	</div>
</div>
</body>
</html>