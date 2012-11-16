<?php include_once("header.php") ?>
<!-- /header -->

<div data-role="content">	
<?php 
$error = $status = "";
if (isset($_POST["logout"]) && $_POST["logout"] == "true"){
	logout();
	$status = "You have been logged out";
} 
if (isset($_GET["error"])){
	if($_GET["error"] == "badlogin"){
		$error = "Username/Password combination not found";
	}else if($_GET["error"] == "notloggedin"){
		$error = "Must be logged in first";
	}else{
		$error = "ERROR";
	}
}
if (isset($_GET["status"])){
	$status = "Successfully created account! Please login below";
}

?>
	<span class="error"><?= $error; ?></span>
	<span class="status"><?= $status; ?></span>
	<form action="index.php" method="post">
		<label for="username">Username:</label>
		<input type="text" name="username" id="username" data-mini="true" />
		<label for="password">Password:</label>
		<input type="password" name="password" id="password" data-mini="true" />
		<fieldset class="ui-grid-a">
			<div class="ui-block-a"><a href='register.php' data-role="button" data-theme="a">Register</a></div>
			<div class="ui-block-b"><button type="submit" data-theme="b">Login</button></div>
		</fieldset>
	</form>


</div><!-- /content -->

<?php include_once("footer.php") ?>

<!-- /footer -->
