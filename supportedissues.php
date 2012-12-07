<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
<?php
	$status = "";
	checkLogin();
	if (isset($_GET["status"]) && $_GET["status"] == "addsuccess"){
		$status = "Successfully added an issue!<br /><br />";
	}

	if(isset($_GET["category"])){
		$featuredurl = sprintf("featuredissues.php?category=%s",$_GET["category"]);
		$supportedurl = sprintf("supportedissues.php?category=%s",$_GET["category"]);
		$createdurl = sprintf("createdissues.php?category=%s",$_GET["category"]);
	}else{
		$featuredurl = sprintf("featuredissues.php");
		$supportedurl = sprintf("supportedissues.php");
		$createdurl = sprintf("createdissues.php");		
	}
?>
		<span class="status"><?= $status; ?></span>
		<div data-role="navbar">
		<ul>
			<li><a href="<?= $featuredurl ?>" data-theme="c">Featured</a></li>
			<li><a href="<?= $supportedurl ?>" data-theme="c" class="ui-btn-active ui-state-persist">Supported</a></li>
			<li><a href="<?= $createdurl ?>" data-theme="c">Created</a></li>
		</ul>
		</div><!-- /navbar -->

<?php
	if(isset($_GET["category"])){
		$query = sprintf("select *, issues.id as iid, issues.name as iname, categories.name as cname from issues, categories, userstoissues where issues.category_id = '%s' and categories.id = '%s' and issues.id = userstoissues.issue_id and userstoissues.user_id = '%s'", mysql_real_escape_string($_GET["category"]), mysql_real_escape_string($_GET["category"]), mysql_real_escape_string($_SESSION["userid"]));
	}else{
		$query = sprintf("select *, issues.id as iid, categories.id as cid, issues.name as iname, categories.name as cname from issues,categories, userstoissues where issues.category_id = categories.id and issues.id = userstoissues.issue_id and userstoissues.user_id = '%s'", mysql_real_escape_string($_SESSION["userid"]));
	}

	$output = "<a href=\"index.php\" data-role=\"button\" data-theme=\"b\">Return Home</a>";
	$result = mysql_query($query);
	$issues = "";
	$numissues = mysql_num_rows($result);
	if($numissues == 0){
		$issues = "<center>No issues found matching that criteria</center><br /><br />";
	}
	$count = 0;
	while ($row=mysql_fetch_array($result)) { 
	    $id = $row["iid"]; 
	    $name = $row["iname"]; 
	    $description = $row["description"];
	    $icon = $row["icon"];
	    $image = $row["image"];
	    $categoryname = $row["cname"];
	    $funding = $row["funding"];

	    $query = sprintf("select *, p.name as pname from proposedsolutions s, politicians p where s.issue_id='%s' and s.politician_id=p.id",mysql_real_escape_string($id));
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
	    $issues .= "<li data-icon=\"false\"><a href=\"issues.php?id=".$id."\">".
	    		"<span class=\"category\">".strtoupper($categoryname)."</span>".
				"<img src=\"".$image."\" class=\"list\" />".
				"<h3 class=\"issueTitle\">".$name."</h3>".
				"<p class=\"issuePolitician\">".$politician."</p>".
				"<p class=\"issueFunding\">$".number_format($funding, 2)."</p>".
				"<br /><br /></a>".
				"</li>"; 
		// $count += 1; 
	} 
?>


		<div class="content-primary">	
		<center>
		<br />
		<?php 
		//<div class="ui-grid-a">
		//	$issues;
		//</div>
		?>
			<ul data-role="listview" data-split-icon="arrow-r" data-theme="c" data-split-theme="d" data-filter="true" data-filter-placeholder="Search Issues...">
			<?= $issues; ?>
			</ul>
		</center>

		<br />
		<?= $output; ?>
		</div>
	</div><!-- /content -->

<?php include_once("footer.php") ?>