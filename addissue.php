<?php include_once("header.php") ?>
<!-- /header -->

<div data-role="content">	
<?php
	checkLogin();
?>
<?php 
$titleErr = $categoryErr = $descriptionErr = "";
$title = $description = "";
$category = "none";
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
		$query = sprintf("insert into issues (name, description, category_id, user_id) values ('%s','%s', %s, %s)", mysql_real_escape_string($_POST["title"]), mysql_real_escape_string($_POST["description"]), mysql_real_escape_string($_POST["category"]), mysql_real_escape_string($_SESSION["userid"]));
		if(mysql_query($query)){
			$status = "Successfully added the issue! You're one step closer to making a difference!";
			$title = $description = "";
			$category = "none";
		}else{
			$status = "Creation failed due to database problems. Please try again.";
		}
	}else{
		$status = "Please fix the following errors";
	}
}
?>

<span class="status"><?= $status; ?></span>
<form action="addissue.php" method="post">
	<div data-role="fieldcontain">
		<label for="title">Title:</label>
		<input type="text" name="title" id="title" data-mini="true" value="<?= $title; ?>" />
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
		<textarea name="description" id="description" style="height: 100px;" value="<?= $description; ?>"><?= $description; ?></textarea>
		<span class="error"><?php echo $descriptionErr;?></span>
	</div>
	<input type="submit" value="Add Issue"></input>
</form>
</div><!-- /content -->

<?php include_once("footer.php") ?>
<!-- /footer -->
