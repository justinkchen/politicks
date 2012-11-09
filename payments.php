<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">
<?php
	if(isset($_GET["id"])){
		$query = sprintf("select * from issues where id='%s'",mysql_real_escape_string($_GET["id"]));
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if(mysql_num_rows($result) == 0){
      		redirect_to_URL("index.php");
		}
	}else{
  		redirect_to_URL("index.php");
	}
?>	
		<h1>Payments</h1>
		<form action="issues.php?id=<?=$_GET['id'];?>" method="post">
		<label for="ccard">Credit Card:</label>
		<input type="text" name="ccard" id="ccard" data-mini="true" placeholder="e.g. 1111-1111-1111-1111" />
		<label for="amount">Amount to Fund:</label>
		<input type="text" name="amount" id="amount" data-mini="true" placeholder="e.g. 50.00"/>
		<input type="submit" value="Confirm Payment"></input>
		</form>
	</div><!-- /content -->

<?php include_once("footer.php") ?>