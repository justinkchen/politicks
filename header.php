<?php 
session_start(); 
require_once("config.php");
?>
<!DOCTYPE html> 
<html> 
<head> 
<style>
body { float:left;}
</style>
	<title>Politicks</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<link rel="stylesheet" href="styles.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
	<script src="//cdn.optimizely.com/js/141417443.js"></script>
</head> 
<body> 

<div data-role="page" data-theme="b" data-content-theme="b" id="one">
<div data-role="header" data-position="fixed">
	<div data-role="controlgroup" data-type="horizontal" class="ui-btn-left">
		<a href="info.php" data-role="button" data-icon="info">Info</a>
	</div>
	<h1>Politicks</h1>
	<div data-role="controlgroup" data-type="horizontal" class="ui-btn-right">
		<a href="options.php" data-role="button" data-icon="gear" data-iconpos="notext"></a>
		<!--<a href="search.php" data-role="button" data-icon="search" data-iconpos="notext"></a>-->
	</div>
</div>

	<!-- /content goes here -->
