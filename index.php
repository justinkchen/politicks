<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	

<?php
	$status = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$uname = $pword = "";
		if (isset($_POST["username"]) && isset($_POST["password"])){
			$uname = $_POST["username"];
			$pword = $_POST["password"];
		}
		verifyLogin($uname, $pword);
	}else{
		$dispError = false;
		checkLogin($dispError);
	}
	if (isset($_GET["status"]) && $_GET["status"] == "regsuccess"){
		$status = "Successfully created account! Welcome!<br /><br />";
	}else if (isset($_GET["status"]) && $_GET["status"] == "addsuccess"){
		$status = "Successfully added an issue!<br /><br />";
	}

	// Getting Featured Issues
	$query = sprintf("select * from issues");
	$result = mysql_query($query);
	$issuesgrid = "";
	$issuesgridstyle = "";
	$numissues = mysql_num_rows($result);
	$count = 0;
	while ($row=mysql_fetch_array($result)) {
		if ($count < 3){ 
		    $id = $row["id"]; 
		    $name = $row["name"]; 
		    $description = $row["description"];
		    $countstr = (string)$count;
		    if ($count == 0){
		    	$image1 = $row["image"];
		    	$id1 = $row["id"];
		    	$title1 = $row["name"];
		    }else if($count == 1){
		    	$image2 = $row["image"];
		    	$id2 = $row["id"];
		    	$title2 = $row["name"];
		    }else{
				$image3 = $row["image"];
				$id3 = $row["id"];
				$title3 = $row["name"];
		    }
		    $count += 1;
		}else{
			break;
		}
	} 
	
	$query = "select * from categories";
	$result = mysql_query($query);
	while ($row=mysql_fetch_array($result)){
		$issuesgridstyle .= "#".$row["name"]." .ui-icon { background:  url(".$row["icon"].") 50% 50% no-repeat; background-size: 26px 26px; }";
		$issuesgrid .= "<li><a href=\"featuredissues.php?category=".$row["id"]."\" id=\"".$row["name"]."\" data-icon=\"custom\" data-theme=\"c\">".$row["name"]."</a></li>";
	}
?>

<script type="text/javascript">
x = 0;
function changeImage()
{
    var img = document.getElementById("image");
    var link = document.getElementById("link");
    var title = document.getElementById("title");
    img.src = images[x];
    x++;

    if(x >= images.length){
        x = 0;
    } 

    fadeImg(img, 100, true);
    setTimeout("changeImage()", 10000);
}

function fadeImg(el, val, fade){
    if(fade === true){
        val--;
    }else{
        val ++;
    }

    if(val > 0 && val < 100){
        el.style.opacity = val / 100;
        setTimeout(function(){fadeImg(el, val, fade);}, 10);
    }
}

var images = [];

images[0] = "<?= $image1 ?>";
images[1] = "<?= $image2 ?>";
images[2] = "<?= $image3 ?>";
ids[0] = "<?= $id1 ?>";
ids[1] = "<?= $id2 ?>";
ids[2] = "<?= $id3 ?>";
titles[0] = "<?= $title1 ?>";
titles[1] = "<?= $title2 ?>";
titles[2] = "<?= $title3 ?>";
setTimeout("changeImage()", 10000);
</script>

<span class="status"><?= $status; ?></span>
		<div class="featured">
			<center>
				<b>FEATURED</b>
				<br />
				<br />
				<a id="link" href="issues.php?id=<?= $id ?>">
				<img id="image" class="resize" src="<?= $image1 ?>"></img>
				</a>
				<br />
				<p id="title" class="title"><?= $name ?></p>
				<br />
			</center>
		</div>
		<style>	
			.nav-glyphish-example .ui-btn .ui-btn-inner { padding-top: 40px !important; }
			.nav-glyphish-example .ui-btn .ui-icon { width: 30px!important; height: 30px!important; margin-left: -15px !important; box-shadow: none!important; -moz-box-shadow: none!important; -webkit-box-shadow: none!important; -webkit-border-radius: 0 !important; border-radius: 0 !important; }
			<?= $issuesgridstyle; ?>
		</style>

		<a href="featuredissues.php" data-role="button" data-theme="c">All Issues</a>
		<div data-role="footer" class="nav-glyphish-example">
			<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
			<ul>
				<?= $issuesgrid; ?>
			</ul>
			</div>
		</div>

	</div><!-- /content -->

<?php include_once("footer.php") ?>