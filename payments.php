<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
		<h1>Payments</h1>
		<form action="issues.php" method="post">
		<label for="ccard">Credit Card:</label>
		<input type="text" name="name" id="ccard" data-mini="true" placeholder="e.g. 1111-1111-1111-1111" />
		<label for="amount">Amount to Fund:</label>
		<input type="text" name="name" id="amount" data-mini="true" placeholder="e.g. 50.00"/>
		<input type="submit" value="Confirm Payment"></input>
		</form>
	</div><!-- /content -->

<?php include_once("footer.php") ?>