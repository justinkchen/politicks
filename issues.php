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
					<form action="payments.php?id=<?=$_GET['id'];?>" method="post">
						<?= $output; ?>
					</form>
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