<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
<?php
	if(isset($_GET["issue_id"])){
		$query = sprintf("select * from proposedsolutions where issue_id='%s'",mysql_real_escape_string($_GET["issue_id"]));
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$solution = $row["solution"];
		if(mysql_num_rows($result) == 0){
		    echo "<script type=\"text/javascript\">".
	  			"window.location = \"index.php\"".
	  			"</script>";
		}

		$query = sprintf("select * from politicians where id='%s'",mysql_real_escape_string($row["politician_id"]));
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$politician = $row["name"];
		$description = $row["description"];
		$pid = $row["id"];
	}else{
	    echo "<script type=\"text/javascript\">".
  			"window.location = \"index.php\"".
  			"</script>";
	}
?>
		<h1> Proposed Solution </h1>
		<p> <?= $solution; ?> </p>

		<h1> About the Politician </h1>
		<h3> <?= $politician ?> </h3>
		<p> <?= $description ?> </p>
		<a href="politicianprofile.php?id=<?= $pid; ?>" data-role="button">View Politician</a>

	</div><!-- /content -->

<?php include_once("footer.php") ?>