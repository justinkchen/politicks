
<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	

		<script type="text/javascript" >
		// Location tracking
		latitude = 0;
		longitude = 0;
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
				latitude = (position.coords.latitude).toFixed(6);
				longitude = (position.coords.longitude).toFixed(6);
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
						latInput.value = Math.round(latitude*Math.pow(10,3))/Math.pow(10,3);
						longInput.value = Math.round(longitude*Math.pow(10,3))/Math.pow(10,3);
						hideFarAwayEvents(10,10);
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

		function hideFarAwayEvents(latRange, longRange) {
			var elems = document.getElementsByTagName('*'), i;
			for (i in elems) {
				if((' ' + elems[i].className + ' ').indexOf('issueLat') > -1) {
					var issueLat = elems[i].value;
					if (Math.abs(parseFloat(issueLat) - latitude) > latRange){
						elems[i].parentNode.removeChild(elems[i]);
						continue;
					}
				}
				if((' ' + elems[i].className + ' ').indexOf('issueLong') > -1) {
					var issueLong = elems[i].value;
					if (Math.abs(parseFloat(issueLong) - longitude) > longRange){
						elems[i].parentNode.removeChild(elems[i]);
						continue;
					}
				}
			}
		}
		
		</script>

		<?php
			$status = "";
		?>
				<span class="status"><?= $status; ?></span>
				<div class="textbox">
					Issues near your coordinates:
					<br />
					<table>
						<tr>
							<td>Latitude: <input  type="text" disabled="disabled" class="latlong" name="latitude" id="latitude" value="0"></td>
							<td>Longitude: <input type="text" disabled="disabled" class="latlong" name="longitude" id="longitude" value="0"></td>
						</tr>
					</table>
				</div>

		<?php
			if(isset($_GET["category"])){
				$query = sprintf("select *, issues.id as iid, issues.name as iname, categories.name as cname from issues, categories where issues.category_id = '%s' and categories.id = '%s'", mysql_real_escape_string($_GET["category"]), mysql_real_escape_string($_GET["category"]));
			}else{
				$query = "select *, issues.id as iid, categories.id as cid, issues.name as iname, categories.name as cname from issues,categories where issues.category_id = categories.id";
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
				$latitude = $row["latitude"];
				$longitude = $row["longitude"];

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
						"<input type=\"hidden\" class=\"issueLat\" value=\"".$latitude."\">".
						"<input type=\"hidden\" class=\"issueLong\" value=\"".$longitude."\">".
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