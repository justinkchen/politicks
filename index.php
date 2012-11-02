<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$uname = $pword = "";
		if (isset($_POST["username"]) && isset($_POST["password"])){
			$uname = $_POST["username"];
			$pword = $_POST["password"];
		}
		verifyLogin($uname, $pword);
	}
	checkLogin();
?>
		<div data-role="navbar">
		<ul>
			<li><a href="index.php" data-theme="c">Featured</a></li>
			<li><a href="index.php?type=supported" data-theme="c">Supported</a></li>
			<li><a href="index.php?type=created" data-theme="c">Created</a></li>
		</ul>
		</div><!-- /navbar -->
		<p> Welcome to Politicks! Your resource for making change in the world! </p>

		<br />

<?php
	$query = "select *, issues.name as iname, categories.name as cname from issues,categories where issues.category_id = categories.id";
	$result = mysql_query($query);
	$issues = "";
	$issuesgrid = "";
	$issuesgridstyle = "";
	while ($row=mysql_fetch_array($result)) { 
	    $id = $row["id"]; 
	    $name = $row["iname"]; 
	    $description = $row["description"];
	    $icon = $row["icon"];
	    $issues .= "<li><a href=\"issues.php\">".
				"<img src=\"".$icon."\" />".
				"<h3>".$name."</h3>".
				"<p>".$description."</p>".
				"</a>".
				"</li>"; 
	} 
	
	$query = "select * from categories";
	$result = mysql_query($query);
	while ($row=mysql_fetch_array($result)){
		$issuesgridstyle .= "#".$row["name"]." .ui-icon { background:  url(".$row["icon"].") 50% 50% no-repeat; background-size: 26px 26px; }";
		$issuesgrid .= "<li><a href=\"#\" id=\"".$row["name"]."\" data-icon=\"custom\" data-theme=\"c\">".$row["name"]."</a></li>";
	}
?>

<div data-role="content">
		<div class="content-primary">	
		<ul data-role="listview" data-split-icon="arrow-r" data-theme="c" data-split-theme="d" data-filter="true" data-filter-placeholder="Search Issues...">
			<?= $issues; ?>
		</ul>

		<br />

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
	</div><!-- /content -->

<?php include_once("footer.php") ?>