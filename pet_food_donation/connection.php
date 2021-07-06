<?php
$conn = new mysqli("localhost","root","","foodwaste");

if(!mysqli_select_db($conn,"foodwaste"))
{
	header("location:index.php");
	die();
}
if($conn->connect_error)
{
die("Connection Failed: ".$conn->connect_error);
}
?>