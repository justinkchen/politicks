<?php 
include_once("header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$uname = $pword = "";
	if (isset($_POST["username"]) && isset($_POST["password"])){
		$uname = $_POST["username"];
		$pword = $_POST["password"];
	}
	verifyLogin($uname, $pword);
}else{
	$dispError = false;
	checkLogin($dispError);
}

include_once("footer.php"); 
?>
