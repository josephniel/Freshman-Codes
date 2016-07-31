<!doctype>
<html>
	<head>
		<title>Joseph Niel Tuazon's Online Profile</title>
		
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />

		<link rel='icon' type='image/png' href='./images/favicon.ico'>

		<link rel='stylesheet' type='text/css' href='./css/foundation.css'>
		<link rel='stylesheet' type='text/css' href='./css/normalize.css'>
		<link rel='stylesheet' type='text/css' href='./css/app.css'>
		
	</head>
	
	<body>
		
		<header id='index'>
			<center>
				<img src='./images/profileImage.jpg' id='portrait'>
				<br>
				<div id='summary'>
					<b>Joseph Niel Tuazon</b><br>
					<span>3rd Year Computer Science Student <br> University of the Philippines, Manila</span>
				</div>
			</center>
		</header>
		
		<section id="menu">
			<div id='menu-items-container' class='clearfix'>
				<a class='menu-item' href='#index'>Home</a>
				<a class='menu-item' href='#about'>About Me</a>
				<a class='menu-item' href='#works'>Works and Projects</a>
			</div>
		</section>
		
		<section id='main-container' class='row'>
			
			<section id='about'>
				<div id='stick1' class='section-title text-left stick'>
					<h3>About Me</h3>
						
					<span class='label radius secondary'>
						<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
						<script type="IN/MemberProfile" data-id="https://www.linkedin.com/pub/joseph-niel-tuazon/70/626/748" data-format="hover" data-related="false" data-text="Joseph Niel Tuazon"></script>
					</span>
				</div>
				<?php include_once('./contents/about.php'); ?>
			</section>
			
			<section id='works'>
				<div id='stick2' class='stick'>
					<div class='works-spacer'></div>
					<center><h3 class='section-title'>Works and Projects</h3></center>
				</div>
				<?php include_once('./contents/works.php'); ?>
			</section>
			
		</section>
		
		<footer class='fullWidth'>
			<section class='row'>
				
			</section>
		</footer>
		
		<?php include_once('./contents/modal.php'); ?>
		
		<script src="./js/jquery.min.js"></script>
		<script src="./js/foundation/foundation.min.js"></script>
		<script src="./js/foundation/foundation.equalizer.js"></script>
		<script src="./js/foundation/foundation.orbit.js"></script>
		<script src="./js/sticky/jquery.sticky-kit.min.js"></script>
		<script src="./js/script.js"></script>
		
	</body>
</html>