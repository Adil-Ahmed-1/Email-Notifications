<?php
$host_name = "localhost";      
$user_name = "root";       
$password = "";           
$database_name = "user_management";

$connection = mysqli_connect($host_name, $user_name, $password, $database_name);

if(mysqli_connect_errno())
	{
		echo "<p style='color: red'><b>Database Connection Problem !...</b></p>";
		echo "<p style='color: red'><b>Error Number: </b>".mysqli_connect_errno()."</p>";
		echo "<p style='color: red'><b>Error Message: </b>".mysqli_connect_error()."</p>";
	}
?>
