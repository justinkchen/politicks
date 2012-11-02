
<?php include_once("header.php") ?>
	<!-- /header -->
	<?php checkLogin(); ?>
	<div data-role="content">	

		<h1>Options</h1>
		<form action="#" method="post">
		<div data-role="fieldcontain">
		<label for="username">Username:</label>
		<input type="text" name="username" id="username" value="<?= $_SESSION["username"]; ?>" placeholder="Username"/>
		</div>
		<fieldset data-role="controlgroup" data-mini="true">
	    	<input data-theme="c" type="radio" name="radio-mini" id="radio-mini-1" value="choice-1" checked="checked" />
	    	<label for="radio-mini-1">Credit</label>

			<input data-theme="c" type="radio" name="radio-mini" id="radio-mini-2" value="choice-2"  />
	    	<label for="radio-mini-2">Debit</label>
	    	
	    	<input data-theme="c" type="radio" name="radio-mini" id="radio-mini-3" value="choice-3"  />
	    	<label for="radio-mini-3">Cash</label>
		</fieldset>

		<fieldset class="ui-grid-a">
			<div class="ui-block-a"><a href="index.php" data-role="button" data-theme="c">Cancel</a></div>
			<div class="ui-block-b"><button type="submit" data-theme="b">Save</button></div>	   
		</fieldset>
		</form>
		<br />
		<br />
		<p align="right">
		<form action="login.php" method="post">
			<input type="hidden" name="logout" value="true" />
			<input type="submit" data-mini="true" value="Logout" data-theme="a"></input>
		</form>
		</p>
	</div><!-- /content -->

<?php include_once("footer.php") ?>