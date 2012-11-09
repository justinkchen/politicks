<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
<?php
	checkLogin();
?>
		<div data-role="navbar">
		<ul>
			<li><a href="index.php" data-theme="c">Featured</a></li>
			<li><a href="supportedissues.php" data-theme="c">Supported</a></li>
			<li><a href="createdissues.php" data-theme="c">Created</a></li>
		</ul>
		</div><!-- /navbar -->

		<br />

<?php
	if(isset($_GET["category"])){
		$query = sprintf("select *, issues.id as iid, issues.name as iname from issues, categories where issues.category_id = '%s' and categories.id = '%s' and issues.user_id = '%s'", mysql_real_escape_string($_GET["category"]), mysql_real_escape_string($_GET["category"]), mysql_real_escape_string($_SESSION["userid"]));
	}else{
		$query = sprintf("select *, issues.id as iid, categories.id as cid, issues.name as iname, categories.name as cname from issues,categories where issues.category_id = categories.id and issues.user_id = '%s'", mysql_real_escape_string($_SESSION["userid"]));
	}
	$result = mysql_query($query);
	$issues = "";
	$issuesgrid = "";
	$issuesgridstyle = "";
	$numissues = mysql_num_rows($result);
	if($numissues == 0){
		$issues = "<center>No issues found matching that criteria</center><br /><br />";
	}
	while ($row=mysql_fetch_array($result)) { 
	    $id = $row["iid"]; 
	    $name = $row["iname"]; 
	    $description = $row["description"];
	    $icon = $row["icon"];
	    $issues .= "<li><a href=\"issues.php?id=".$id."\">".
				"<img src=\"".$icon."\" />".
				"<h3>".$name."</h3>".
				"<p>".$description."</p>".
				"</a>".
				"<a href=\"editissue.php?id=".$id."\"></a>".
				"</li>"; 
	} 
	
	$query = "select * from categories";
	$result = mysql_query($query);
	while ($row=mysql_fetch_array($result)){
		$issuesgridstyle .= "#".$row["name"]." .ui-icon { background:  url(".$row["icon"].") 50% 50% no-repeat; background-size: 26px 26px; }";
		$issuesgrid .= "<li><a href=\"createdissues.php?category=".$row["id"]."\" id=\"".$row["name"]."\" data-icon=\"custom\" data-theme=\"c\">".$row["name"]."</a></li>";
	}
?>

		<div class="content-primary">	
		<ul data-role="listview" data-split-icon="gear" data-theme="c" data-split-theme="d" data-filter="true" data-filter-placeholder="Search Issues...">
			<?= $issues; ?>
		</ul>

		<br />

		<style>	
			.nav-glyphish-example .ui-btn .ui-btn-inner { padding-top: 40px !important; }
			.nav-glyphish-example .ui-btn .ui-icon { width: 30px!important; height: 30px!important; margin-left: -15px !important; box-shadow: none!important; -moz-box-shadow: none!important; -webkit-box-shadow: none!important; -webkit-border-radius: 0 !important; border-radius: 0 !important; }
			<?= $issuesgridstyle; ?>
		</style>
		<br />
		<div data-role="footer" class="nav-glyphish-example">
			<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
			<ul>
				<?= $issuesgrid; ?>
			</ul>
			</div>
		</div>
		</div>
	</div><!-- /content -->

<?php include_once("footer.php") ?>