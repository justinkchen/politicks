<?php include_once("header.php") ?>
	<!-- /header -->

	<div data-role="content">	
		<div data-role="navbar">
		<ul>
			<li><a href="#" data-theme="c">Featured</a></li>
			<li><a href="index.php" data-theme="c">Liked</a></li>
			<li><a href="index.php" data-theme="c">Recent</a></li>
		</ul>
		</div><!-- /navbar -->
		<p> Welcome to Politicks! Your resource for making change in the world! </p>

		<br />
<div data-role="content">
		<div class="content-primary">	
		<ul data-role="listview" data-split-icon="arrow-r" data-theme="c" data-split-theme="d">
			<li><a href="index.html">
				<img src="images/icons/52-pine-tree.png" />
				<h3>Stop polluting pond.</h3>
				<p>tristique rutrum aliquet</p>
				</a>
			</li>
			<li><a href="index.html">
				
				<img src="images/icons/113-navigation.png" />
				<h3>Need more teachers.</h3>
				<p>Htristique rutrum</p>
				</a>
			</li>
			<li><a href="index.html">
				<img src="images/icons/52-pine-tree.png" />
				<h3>Duis sed risus non leo auctor adipiscing</h3>
				<p>Phoenix</p>
				</a>
			</li>
			<li><a href="index.html">
				<img src="images/icons/10-medical.png" />
				<h3>Vivamus ut justo sem, et varius felis.</h3>
				<p>Ok Go</p>
				</a>
			</li>
			<li><a href="index.html">
				<img src="images/icons/140-gradhat.png" />
				<h3>Proin nec velit eros, ac pellentesque odio.</h3>
				<p>The White Stripes</p><span class="ui-li-count">123 Supporters</span>
				</a>
			</li>
			<li><a href="index.html">
				<img src="images/icons/52-pine-tree.png" />
				<h3>Cras posuere nisl imperdiet turpis tempus porta.</h3>
				<p>MGMT</p>
				</a>
			</li>
			<li><a href="index.html">
				<img src="images/icons/10-medical.png" />
				<h3>Morbi posuere ligula eget felis lacinia mattis.</h3>
				<p>A Sunny Day in Glasgow</p>
				</a>
			</li>
			
			<li><a href="index.html">
				<img src="images/icons/10-medical.png" />
				<h3>Nulla sit amet nisi quam, id vestibulum neque.</h3>
				<p>Killers</p>
				</a>
			</li>
			<li><a href="index.html">	
				<img src="images/icons/140-gradhat.png" />
				<h3>Cras quis odio libero, ac dictum dui.</h3>
				<p>Arcade Fire</p>
				</a>
			</li>
		</ul>

		<br />

		<form action="login.php" method="post">
		<input type="hidden" name="logout" value="true" />

		<input type="submit" value="Logout" data-theme="a"></input>

		<br />

		<style>	
			.nav-glyphish-example .ui-btn .ui-btn-inner { padding-top: 40px !important; }
			.nav-glyphish-example .ui-btn .ui-icon { width: 30px!important; height: 30px!important; margin-left: -15px !important; box-shadow: none!important; -moz-box-shadow: none!important; -webkit-box-shadow: none!important; -webkit-border-radius: 0 !important; border-radius: 0 !important; }
			#environ .ui-icon { background:  url(images/icons/52-pine-tree.png) 50% 50% no-repeat; background-size: 26px 26px; }
			#trans .ui-icon { background:  url(images/icons/113-navigation.png) 50% 50% no-repeat; background-size: 26px 26px;  }
			#health .ui-icon { background:  url(images/icons/10-medical.png) 50% 50% no-repeat;  background-size: 26px 26px; }
			#educ .ui-icon { background:  url(images/icons/140-gradhat.png) 50% 50% no-repeat;  background-size: 26px 26px; }
			#coffee .ui-icon { background:  url(images/icons/100-coffee.png) 50% 50% no-repeat;  background-size: 20px 24px; }
			#skull .ui-icon { background:  url(images/icons/21-skull.png) 50% 50% no-repeat;  background-size: 22px 24px; }
		</style>

		<div data-role="footer" class="nav-glyphish-example">
			<div data-role="navbar" class="nav-glyphish-example" data-grid="a">
			<ul>
				<li><a href="#" id="environ" data-icon="custom" data-theme="c">Environment</a></li>
				<li><a href="#" id="trans" data-icon="custom" data-theme="c">Transportation</a></li>
				<li><a href="#" id="health" data-icon="custom" data-theme="c">Healthcare</a></li>
				<li><a href="#" id="educ" data-icon="custom" data-theme="c">Education</a></li>

			</ul>
		</div>
	</div><!-- /content -->

<?php include_once("footer.php") ?>