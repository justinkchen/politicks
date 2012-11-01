<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
		<div data-role="navbar">
		<ul>
			<li><a href="#" data-theme="c">Featured</a></li>
			<li><a href="index.php" data-theme="c">Liked</a></li>
			<li><a href="index.php" data-theme="c">Recent</a></li>
		</ul>
		</div><!-- /navbar -->
		<p> Welcome to Politicks! Your resource for making change in the world! </p>

		<br />

<?php
	$sql = "select *, issues.name as iname, categories.name as cname from issues,categories where issues.category = categories.id";
	$result = mysql_query($sql);
	$issues = "";
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
?>

<div data-role="content">
		<div class="content-primary">	
		<ul data-role="listview" data-split-icon="arrow-r" data-theme="c" data-split-theme="d">
			<?= $issues; ?>
		</ul>

		<br />

		<form action="login.php" method="post">
		<input type="hidden" name="logout" value="true" />

		<input type="submit" value="Logout" data-theme="a"></input>
		</form>
		<br />

		<style>	
			.nav-glyphish-example .ui-btn .ui-btn-inner { padding-top: 40px !important; }
			.nav-glyphish-example .ui-btn .ui-icon { width: 30px!important; height: 30px!important; margin-left: -15px !important; box-shadow: none!important; -moz-box-shadow: none!important; -webkit-box-shadow: none!important; -webkit-border-radius: 0 !important; border-radius: 0 !important; }
			#environ .ui-icon { background:  url(images/icons/52-pine-tree.png) 50% 50% no-repeat; background-size: 26px 26px; }
			#trans .ui-icon { background:  url(images/icons/113-navigation.png) 50% 50% no-repeat; background-size: 26px 26px;  }
			#health .ui-icon { background:  url(images/icons/10-medical.png) 50% 50% no-repeat;  background-size: 26px 26px; }
			#educ .ui-icon { background:  url(images/icons/140-gradhat.png) 50% 50% no-repeat;  background-size: 26px 26px; }
		</style>

		<div data-role="footer" class="nav-glyphish-example">
			<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
			<ul>
				<li><a href="#" id="environ" data-icon="custom" data-theme="c">Environment</a></li>
				<li><a href="#" id="trans" data-icon="custom" data-theme="c">Transportation</a></li>
				<li><a href="#" id="health" data-icon="custom" data-theme="c">Healthcare</a></li>
				<li><a href="#" id="educ" data-icon="custom" data-theme="c">Education</a></li>

			</ul>
		</div>
	</div><!-- /content -->

<?php include_once("footer.php") ?>