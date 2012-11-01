<?php include_once("header.php") ?>
<!-- /header -->

<div data-role="content">	
<form action="addissue.php" method="post">
	<div data-role="fieldcontain">
		<label for="title">Title:</label>
		<input type="text" name="title" id="title" data-mini="true" />
	</div>

<?php
	$sql = "select * from categories";
	$result = mysql_query($sql);
	$options="";
	while ($row=mysql_fetch_array($result)) { 
	    $id = $row["id"]; 
	    $name = $row["name"]; 
	    $options .= "<option value=\"$id\">".$name; 
	} 
?>
	<div data-role="fieldcontain">
		<label for="category" class="select">Category:</label>
		<select name="category" id="category" data-theme="c">
		<option value="none">None Selected</option>
		<?= $options; ?>
		</select>
	</div>

	<div data-role="fieldcontain">
		<label for="description">Description:</label>
		<textarea name="description" id="description" style="height: 100px;"></textarea>
	</div>
	<input type="submit" value="Add Issue"></input>
</form>
</div><!-- /content -->

<?php include_once("footer.php") ?>
<!-- /footer -->
