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
	$image = "http://www.addictinginfo.org/wp-content/uploads/2010/12/politics.png";
	if ($titleErr == "" && $categoryErr == "" && $descriptionErr == ""){
		$query = sprintf("insert into issues (name, description, category_id, user_id, latitude, longitude, image) values ('%s','%s', '%s', '%s', '%s', '%s', '%s')", mysql_real_escape_string($title), mysql_real_escape_string($_POST["description"]), mysql_real_escape_string($category), mysql_real_escape_string($_SESSION["userid"]), mysql_real_escape_string($_POST["latitude"]), mysql_real_escape_string($_POST["longitude"]), mysql_real_escape_string($image));
		if(mysql_query($query)){
			redirect_to_URL("createdissues.php?status=addsuccess");
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


<script type="text/javascript" >
// Location tracking
$(document).ready(function() 
{
 	
   // W3C Geolocation check, if successful call successCallback otherwise errorCallback
	if(navigator.geolocation) 
	{ 
	 	navigator.geolocation.getCurrentPosition(successCallback,errorCallback, {enableHighAccuracy: true, timeout: 10000, maximumAge: 20000}); 
	} 
	//Success Callback function
	function successCallback(position){
		//Declare all the variables
		var latitude = (position.coords.latitude).toFixed(6);
		var longitude = (position.coords.longitude).toFixed(6);
		var geocoder = new google.maps.Geocoder();
	    var latlng = new google.maps.LatLng(latitude, longitude);				
	   
	   latInput = document.getElementById("latitude");
	   longInput = document.getElementById("longitude");
	   //Reverse geocode the users current location
	   geocoder.geocode({'latLng': latlng}, function(results, status) 
	   {
	   	if (status == google.maps.GeocoderStatus.OK) 
	   	{
	   		if (results[1])
	   		{
	   			latInput.value = latitude;
	   			longInput.value = longitude;
	   		}
	   	}
	   	else
	   	{
	   		alert("Geocoder failed due to: " + status);
	   	}
	   });
  	}	
  	//Error call back for geolocation
	function errorCallback() 
	{ 
		alert("Sorry, we couldn't find your location"); 
	}
});
</script>

<span class="status"><?= $status; ?></span>
<form action="addissue.php" method="post">
	<div data-role="fieldcontain">
		<label for="title">Title:</label>
		<input type="text" name="title" id="title" data-mini="true" placeholder="e.g. Enter title here" value="<?= $title; ?>" />
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

	<input type="hidden" name="latitude" id="latitude" value="0">
	<input type="hidden" name="longitude" id="longitude" value="0">

	<input type="submit" value="Add Issue"></input>
</form>
<p align="right"><a href='index.php' data-role='button' data-mini='true' data-inline='true' data-theme='a'>Go back to Issues list</a></p>
</div><!-- /content -->

<?php include_once("footer.php") ?>
<!-- /footer -->
