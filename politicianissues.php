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
  		redirect_to_URL("politicians.php");
	}

	$result = mysql_query($query);
	$issues = "";
	$numissues = mysql_num_rows($result);
	if($numissues == 0){
		$issues = "<center>No issues found matching that criteria</center><br /><br />";
	}
	while ($row=mysql_fetch_array($result)) { 
		$issue_id = $row["issue_id"]; 
		$issueq = sprintf("select * from issues where id='%s'", mysql_real_escape_string($issue_id));
		$issueresult = mysql_query($issueq);
		$issuerow=mysql_fetch_array($issueresult);
	    $name = $issuerow["name"]; 
	    $description = $issuerow["description"];
	    $image = $issuerow["image"];
	    $funding = $issuerow["funding"];

	    $categoryq = sprintf("select * from categories where id='%s'", mysql_real_escape_string($row["category_id"]));
	    $categoryresult = mysql_query($categoryq);
	    $categoryrow = mysql_fetch_array($categoryresult);
	    $categoryname = $categoryrow["name"];

	    $query = sprintf("select *, p.name as pname from proposedsolutions s, politicians p where s.issue_id='%s' and s.politician_id=p.id",mysql_real_escape_string($issue_id));
	    $solutionresult = mysql_query($query);
	    $solutionrow = mysql_fetch_array($solutionresult);
	    if(mysql_num_rows($solutionresult)){
	    	$politician = "Supported by: ".$solutionrow["pname"];
	    }else{
	    	$politician = "&nbsp;";
	    }
	    // if ($count % 2 == 0){
	    // 	$block = "<div class='ui-block-a'>";
	    // }else{
	    // 	$block = "<div class='ui-block-b'>";
	    // }
	   //  $issues .= "<a href=\"issues.php?id=".$id."\">".$block."<center>".
				// "<img class=\"grid\" src=\"".$image."\" />".
				// "<p class=\"title\">".$name."</p>".
				// "</center>".
				// "</div></a>";
	    $issues .= "<li data-icon=\"false\"><a href=\"issues.php?id=".$issue_id."\">".
	    		"<span class=\"category\">".strtoupper($categoryname)."</span>".
				"<img src=\"".$image."\" class=\"list\" />".
				"<h3 class=\"issueTitle\">".$name."</h3>".
				"<p class=\"issuePolitician\">".$politician."</p>".
				"<p class=\"issueFunding\">$".number_format($funding, 2)."</p>".
				"<br /><br /></a>".
				"</li>"; 

		// $count += 1; 
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