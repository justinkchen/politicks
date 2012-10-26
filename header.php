<?php 
session_start(); 
//require_once("requires.php");
?>
<!DOCTYPE html> 
<html> 
<head> 
	<title>Politicks</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 
<body> 

	<div data-role="page" data-theme="b" data-content-theme="b">
	<div data-role="header">
		<a href="index.php" data-icon="home" class="ui-btn-left">Home</a>
		<h1>Politicks</h1>
		<a href="index.php" data-icon="gear" class="ui-btn-right">Options</a>
		<div data-role="navbar">
		<ul>
			<li><a href="a.html">Info</a></li>
			<li><a href="b.html">Friends</a></li>
			<li><a href="c.html">Albums</a></li>
			<li><a href="d.html">Emails</a></li>
		</ul>
	</div><!-- /navbar -->
	</div>