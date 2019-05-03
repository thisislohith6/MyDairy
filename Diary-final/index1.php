<?php
require_once('connect1.php'); // import page
require_once('checkreminder1.php'); // import reminder checker
/*if(isset($_SESSION['user_email'])){
    echo $_SESSION['user_email'];
}*/
$email=$_GET['email'];
if(isset($_REQUEST['submit']))
{
	if(!empty($_REQUEST['title']) & !empty($_REQUEST['date']))
	{
		
		if($_REQUEST['date']<=date('Y-m-d')) // if selected is in future or not?
		{
		$flag = '0'; // if it is today or before, make it expired.
		$Status_message = "Event set is expired.";
		}
		else
		{
		$flag = '1'; 
		}
		$title = addslashes(ucwords($_REQUEST['title']));
		$desc = addslashes(ucfirst($_REQUEST['description']));	
	
		$sql->dbQuery("insert into reminders (title,email,description,date,flag)values('$title','$email','$desc','$_REQUEST[date]','$flag')"); // add reminder
	}
	else
	{
	$Status_message = "Title or date missing, no events added";
	}
}


$test=1;
$Result = $sql->dbQuery("select * from `reminders` WHERE flag = '$test' and email='$email'");
$Reminder_Result = $sql->dbQuery("SELECT * FROM `reminders` WHERE flag = '$test' and email='$email'"); // select expired reminders
?>
<!DOCTYPE html >
<html>
<head>
<meta content="charset=UTF-8" />
<title>MyDairy</title>
<link rel="stylesheet" href="css1/style.css" />
<link rel="stylesheet" href="css1/ui-lightness/jquery-ui-1.8.18.custom.css">
<script src="js1/jquery-1.7.1.min.js"></script>
<script src="js1/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js1/jquery.ui.datepicker.js"></script>
<script src="js1/jquery.ui.tabs.js"></script>
<script>			
		$(function() {
					$( "#tabs" ).tabs();
				});
				$(function() {
		$( "#date" ).datepicker();
	});
</script>
</head>
<body>
<div id="Container" >
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Events</a></li>
			<li><a href="#tabs-2">Add Events</a></li>
			<li><a href="#tabs-3">All Events</a></li>
			<div><li><a href="dashboard.php">Dashboard</a></li></div>
			<div><li style="float:right;"><a href="./index.php">Logout</a></li></div>
		</ul>
		
		<div id="tabs-1">
		<?php if(isset($Status_message)){?><div id="message"><?php echo $Status_message;?></div><?php }
			
			$numRows = $sql->dbNumRows($Reminder_Result);
			if($numRows > 0)
			{	
				while($Reminder = $sql->dbFetchAssoc($Reminder_Result)){?>
				<div id="reminder"  >
				<a href="edit1.php?id=<?php echo $Reminder['id']?>&email=<?php echo $email?>"><?php echo $Reminder['title'];?></a>
				<p ><?php echo "set on ".$Reminder['date'];?></p>
				
				</div>
				<?php 	}
			}
			else{
			echo "There are no Events set";
			}
			$sql->dbFreeResult($Reminder_Result);?>
		</div>	
		
			
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
					<td >Description</td>
					<td><textarea name="description" cols="21" rows="5" id="description"></textarea></td>
					</tr>
				  <tr>
					<td>Remind me Date</td>
					<td><input type="text" id="date" name="date"></td>
					</tr>
				  <tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Save Event" name="submit" /></td>
				  </tr>
				</table>
				</form>
		</div>
		
		<div id="tabs-3">
					<?php 					
			while($row = $sql->dbFetchAssoc($Result)){?>
			<div id="reminder"  >
			<a href="edit1.php?id=<?php echo $row['id']?>&email=<?php echo $email?>" <?php if($row['flag']== 0){?>style="color:#999999;" <?php }?>>
			<?php echo $row['title'];?>
			</a>
			
			<p <?php if($row['flag']== 0){?>style="color:#999999;" <?php }?>>
			<?php if($row['flag']== 1){echo "set on ".$row['date'];}else{ echo "expired on ".$row['date'];}?>
			</p>
			
			</div>
			<?php }
			$sql->dbFreeResult($Result); ?>		
		</div>				
		
	</div>
</div>
</body>
</html>