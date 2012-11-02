<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
<?php
	if(isset($_GET["id"])){
		$query = sprintf("select * from politicians where id='%s'",mysql_real_escape_string($_GET["id"]));
		$result = mysql_query($query);
		if(mysql_num_rows($result) == 0){
			header("Location: politicians.php");
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
		while ($row=mysql_fetch_array($result)){
			$query = sprintf("select * from proposedsolutions where politician_id='%s' and category_id='%s'", $id, $row["id"]);
			$countresult = mysql_query($query);
			$issuesgridstyle .= "#".$row["name"]." .ui-icon { background:  url(".$row["icon"].") 50% 50% no-repeat; background-size: 26px 26px; }";
			$issuesgrid .= "<li><a href=\"index.php\" id=\"".$row["name"]."\" data-icon=\"custom\" data-theme=\"c\">".mysql_num_rows($countresult)." Issues</a></li>";
		}
		}else{
			header("Location: politicians.php");
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
						<?= $name; ?>
					</td></tr>
					<tr><td>
						<?= $followers; ?> Followers
					</td></tr>
					</table>
				</td>

				<td>
					<p align="right">
					<a href="#" data-role="button">Follow</a>
					</p>
				</td>
			</tr>
		</table>
		<style>	
			.nav-glyphish-example .ui-btn .ui-btn-inner { padding-top: 40px !important; }
			.nav-glyphish-example .ui-btn .ui-icon { width: 30px!important; height: 30px!important; margin-left: -15px !important; box-shadow: none!important; -moz-box-shadow: none!important; -webkit-box-shadow: none!important; -webkit-border-radius: 0 !important; border-radius: 0 !important; }
			<?= $issuesgridstyle; ?>
		</style>

		<div data-role="footer" class="nav-glyphish-example">
			<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
			<ul>
				<?= $issuesgrid; ?>

			</ul>
			</div>
		</div>

		<h1>Description</h1>
		<p>
			<?= $description; ?>
		</p>

	</div><!-- /content -->

<?php include_once("footer.php") ?>