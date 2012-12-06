<?php

function isValidEmail($email){       
	$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";             
	if (preg_match($pattern, $email)){          
		return true;       
	}else{          
		return false;       
	}       
}

?>
