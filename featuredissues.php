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
	    $funding = $row["funding"];
	    $category = $row["category_ids"];
	    if( $count%3 == 0) $color="green ";
	    else if ( $count%3 == 1) $color=" #FF6600"; 
	     else $color="#585858";

	   
	    $issues .= 
	    	    
	    	    "<div class=\"shadow\" style=\" width:100%; height: 110px; background-color:white ; border-bottom: 1px solid grey;\" >".

	  #  "<a style=\"display:block; width:100%; line-height:0;\" href=\"issues.php?id=".$id."\">".$block.
				
					"<div style=\"display:block; width:100%; line-height:0; position:relative; \">".
					"<span style=\" position:absolute; left:5px;top:23px;font-family:'Arial'; font-size: .75em; color: #aaa; \" >WEB & SOCIAL</span>".
						"<span style=\"position:absolute; left:5px;top:33px;\"><img style=\" float:left; text-align:left; width:70px; height:70px;\" src=\"".$image."\" /></span>".
							
							
							
							"<div style=\" position:absolute;\">".
							"<div style=\" width:200px; height:3em; position:relative; line-height: 1em; padding-left:10px; padding-right:20px; overflow: hidden; top: 33px; text-align:left; left: 69px; word-wrap:break-word; font-family:'Arial';font-size: 1em;\">".$name."".

 "<br /><div style=\"position:relative;  height:1em; font-size:.7em; padding-right:20px; float:left; text-align:left;width:200px; \">Supported by: Barack Obama</div>".

  "</div>".
							
							
							
							"</div>".
								
							"<span style=\"position:relative; top: 26px; right:-120px;\">$</span><div class=\"box\" style=\" padding-top:7px; width: 60px; height:15px; top: 12px; float:right; position: relative;background-color:#ab3fdd;\"><span style=\"font-size:.75em; color:white\">".$funding."</span></div>".

						"</div>".		
					

"</div>";

#"<span style=\" position:absolute; top: 39px;left:80px; width:180px;font-family:'Arial'; text-align:left;font-size: .75em;  word-wrap:break-word; color: #aaa;  \">asdfasdfasdfasdfsaadsfsdaf".$name."</span>".

								#	"<span style=\"  padding:5px; font-family:'Old Standard TT';width: 70%; float: left; text-align:left; color: #fff; word-wrap: break-word;  \" >".$name." </span>".
								#	"<span style=\"  padding:5px; width: 20%; float: right; text-align:right; color: #fff; word-wrap: break-word;  \" >$".$funding." </span>".
#"<span style=\"  padding:5px; font-family:'Old Standard TT';float: left; text-align:left; color: #aaa; \" >".$name." </span>".
	    
	    
	   # "<center>".
	    
			#	"<img style=\"border-radius:0px; line-height: 0; height:160px;\" class=\"grid\" src=\"".$image."\" />".

			#	"</center>".
				

				

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