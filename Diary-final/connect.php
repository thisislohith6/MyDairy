<?php
$servername = 'localhost';
$username = 'root';
$password = 'Btech6.taj';
$db='dia';
$conn = mysqli_connect($servername,$username,$password,$db);
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
?>