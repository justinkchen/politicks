<?php 
include_once("header.php");

checkLogin();
$alreadyDonated = donationResponse($_GET["item_number"], $_GET["mc_gross"]);

if ($alreadyDonated){
	//echo "Donated Again!";

}else{
	//echo "Donated!";
}

//gets link to current page
if ($_SERVER["SERVER_PORT"] != "80")
{
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} 
else 
{
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
$path_parts = pathinfo($pageURL);
$basepath = $path_parts['dirname'];
$returnURL = "http://".$basepath."/issues.php?id=".$_GET["item_number"];

//echo $returnURL;
redirect_to_URL($returnURL);

include_once("footer.php"); 
?>
