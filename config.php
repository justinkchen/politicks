<?php
$host="localhost:8888"; // Host name 
$username="root"; // Mysql username 
$password="root"; // Mysql password 
$db_name="cs147"; // Database name 
$tbl_name="users"; // Table name 

// Connect to server and select databse.
$link = mysql_connect("$host", "$username", "$password");
if ($link){
	//echo "Connected to MySQL<br />";
}else{
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("$db_name")or die("Cannot select DB");

?>
