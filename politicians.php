<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
<?php
	checkLogin();
?>
<?php
	$query = "select * from politicians";
	$result = mysql_query($query);
	$politicians = "";
	while ($row=mysql_fetch_array($result)) { 
	    $id = $row["id"]; 
	    $name = $row["name"]; 
	    $image = $row["image"];
	    $description = $row["description"];
	    $followers = $row["followers"];
	    $title = $row["title"];
	    $politicians .= "<li data-icon='false'><a href=\"politicianprofile.php?id=".$id."\">".
	    		"<span class='category'>".$title."</span>".
	    		"<img src=\"".$image."\" class=\"list\" />".
				"<h3 class='politicianTitle'>".$name."</h3>".
				"<p class='followers'>".$followers." Followers</p>".
				"<br /><br /></a>".
				"</li>"; 
	} 
?>
		<div class="content-primary">	
			<ul data-role="listview" data-filter="true" data-filter-placeholder="Search politicians..." data-filter-theme="d" data-theme="d" data-divider-theme="d">
				<?= $politicians; ?>
			</ul>
			</div>
	</div><!-- /content -->

<?php include_once("footer.php") ?>