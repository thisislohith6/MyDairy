<?php include('connect2.php');
$email=$_GET['email'];


if(isset($_REQUEST['submit']))
{
	if(!empty($_REQUEST['title']))
	{
	
		$title = addslashes(ucwords($_REQUEST['title']));
		$desc = addslashes(ucfirst($_REQUEST['description']));	
		
	$sql->dbQuery("update contacts set title='$title',description='$desc' where id = '$_GET[id]'");
	$Status_message = 'Updated!';
	}
	else {
	$Status_message = 'Updation unsuccesful, Title or date missing!';
	}

}
$result = $sql->dbQuery("select * from `contacts` where id = '$_GET[id]' and email = '$_GET[email]'");
$row = $sql->dbFetchAssoc($result);
$sql->dbFreeResult($result);?>

<!DOCTYPE html>
<html>
<head>
<meta content="charset=UTF-8" />
<title>MyDairy</title>
<link rel="stylesheet" href="css2/style.css" />
<link rel="stylesheet" href="css2/ui-lightness/jquery-ui-1.8.18.custom.css">
<script src="js2/jquery-1.7.1.min.js"></script>
<script src="js2/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js2/jquery.ui.datepicker.js"></script>
<script src="js2/jquery.ui.tabs.js"></script>	
<script>
		$(function() {
		$( "#tabs" ).tabs();
		});
		
			
</script>
</head>
<body>
<div id="Container">	
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Detail</a></li>
			<li><a href="#tabs-2">Edit contact</a></li>
			<li style="float:right;"><a href="#tabs-3"><a href="index2.php?email=<?php echo $email?>">Back</a></li>			
		</ul>
		
		<div id="tabs-1">
		<div id="message"><?php if(isset($Status_message)){ echo $Status_message;}?></div>

			<p><?php echo $row['title']?></p>
			<p><?php echo $row['description']?></p>
			
			<p><a href="delete2.php?id=<?php echo $row['id']?>&email=<?php echo $email?>" onClick="return confirm('Are you sure you want to delete contact?')" style="color:#FF9900;">Delete</a></p>
		</div>
		
		<div id="tabs-2">
		
		<form name="edit_reminder" action="" method="post">
		<table width="50%" border="0">
		
	  <tr>
		<td width="42%">Title</td>
		<td><input type="text" name="title" value="<?php echo $row['title']?>" ></td>
	  </tr>
	  <tr>
		<td width="42%">Phone number</td>
		<td><textarea name="description" cols="21" rows="1" id="description"><?php echo $row['description']?></textarea></td>
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
