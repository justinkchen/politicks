<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	

<?php
	checkLogin();
	if(isset($_GET["id"])){

		// Handle Donating
		$q = sprintf("select * from userstoissues where issue_id='%s' and user_id='%s'", mysql_real_escape_string($_GET['id']), mysql_real_escape_string($_SESSION["userid"]));
		$result = mysql_query($q);
		if(mysql_num_rows($result) == 0){
			$output = 	"<input type=\"submit\" value=\"Donate\"></input>";
			$alreadyDonated = false;
		}else{
			$output = 	"<input type=\"submit\" value=\"Donate Again\"></input>";
			$alreadyDonated = true;
		}
		if (isset($_POST["amount"])){
			$query = sprintf("select * from issues where id='%s'",mysql_real_escape_string($_GET["id"]));
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
			$currentFunding = doubleval($row["funding"]);
			$currentSupporters = intval($row["likes"]);
			$newFunding = number_format($currentFunding + doubleval(number_format($_POST["amount"],2)), 2);
			if (!$alreadyDonated){
				$newSupporters = $currentSupporters + 1;
			}else{
				$newSupporters = $currentSupporters;
			}
			$query = sprintf("update issues set funding='%s', likes='%s' where id='%s'",mysql_real_escape_string($newFunding), mysql_real_escape_string($newSupporters), mysql_real_escape_string($_GET['id']));
			$result = mysql_query($query);
			$query = sprintf("insert into userstoissues (issue_id, user_id) values ('%s', '%s')",mysql_real_escape_string($_GET['id']), mysql_real_escape_string($_SESSION['userid']));
			$result = mysql_query($query);
		}

		// List Issue information
		$query = sprintf("select * from issues where id='%s'",mysql_real_escape_string($_GET["id"]));
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if(mysql_num_rows($result) == 0){
      		redirect_to_URL("index.php");
		}
		$name = $row["name"];
		$funding = $row["funding"];
		$likes = $row["likes"];

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
		    $comments .= "<li>".$message."".
					"<span class=\"ui-li-count\">User: ".$name."</span>".
					"</a>".
					"</li>"; 
		} 
		if ($comments == ""){
			$comments = "<center>No comments yet</center>";
		}
	}else{
  		redirect_to_URL("index.php");
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
						<b><?= $name; ?></b>
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
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</img></input></input></input></form>
					</td></tr>
					</table>
				</td>
			</tr>
		</table>

		<h1>Description</h1>
		<p>
			<?= $row["description"]; ?>
		</p>
		<hr />
		<br />
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
		<br />
		<hr />
		<a href="comment.php?id=<?=$_GET['id'];?>" data-role="button" data-theme="c">Leave a Comment</a>
		<br />
		<ul data-role="listview" data-theme="c" >
			<?= $comments; ?>
		</ul>
	</div><!-- /content -->


<?php include_once("footer.php") ?>
