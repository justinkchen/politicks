
<?php include_once("header.php") ?>
	<!-- /header -->
<?php
checkLogin();
$status = "";
$nameErr = "";
$userErr = "";
$emailErr = "";
$name = $_SESSION["userfullname"];
$user = $_SESSION["username"];
$email = $_SESSION["useremail"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["name"])) {
		$nameErr = "Please enter a name";
	} else {
		$name = $_POST["name"];
	}
	if (empty($_POST["user"])) {
		$userErr = "Please enter a username";
	} else {
		$user = $_POST["user"];
	}
	if (empty($_POST["email"]) || !isValidEmail($_POST["email"])) {
		$emailErr = "Please enter a valid e-mail address";
	} else {
		$email = $_POST["email"];
	}
	if ($nameErr == "" && $userErr == "" && $emailErr == "") {
		$userUniq = sprintf("select username from users where username = '%s'", mysql_real_escape_string($user));
		$result = mysql_query($userUniq);
		if(mysql_num_rows($result) > 0 && $user != $_SESSION["username"]) {
			$userErr = "Username already exists. Please choose a different one";
		}
		$emailUniq = sprintf("select email from users where email = '%s'", mysql_real_escape_string($email));
		$result = mysql_query($emailUniq);
		if(mysql_num_rows($result) > 0 && $email != $_SESSION["useremail"]) {
			$emailErr = "An account with this e-mail address already exists";
		}
		if ($userErr == "" && $emailErr == "") {
			$query = sprintf("update users set name='%s', username='%s', email='%s' where id='%s'", mysql_real_escape_string($name), mysql_real_escape_string($user), mysql_real_escape_string($email), mysql_real_escape_string($_SESSION["userid"]));
			if(mysql_query($query)){
				login($user);
				$status = "Update Successful";
			}else{
				$status = "Error inserting information into database";
			}
		}
	}
}
?>

<div data-role="content">
	<span class="status"><?= $status; ?></span>
	<form action="options.php" method="post">
		<div data-role="fieldcontain">
			<label for="name">Change Name:</label>
			<input type="text" name="name" id="name" value="<?= $name; ?>" />
			<span class="error"><?php echo $nameErr;?></span>
		</div>
		<div data-role="fieldcontain">
			<label for="user">Change User Name:</label>
			<input type="text" name="user" id="user" value="<?= $user; ?>" />
			<span class="error"><?php echo $userErr;?></span>
		</div>
		<div data-role="fieldcontain">
			<label for="email">Change E-mail Address:</label>
			<input type="text" name="email" id="email" value="<?= $email; ?>" />
			<span class="error"><?php echo $emailErr;?></span>
		</div>
		<fieldset class="ui-grid-a">
			<div class="ui-block-a"><a href="index.php" data-role="button" data-theme="c">Cancel</a></div>
			<div class="ui-block-b"><button type="submit" data-theme="b">Update</button></div>	   
		</fieldset>
	</form>
	<br />
	<p align="right">
		<form action="login.php" method="post">
			<input type="hidden" name="logout" value="true" />
			<input type="submit" data-mini="true" value="Logout" data-theme="a"></input>
		</form>
	</p>
	<br />
	<br />
</div>

<?php include_once("footer.php") ?>