<?php
$host="localhost:8080"; // Host name 
$username="root"; // Mysql username 
$password="root"; // Mysql password 
$db_name="politicks"; // Database name 
$tbl_name="users"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");

?>