
<style>
	#politicians .ui-icon { background:  url(images/icons/111-user.png) white 50% 50% no-repeat;  background-size: 24px 24px; }
	#nearby .ui-icon { background:  url(images/icons/73-radar.png) white 50% 50% no-repeat;  background-size: 24px 24px; }
</style>

<div data-role="footer" data-position="fixed">
	<div data-role="navbar">
		<ul>
			<li><a href="index.php" data-icon="home" data-theme="c">Home</a></li>
			<li><a href="politicians.php" id="politicians" data-icon="custom" data-theme="c">Politicians</a></li>
			<li><a href="nearby.php" id="nearby" data-icon="custom" data-theme="c">Nearby</a></li>
			<li><a href="addissue.php" data-icon="plus" data-theme="c">Add Issue</a></li>
		</ul>
	</div>

</div><!-- /page -->
<?php mysql_close(); ?>
</body>
</html>
