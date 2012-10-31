<?php include_once("header.php") ?>
<!-- /header -->

<div data-role="content">	
	<?php 
		if (isset($_POST["logout"]) && strcmp($_POST["logout"],"true") == 0){
			$_SESSION["username"] = null;
	?>
	<p> You have been logged out </p>
	<?php 
		}
	    if (isset($_SESSION["username"]) && !is_null($_SESSION["username"]) || (isset($_POST["username"]) && isset($_POST["password"]) && strcmp($_POST["username"],"test") == 0 && strcmp($_POST["password"],"test") == 0)){
	      $_SESSION["username"] = "test";
	?>
		<p> Welcome to Politicks! You're resource for making change in the world! </p>
		<form action="index.php" method="post">
		<input type="hidden" name="logout" value="true" />

		<input type="submit" value="Logout" data-theme="a"></input>
	</form>	
	<?php
	    }else{         
  	?>
	<form action="index.php" method="post">
		<label for="basic">Username:</label>
		<input type="text" name="username" id="basic" data-mini="true" />
		<label for="basic">Password:</label>
		<input type="password" name="password" id="basic" data-mini="true" />
		<fieldset class="ui-grid-a">
			<div class="ui-block-a"><button type="submit" data-theme="a">Login</button></div>
			<div class="ui-block-b"><button type="submit" data-theme="b">Signup</button></div>
	    </fieldset></button></div></button></div></fieldset>
	</form>	
	<?php
		}
	?>
</div><!-- /content -->

<?php include_once("footer.php") ?>
<!-- /footer -->
