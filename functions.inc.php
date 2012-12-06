<?php 

require_once("login.functions.inc.php");
require_once("validate.functions.inc.php");

function redirect_to_URL($url){
	echo "<script type=\"text/javascript\">".
	"window.onload = function() {".
	"window.location = \"".$url."\";".
	"}();".
	"</script>";
}

function fetchOrder(){
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$array = array();
		$array['transactionID']=$_POST["txn_id"];
		$array['item']=$_POST["item_name"];
		$array['amount']=$_POST["mc_gross"];
		$array['currency']=$_POST["mc_currency"];
		$datefields=explode(" ",$_POST["payment_date"]);
		$array['time']=$datefields[0];
		$array['date']=str_replace(",","",$datefields[2])." ".$datefields[1]." ".$datefields[3];
		$array['timestamp']=strtotime($array['date']." ".$array['time']);
		$array['status']=$_POST["payment_status"];
		$array['firstname']=$_POST["first_name"];
		$array['lastname']=$_POST["last_name"];
		$array['email']=$_POST["payer_email"];
		$array['custom']=$_POST["option_selection1"];
		$array['sld']=$_POST["notify_url"];
	}
}

function donationResponse($id, $amount){
	// Handle Donating
	//echo "In Donation Function\n";
	$q = sprintf("select * from userstoissues where issue_id='%s' and user_id='%s'", mysql_real_escape_string($id), mysql_real_escape_string($_SESSION["userid"]));
	$result = mysql_query($q);
	if(mysql_num_rows($result) == 0){
		$alreadyDonated = false;
	}else{
		$alreadyDonated = true;
	}

	if (isset($amount)){  // Amount returned from PayPal
		$query = sprintf("select * from issues where id='%s'",mysql_real_escape_string($id));
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$currentFunding = doubleval($row["funding"]);
		$currentSupporters = intval($row["likes"]);
		$newFunding = number_format($currentFunding + doubleval(number_format($amount,2)), 2);
		if (!$alreadyDonated){
			$newSupporters = $currentSupporters + 1;
		}else{
			$newSupporters = $currentSupporters;
		}
		$query = sprintf("update issues set funding='%s', likes='%s' where id='%s'",mysql_real_escape_string($newFunding), mysql_real_escape_string($newSupporters), mysql_real_escape_string($id));
		if(mysql_query($query)){
			//echo "Successful update\n";
		}else{
			//echo "Unsuccessful update\n";
		}
		$query = sprintf("insert into userstoissues (issue_id, user_id) values ('%s', '%s')",mysql_real_escape_string($id), mysql_real_escape_string($_SESSION['userid']));
		$result = mysql_query($query);
	}	
	return $alreadyDonated;
}

function uploadFile(){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$extension = end(explode(".", $_FILES["file"]["name"]));
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/png")
	|| ($_FILES["file"]["type"] == "image/pjpeg"))
	&& ($_FILES["file"]["size"] < 20000)
	&& in_array($extension, $allowedExts)){
		if ($_FILES["file"]["error"] > 0){
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		}else{
			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			if (file_exists("upload/" . $_FILES["file"]["name"])){
				echo $_FILES["file"]["name"] . " already exists. ";
			}else{
				move_uploaded_file($_FILES["file"]["tmp_name"],
				"images/" . $_FILES["file"]["name"]);
				echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
			}
		}
	}else{
		echo "Invalid file";
	}
}

?>