<?php 

	$host= gethostname();
	$ip = gethostbyname($host);

	$mainLink = 'http://'.$ip.$_SERVER['REQUEST_URI'].'post.php';
?>
<!doctype>
<html>
	
	<head>
		
		<title>DOH Web Service API</title>
		
		<link rel='icon' type='image/png' href='assets/images/DOH-logo.ico'>
		
		<link rel='stylesheet' type='text/css' href='assets/css/foundation.min.css'>
		<link rel='stylesheet' type='text/css' href='assets/css/normalize.css'>
		<link rel='stylesheet' type='text/css' href='assets/css/app.css'>
		<link rel='stylesheet' type='text/css' href='assets/css/theme.css'>
		
	</head>
	
	<body>
		
		<header class='text-center'>
			<section class='row'>
				<section class='small-12 columns'>
					<img src='assets/images/DOH-logo.png' id='page-logo'>
				</section>
				<h3 class='large-12 columns show-for-large-up' id='page-title'>
					DOH Web Service API
				</h3>
				<h5 class='subheader large-12 columns show-for-large-up'>
					A SOAP-based web service for automated statistics transmission
				</h5>
			</section>
		</header>
		
		<section id='main-content' class='row'>
		
			<section id='web-service-link' class='text-center'> 
				<?php echo $mainLink ?>
			</section>
			
			<section id='content-padding'>
				<section id='content'>
					
					<h4 class='text-center'>Transmission of Data</h4>
					<hr>
					
					<section id='introduction' class='row'>
						<h4 class='large-3 columns text-right'>Introduction</h4>
						<div class='large-9 columns'>
							<?php include_once('./includes/introduction.php') ?>
						</div>
					</section>
					<section id='parameters' class='row'>
						<h4 class='large-3 columns text-right'>Transmission</h4>
						<div class='large-9 columns'>
							<?php include_once('./includes/transmission.php') ?>
						</div>
					</section>		
				</section>
				
				<section id='documentation'>
					<hr>
					<h4 class='text-center'>Function Documentation</h4>
					<hr>
					
					<section id='stick'>
						<pre id='documentation-call' class='large-8 large-offset-2 end text-center' data-language="php">$client->call("Field Name", array(Parameter1, ..., ParameterN, $connect));</pre>
					</section>
					
					<?php include_once('./includes/documentation.general.php') ?>
					<hr>
					<?php include_once('./includes/documentation.bed.php') ?>
					<hr>
					<?php include_once('./includes/documentation.staffing.php') ?>
					<hr>
					<?php include_once('./includes/documentation.committee.php') ?>
					<hr>
					<?php include_once('./includes/documentation.others.php') ?>
					<hr>
					<?php include_once('./includes/documentation.financial-status.php') ?>
					
				</section>
			</section>
			
		</section>
		
		<footer>
		
		</footer>
		
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/rainbow.min.js"></script>
		<script src="assets/js/jquery.sticky-kit.min.js"></script>
		<script src="assets/js/script.js"></script>
	
	</body>

</html>