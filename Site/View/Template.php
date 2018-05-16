<!DOCTYPE HTML>
<!--
	TXT by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>TXT by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/custom.css" />

		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<div class="logo container">
						<div>
							<h1><a href="index.php" id="logo">FILE UPLOAD</a></h1>
							<p>Share your project with other developpers</p>
						</div>
					</div>
				</header>

			<!-- Nav -->
			<nav id="nav">
				<ul>
					<li class="current"><a href="index.php?action=view_home">Home</a></li>
					<li><a href="index.php?action=view_project">Project</a></li>
					<li><a href="index.php?action=view_forum">Forums</a></li>
					<li><a href="index.php?action=view_about">About</a></li>
					<li>
					<?php
						$User = $GLOBALS['userController'];

						if($User->isConnected())
						{
							?>
								<a href="#">User</a>
								<ul>
									<li><a href="index.php?action=view_user_profile">ViewProfile</a></li>
									<li><a href="index.php?action=view_user_logout">LogOut</a></li>
								</ul>
							<?php
						}

						else
						{
							?>
								<a href="#">Login</a>
								<ul>
									<form>
										<li><a href="index.php?action=view_user_login">Login</a></li>
										<li><a href="index.php?action=view_	user_register">Register</a></li>
									</form>

								</ul>
							<?php
						}
					?>
					

					</li>
				</ul>
			</nav>
            
			<!-- Main -->
            <div id="main-wrapper">
                <div id="main" class="container">
				<?=$content;?>
                </div>
            </div>
		
			<!-- Footer -->
				<footer id="footer" class="container">
					<div class="row 200%">
						<div class="12u">

							<!-- About -->
								<section>
									<h2 class="major"><span>What's this about?</span></h2>
									<p>
										This is <strong>TXT</strong>, yet another free responsive site template designed by
										<a href="http://twitter.com/ajlkn">AJ</a> for <a href="http://html5up.net">HTML5 UP</a>. It's released under the
										<a href="http://html5up.net/license/">Creative Commons Attribution</a> license so feel free to use it for
										whatever you're working on (personal or commercial), just be sure to give us credit for the design.
										That's basically it :)
									</p>
								</section>

						</div>
					</div>
				

					<!-- Copyright -->
						<div id="copyright">
							<ul class="menu">
								<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>

				</footer>

			</div>

		<!-- Scripts -->

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

			<script src="View/User/SwitchProjectTab.js"></script>


	</body>
</html>