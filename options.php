
<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	

		<h1> Options </h1>
		<form action="#" method="post">
		<div data-role="fieldcontain" class="ui-hide-label">
		<label for="username">Username:</label>
		<input type="text" name="username" id="username" value="" placeholder="Username"/>
		</div>
		<fieldset data-role="controlgroup" data-mini="true">
	    	<input data-theme="c" type="radio" name="radio-mini" id="radio-mini-1" value="choice-1" checked="checked" />
	    	<label for="radio-mini-1">Credit</label>

			<input data-theme="c" type="radio" name="radio-mini" id="radio-mini-2" value="choice-2"  />
	    	<label for="radio-mini-2">Debit</label>
	    	
	    	<input data-theme="c" type="radio" name="radio-mini" id="radio-mini-3" value="choice-3"  />
	    	<label for="radio-mini-3">Cash</label>
		</fieldset>

		<a href="#" data-theme="c" id="reset" data-role="button">Reset to Defaults</a>
		<input type="submit" value="Save"></input>
		</form>
	</div><!-- /content -->

<?php include_once("footer.php") ?>