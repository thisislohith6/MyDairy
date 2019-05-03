<?php include('connect1.php');
$email=$_GET['email'];

if(isset($_REQUEST['submit']))
{
	if(!empty($_REQUEST['title']) & !empty($_REQUEST['date']))
	{
		if($_REQUEST['date']<=date('Y-m-d'))
		{
		$flag = '0';
		}
		else
		{
		$flag = '1';
		}
		
		$title = addslashes(ucwords($_REQUEST['title']));
		$desc = addslashes(ucfirst($_REQUEST['description']));	
		
	$sql->dbQuery("update reminders set title='$title',description='$desc',date='$_REQUEST[date]',flag='$flag' where id = '$_GET[id]' ");
	$Status_message = 'Updated!';
	}
	else {
	$Status_message = 'Updation unsuccesful, Title or date missing!';
	}

}
$result = $sql->dbQuery("select * from reminders where id = '$_GET[id]' and email = '$_GET[email]'");
$row = $sql->dbFetchAssoc($result);
$sql->dbFreeResult($result);
?>

<!DOCTYPE html>
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
<div id="Container">	
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Detail</a></li>
			<li><a href="#tabs-2">Edit Event</a></li>
			<li style="float:right;"><a href="#tabs-3"><a href="index1.php?email=<?php echo $email?>">Back</a></li>			
		</ul>
		
		<div id="tabs-1">
		<div id="message"><?php if(isset($Status_message)){ echo $Status_message;}?></div>

			<p><?php echo $row['title']?></p>
			<p><?php echo $row['description']?></p>
			<p><?php echo $row['date']?></p>
			<p><a href="delete1.php?id=<?php echo $row['id'];?>" onClick="return confirm('Are you sure you want to delete event?')" style="color:#FF9900;">Delete</a></p>
		</div>
		
		<div id="tabs-2">
		
		<form name="edit_reminder" action="" method="post">
		<table width="50%" border="0">
		
	  <tr>
		<td width="32%">Title</td>
		<td><input type="text" name="title" value="<?php echo $row['title']?>" ></td>
	  </tr>
	  <tr>
		<td width="32%">Description</td>
		<td><textarea name="description" cols="21" rows="5" id="description"><?php echo $row['description']?></textarea></td>
	  </tr>
	  <tr>
		<td>Remind me Date</td>
		<td><input type="text" id="date" name="date" value="<?php echo $row['date']?>"></td>
		</tr>
	 
	  <tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="update" name="submit" /></td>
	  </tr>
	</table>
	</form>
		</div>
	
	</div>
</div>
</body>
</html>
