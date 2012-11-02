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
		<table width="100%">
			<tr>
				<td>
					<img src="images/icons/178-city.png" width="60px" height="60px"></img>
				</td>
				<td>
					<table>
					<tr><td>
						<b><?= $row["name"]; ?></b>
					</td></tr>
					<tr><td>
						$<?= number_format($row["funding"],2); ?> raised
					</td></tr>
					<tr><td>
						<?= $row["likes"]; ?> supporters
					</td></tr>
					</table>
				</td>

				<td>
					<table>
					<tr><td>
						<a href="payments.php" data-role="button" data-theme="b">Donate</a>
					</td></tr>
					</table>
				</td>
			</tr>
		</table>

		<h1>Description</h1>
		<p>
			<?= $row["description"]; ?>
		</p>

		<a href="#" data-role="button" data-theme="c">Leave a Comment</a>

<?php
	$query = sprintf("select * from proposedsolutions where issue_id='%s'",mysql_real_escape_string($_GET["id"]));
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if (mysql_num_rows($result)){
		$output = "<a href=\"solution.php?issue_id=".$_GET['id']."\" data-role=\"button\">Show Proposed Solution</a>";
	}else{
		$output = "<center>No Proposed Solutions yet</center>";
	}
?>
		<?= $output; ?>
	</div><!-- /content -->


<?php include_once("footer.php") ?>