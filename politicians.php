<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
<?php
	$query = "select * from politicians";
	$result = mysql_query($query);
	$politicians = "";
	while ($row=mysql_fetch_array($result)) { 
	    $id = $row["id"]; 
	    $name = $row["name"]; 
	    $description = $row["description"];
	    $followers = $row["followers"];
	    $politicians .= "<li><a href=\"politicianprofile.php?id=".$id."\">".
				"".$name."".
				"<span class=\"ui-li-count\">".$followers." Followers</span>".
				"</a>".
				"</li>"; 
	} 
?>
		<div class="content-primary">	
			<ul data-role="listview" data-filter="true" data-filter-placeholder="Search politicians..." data-filter-theme="d"data-theme="d" data-divider-theme="d">
				<?= $politicians; ?>
			</ul>
			</div>
	</div><!-- /content -->

<?php include_once("footer.php") ?>