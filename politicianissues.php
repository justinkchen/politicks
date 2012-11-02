<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
<?php
	checkLogin();
?>
		<br />

<?php
	if(isset($_GET["pid"])){
		if(isset($_GET["cid"])){
			$query = sprintf("select * from proposedsolutions where politician_id='%s' and category_id='%s'",mysql_real_escape_string($_GET["pid"]), mysql_real_escape_string($_GET["cid"]));
		}else{
			$query = sprintf("select * from proposedsolutions where politician_id='%s'",mysql_real_escape_string($_GET["pid"]));
		}
	}else{
	    echo "<script type=\"text/javascript\">".
  			"window.location = \"politicians.php\"".
  			"</script>";
	}

	$result = mysql_query($query);
	$issues = "";
	$numissues = mysql_num_rows($result);
	if($numissues == 0){
		$issues = "<center>No issues found matching that criteria</center><br /><br />";
	}
	while ($row=mysql_fetch_array($result)) { 
	    $issue_id = $row["issue_id"];

		$categoryq = sprintf("select * from categories where id='%s'", mysql_real_escape_string($row["category_id"]));
		$categoryresult = mysql_query($categoryq);
		$categoryrow=mysql_fetch_array($categoryresult);
		$issueq = sprintf("select * from issues where id='%s'", mysql_real_escape_string($issue_id));
		$issueresult = mysql_query($issueq);
		$issuerow=mysql_fetch_array($issueresult);

	    $name = $issuerow["name"]; 
	    $description = $issuerow["description"];

	    $icon = $categoryrow["icon"];
	    $issues .= "<li><a href=\"issues.php?id=".$issue_id."\">".
				"<img src=\"".$icon."\" />".
				"<h3>".$name."</h3>".
				"<p>".$description."</p>".
				"</a>".
				"</li>"; 
	} 

	$politicianq = sprintf("select * from politicians where id='%s'", mysql_real_escape_string($_GET["pid"]));
	$politicianresult = mysql_query($politicianq);
	$politicianrow=mysql_fetch_array($politicianresult);
?>
		<div class="content-primary">	
		<ul data-role="listview" data-split-icon="arrow-r" data-theme="c" data-split-theme="d" data-filter="true" data-filter-placeholder="Search <?= $politicianrow["name"]; ?> Issues...">
			<?= $issues; ?>
		</ul>
		</div>
		<br />
	</div><!-- /content -->

<?php include_once("footer.php") ?>