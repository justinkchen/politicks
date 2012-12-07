<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	

<?php
	checkLogin();
	$pageURL = "http://";
	if(isset($_GET["id"])){

		// $alreadyDonated = donationResponse();
		// if($alreadyDonated){
		// 	$output = 	"<input type=\"submit\" value=\"Donate Again\"></input>";
		// }else{
		// 	$output = 	"<input type=\"submit\" value=\"Donate\"></input>";
		// }

		// List Issue information
		$query = sprintf("select * from issues where id='%s'",mysql_real_escape_string($_GET["id"]));
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if(mysql_num_rows($result) == 0){
      		redirect_to_URL("index.php");
		}
		$issue_name = $row["name"];
		$funding = $row["funding"];
		$description = $row["description"];
		$likes = $row["likes"];
		$image = $row["image"];

		// Handle Comments
		if (isset($_POST["comment"])){
			$query = sprintf("insert into comments (message, issue_id, user_id) values ('%s', '%s', '%s')",mysql_real_escape_string($_POST["comment"]), mysql_real_escape_string($_GET['id']), mysql_real_escape_string($_SESSION['userid']));
			$result = mysql_query($query);
		}

		$query = sprintf("select * from comments where issue_id='%s'", mysql_real_escape_string($_GET["id"]));
		$result = mysql_query($query);
		$comments = "";
		while ($row=mysql_fetch_array($result)) { 
		    $userid = $row["user_id"]; 
		    $uquery = sprintf("select * from users where id='%s'", mysql_real_escape_string($userid));
			$uresult = mysql_query($uquery);
			$urow = mysql_fetch_array($uresult);
		    $name = $urow["username"]; 
		    $message = $row["message"];
		    $comments .= "<li><p class='commentTitle'>User: ".$name."</p><p class='commentBody'>".$message."</p>"."</li>"; 
		} 
		if ($comments == ""){
			$comments = "<center>No comments yet</center>";
		}

		//gets link to current page
		if ($_SERVER["SERVER_PORT"] != "80")
		{
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		$path_parts = pathinfo($pageURL);
		$basepath = $path_parts['dirname'];
		$notifyURL = $basepath."/notifyDonation.php";

	}else{
  		redirect_to_URL("index.php");
	}
?>
		<table width="100%">
			<tr>
				<center>
					<img id="issueimg" src="<?= $image ?>"></img>
				</center>
			</tr>
			<tr>
				<td>
					<table>
					<tr><td>
						<b><?= $issue_name; ?></b>
					</td></tr>
					<tr><td>
						$<?= number_format($funding,2); ?> raised
					</td></tr>
					<tr><td>
						<?= $likes; ?> supporters
					</td></tr>
					</table>
				</td>
				<td>
					<table>
					<tr><td>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_donations">
						<input type="hidden" name="business" value="donations@politicks.com"> <!-- TG7Q5GHMSDZR4 -->
						<input type="hidden" name="lc" value="US">
						<input type="hidden" name="item_name" value="Politicks donation to: <?= $issue_name ?> ">
						<input type="hidden" name="item_number" value="<?= $_GET['id']; ?> ">
						<input type="hidden" name="return" value="<?= $notifyURL ?>">
						<input type="hidden" name="cancel_return" value="<?= $pageURL; ?>">
						<input type="hidden" name="cbt" value="Return to Politicks">
						<input type="hidden" name="currency_code" value="USD">
						<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHosted">
						<input type="hidden" name="notify_url" value="<?= $notifyURL ?>">
						<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</form>

					</td></tr>
					</table>
				</td>
			</tr>
		</table>

		<h1>Description</h1>
		<div class="textbox">
			<?= $description; ?>
		</div>
		<hr />
<?php
	$query = sprintf("select * from proposedsolutions where issue_id='%s'",mysql_real_escape_string($_GET["id"]));
	$result = mysql_query($query);
	$output = "";
	while ($row = mysql_fetch_array($result)){
		$query = sprintf("select * from politicians where id='%s'", mysql_real_escape_string($row["politician_id"]));
		$politician_result = mysql_query($query);
		$politician_row = mysql_fetch_array($politician_result);
		$output .= "<li data-icon='false'><a href=\"solution.php?issue_id=".$_GET['id']."\">".$row["solution"]."<p class='politicianName'>".$politician_row["name"]."</p></a></li>";
	}
	if(mysql_num_rows($result) == 0){
		$output = "<center>No Proposed Solutions yet</center>";
	}
?>
		<h4>Solutions</h4>
		<div>
		<ul data-role="listview" data-theme="c">
			<?= $output; ?>
		</ul>
		</div>
		<br />
		<hr />
		<h4>Comments</h4>
		<a href="comment.php?id=<?=$_GET['id'];?>" data-role="button" data-theme="c">Leave a Comment</a>
		<br />
		<div class="comments">
			<ul data-role="listview" data-theme="c" >
				<?= $comments; ?>
			</ul>
		</div>
	</div><!-- /content -->


<?php include_once("footer.php") ?>
