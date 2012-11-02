<?php 

require_once("login.functions.inc.php");

function redirect_to_URL($url){
	echo "<script type=\"text/javascript\">".
	"window.location = \"".$url."\"".
	"</script>";
}

?>