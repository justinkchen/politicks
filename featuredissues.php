<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="fullscreen">	
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
		<div style="width:100%;height:100%; vertical-align: middle;">  

		<div data-role="navbar" style="  margin:10px auto;">
		<ul>
			<li><a href="<?= $featuredurl ?>" style="background: #B0B0B0;"  data-theme="c" class="ui-btn-active ui-state-persist">FEATURED</a></li>
			<li><a href="<?= $supportedurl ?>"  style="background: #B0B0B0;" data-theme="c" >SUPPORTED</a></li>
			<li><a href="<?= $createdurl ?>" style="background: #B0B0B0;" data-theme="c" ">CREATED</a></li>
		</ul>
		</div><!-- /navbar -->
		</div>

<?php
	if(isset($_GET["category"])){
		$query = sprintf("select *, issues.id as iid, issues.name as iname from issues, categories where issues.category_id = '%s' and categories.id = '%s'", mysql_real_escape_string($_GET["category"]), mysql_real_escape_string($_GET["category"]));
	}else{
		$query = "select *, issues.id as iid, categories.id as cid, issues.name as iname, categories.name as cname from issues,categories where issues.category_id = categories.id";
	}
	$output = "<a href=\"index.php\" data-role=\"button\" data-theme=\"b\">View All Issues</a>";
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
	    $funding = $row["funding"];
	    if( $count%3 == 0) $color="green ";
	    else if ( $count%3 == 1) $color=" #FF6600"; 
	     else $color="#585858";

	   
	    $issues .= 
	    "<div class=\"shadow\" style=\"width:100%; background-color:".$color.";\" >".
				

									"<span style=\"  padding:5px; font-family:'Old Standard TT';width: 70%; float: left; text-align:left; color: #fff; word-wrap: break-word;  \" >".$name." </span>".
									"<span style=\"  padding:5px; width: 20%; float: right; text-align:right; color: #fff; word-wrap: break-word;  \" >$".$funding." </span>".

				"<div style=\"clear:both\"></div>".
				"</div>".
	    
	    "<a style=\"line-height:0;\" href=\"issues.php?id=".$id."\">".$block."<center>".
	    
	    
	    
				"<img style=\"border-radius:0px; line-height: 0; height:160px;\" class=\"grid\" src=\"".$image."\" />".

				"</center>".
				

				"</a>";
				

		$count += 1; 
	} 
?>


		<div class="content-primary">	
		<center>
		<div class="ui-grid-a">
			<?= $issues; ?>
		</div>
		</center>

		<br />
		<?= $output; ?>
		</div>
	</div><!-- /content -->

<?php include_once("footer.php") ?>