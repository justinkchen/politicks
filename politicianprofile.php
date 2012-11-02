<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
<?php
	checkLogin();
?>
<?php
	if(isset($_GET["id"])){
		$query = sprintf("select * from politicians where id='%s'",mysql_real_escape_string($_GET["id"]));
		$result = mysql_query($query);
		if(mysql_num_rows($result) == 0){
		    echo "<script type=\"text/javascript\">".
      			"window.location = \"politicians.php\"".
      			"</script>";
		}
		$row = mysql_fetch_array($result);
		$id = $row["id"];
		$name = $row["name"];
		$followers = $row["followers"];
		$description = $row["description"];

		$issuesgrid = "";
		$issuesgridstyle = "";

		$query = "select * from categories";
		$result = mysql_query($query);
		$totalcount = 0;
		while ($row=mysql_fetch_array($result)){
			$query = sprintf("select * from proposedsolutions where politician_id='%s' and category_id='%s'", mysql_real_escape_string($id), mysql_real_escape_string($row["id"]));
			$countresult = mysql_query($query);
			$count = mysql_num_rows($countresult);
			$totalcount += $count;
			$issuesgridstyle .= "#".$row["name"]." .ui-icon { background:  url(".$row["icon"].") 50% 50% no-repeat; background-size: 26px 26px; }";
			$issuesgrid .= "<li><a href=\"politicianissues.php?pid=".$_GET['id']."&cid=".$row['id']."\" id=\"".$row["name"]."\" data-icon=\"custom\" data-theme=\"c\">".$count." ".$row['name']."</a></li>";
		}

		if(isset($_POST["follow"])){
			$query = sprintf("insert into userstopoliticians (politician_id, user_id) values ('%s', '%s')", mysql_real_escape_string($_GET['id']), mysql_real_escape_string($_SESSION['userid']));
			mysql_query($query);
		}
	}else{
	    echo "<script type=\"text/javascript\">".
  			"window.location = \"politicians.php\"".
  			"</script>";
	}
?>
		<table width="100%">
			<tr>
				<td>
					<img src="images/icons/111-user.png" width="60px" height="60px"></img>
				</td>
				<td>
					<table>
					<tr><td>
						<b><?= $name; ?></b>
					</td></tr>
					<tr><td>
						<?= $followers; ?> Followers
					</td></tr>
					</table>
				</td>

				<td>
					<p align="right">
					<?php
						$q = sprintf("select * from userstopoliticians where politician_id='%s' and user_id='%s'", mysql_real_escape_string($id), mysql_real_escape_string($_SESSION["userid"]));
						$result = mysql_query($q);
						if(mysql_num_rows($result) == 0){
							$output = 	"<input type=\"submit\" value=\"Follow\"></input>";
						}else{
							$output = 	"<a href=\"#\" class=\"ui-disabled\" data-role=\"button\">Followed</a>";
						}
					?>
					<form action="politicianprofile.php?id=<?=$_GET['id'];?>" method="post">
						<input type="hidden" name="follow" value="true" />
						<?= $output; ?>
					</form>
					</p>
				</td>
			</tr>
		</table>
		<style>	
			.nav-glyphish-example .ui-btn .ui-btn-inner { padding-top: 40px !important; }
			.nav-glyphish-example .ui-btn .ui-icon { width: 30px!important; height: 30px!important; margin-left: -15px !important; box-shadow: none!important; -moz-box-shadow: none!important; -webkit-box-shadow: none!important; -webkit-border-radius: 0 !important; border-radius: 0 !important; }
			<?= $issuesgridstyle; ?>
		</style>

		<label for="issuesgrid"><h4>Issues with Proposed Solutions<h4></label>
		<div name="issuesgrid" data-role="footer" class="nav-glyphish-example">
			<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
			<ul>
				<?= $issuesgrid; ?>
			</ul>
			</div>
		</div>
		<a href="politicianissues.php?pid=<?= $_GET['id']; ?>" data-role="button"><?= $totalcount; ?> Total Proposed Solutions</a>

		<h1>Description</h1>
		<p>
			<?= $description; ?>
		</p>

	</div><!-- /content -->

<?php include_once("footer.php") ?>