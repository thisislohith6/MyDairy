<?php 
include('connect1.php');

$sql->dbQuery("delete from reminders where id = '$_GET[id]'");
header("Location:index1.php?email='$_GET[email]'");
?>
