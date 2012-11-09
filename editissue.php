<?php include_once("header.php") ?>
<!-- /header -->

<div data-role="content">	
<?php
checkLogin();

if(isset($_GET["id"])){
	$query = sprintf("select * from issues where id='%s'", mysql_real_escape_string($_GET["id"]));
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if(mysql_num_rows($result) == 0){
		redirect_to_URL("createdissues.php");
	}
	$title = $row["name"];
	$description = $row["description"];
	$category = $row["category_id"];
}else{
	redirect_to_URL("createdissues.php");
}

$titleErr = $categoryErr = $descriptionErr = "";
$status = "";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if (empty($_POST["title"])){
		$titleErr = "Missing title for issue";
	}else{
		$title = $_POST["title"];
	}
	if ($_POST["category"] == "none"){
		$categoryErr = "No category selected";
	}else{
		$category = $_POST["category"];
	}
	if (empty($_POST["description"])){
		$descriptionErr = "Missing description for issue";
	}else{
		$description = $_POST["description"];
	}
	if ($titleErr == "" && $categoryErr == "" && $descriptionErr == ""){
		$query = sprintf("update issues set name='%s', description='%s', category_id='%s' where id='%s'", mysql_real_escape_string($_POST["title"]), mysql_real_escape_string($_POST["description"]), mysql_real_escape_string($_POST["category"]), mysql_real_escape_string($_GET["id"]));
		if(mysql_query($query)){
			$status = "Successfully edited the issue!";
		}else{
			$status = "Update failed due to database problems. Please try again.";
		}
	}else{
		$status = "Please fix the following errors";
	}
}
?>

<span class="status"><?= $status; ?></span>
<form action="editissue.php?id=<?= $_GET["id"] ?>" method="post">
	<div data-role="fieldcontain">
		<label for="title">Title:</label>
		<input type="text" name="title" id="title" class="ui-disabled" data-mini="true" placeholder="e.g. Enter title here" value="<?= $title; ?>" />
		<span class="error"><?php echo $titleErr;?></span>
	</div>

<?php
	$sql = "select * from categories";
	$result = mysql_query($sql);
	$options="";
	while ($row=mysql_fetch_array($result)) { 
	    $id = $row["id"]; 
	    $name = $row["name"]; 
	    if (strval($id) == strval($category)){
	    	$options .= "<option value=\"$id\" selected>".$name;
	    }else{	
	    	$options .= "<option value=\"$id\">".$name; 
	    }
	} 
?>
	<div data-role="fieldcontain">
		<label for="category" class="select">Category:</label>
		<select name="category" id="category" data-theme="c">
		<option value="none" selected>None Selected</option>
		<?= $options; ?>
		</select>
		<span class="error"><?php echo $categoryErr;?></span>
	</div>

	<div data-role="fieldcontain">
		<label for="description">Description:</label>
		<textarea name="description" id="description" placeholder="e.g. Enter description here" style="height: 100px;" value="<?= $description; ?>"><?= $description; ?></textarea>
		<span class="error"><?php echo $descriptionErr;?></span>
	</div>

	<input type="submit" value="Edit Issue"></input>
</form>
<p align="right"><a href='createdissues.php' data-role='button' data-mini='true' data-inline='true' data-theme='a'>Go back to Created Issues</a></p>
</div><!-- /content -->

<?php include_once("footer.php") ?>
<!-- /footer -->
