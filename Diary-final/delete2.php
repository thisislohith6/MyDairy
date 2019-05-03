<?php 
include('connect2.php');

$sql->dbQuery("delete from contacts where id = '$_GET[id]'");
header("Location:index2.php");
?>
