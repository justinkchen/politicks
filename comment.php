<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">
<?php
	if(isset($_GET["id"])){
		$query = sprintf("select * from issues where id='%s'",mysql_real_escape_string($_GET["id"]));
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if(mysql_num_rows($result) == 0){
			header("Location: index.php");
		}
	}else{
		header("Location: index.php");
	}
?>	
		<h1>Leave a Comment</h1>
		<form action="issues.php?id=<?=$_GET['id'];?>" method="post">
			<div data-role="fieldcontain">
				<label for="comment">Description:</label>
				<textarea name="comment" id="comment" style="height: 100px;"></textarea>
			</div>
			<input type="submit" value="Submit Comment"></input>
		</form>
	</div><!-- /content -->

<?php include_once("footer.php") ?>