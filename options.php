
<?php include_once("header.php") ?>
	<!-- /header -->
<?php
checkLogin();
$status = "";
$firstErr = "";
$lastErr = "";
$userErr = "";
$emailErr = "";
$password1Err = "";
$passwordMatchErr = "";
$first = $last = $user = $email = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["first"])) {
		$firstErr = "Please enter a first name";
	} else {
		$first = $_POST["first"];
	}
	if (empty($_POST["last"])) {
		$lastErr = "Please enter a last name";
	} else {
		$last = $_POST["last"];
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
	if (empty($_POST["password1"])) {
		$password1Err = "Please enter a password";
	}
	if ($_POST["password1"] != $_POST["password2"]) {
		$passwordMatchErr = "Your passwords do not match";
	} 
	if ($firstErr == "" && $lastErr == "" && $userErr == "" && $emailErr == "" && $password1Err == "" && $passwordMatchErr == "") {
		$userUniq = sprintf("select username from users where username = '%s'", mysql_real_escape_string($user));
		$result = mysql_query($userUniq);
		if(mysql_num_rows($result) > 0) {
			$userErr = "Username already exists. Please choose a different one";
		}
		$emailUniq = sprintf("select email from users where email = '%s'", mysql_real_escape_string($email));
		$result = mysql_query($emailUniq);
		if(mysql_num_rows($result) > 0) {
			$emailErr = "An account with this e-mail address already exists";
		}
		if ($userErr == "" && $emailErr == "") {
			$query = sprintf("insert into users (name, username, email, password_hash) values ('%s', '%s', '%s', '%s')", mysql_real_escape_string($first." ".$last), mysql_real_escape_string($user), mysql_real_escape_string($email), hashPassword($_POST["password1"]));
			if(mysql_query($query)){
				login($user);
				redirect_to_URL("index.php");
			}else{
				$status = "Error inserting information into database";
			}
		}
	}
}
?>

<div data-role="content">
	<span class="status"><?= $status; ?></span>
	<form action="register.php" method="post">
		<div data-role="fieldcontain">
			<label for="first">First Name:</label>
			<input type="text" name="first" id="first" value="<?= $first; ?>" />
			<span class="error"><?php echo $firstErr;?></span>
		</div>
		<div data-role="fieldcontain">
			<label for="last">Last Name:</label>
			<input type="text" name="last" id="last" value="<?= $last; ?>" />
			<span class="error"><?php echo $lastErr;?></span>
		</div>
		<div data-role="fieldcontain">
			<label for="user">User Name:</label>
			<input type="text" name="user" id="user" value="<?= $user; ?>" />
			<span class="error"><?php echo $userErr;?></span>
		</div>
		<div data-role="fieldcontain">
			<label for="email">E-mail Address:</label>
			<input type="text" name="email" id="email" value="<?= $email; ?>" />
			<span class="error"><?php echo $emailErr;?></span>
		</div>
		<div data-role="fieldcontain">
			<label for="password1">New Password:</label>
			<input type="password" name="password1" id="password1" value="" />
			<span class="error"><?php echo $password1Err;?></span>
		</div>
		<div data-role="fieldcontain">
			<label for="password2">Re-type Password:</label>
			<input type="password" name="password2" id="password2" value="" />
			<span class="error"><?php echo $passwordMatchErr;?></span>
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