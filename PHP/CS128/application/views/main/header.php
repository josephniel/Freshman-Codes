<!doctype>
<html>
<head>
	<title>
		<?php echo $title ?>
	</title>
	
	<?php 
	
		$name = "viewport";
		$content = "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no";
		echo meta($name, $content);
	
		$link = array(
			'href' 	=> base_url('assets/images/icon.ico'),
			'rel' 	=> 'icon',
			'type' 	=> 'image/png'
		);
		echo link_tag($link);
	
		$link = array(
			'href' 	=> base_url('assets/css/normalize.css'),
			'rel' 	=> 'stylesheet',
			'type' 	=> 'text/css'
		);
		echo link_tag($link);
		
		$link = array(
			'href' 	=> base_url('assets/css/foundation.css'),
			'rel' 	=> 'stylesheet',
			'type' 	=> 'text/css'
		);
		echo link_tag($link);
		
		$link = array(
			'href' 	=> base_url('assets/css/preset.css'),
			'rel' 	=> 'stylesheet',
			'type'	=> 'text/css'
		);
		echo link_tag($link);
		
		$link = array(
			'href' 	=> base_url('assets/css/app.css'),
			'rel' 	=> 'stylesheet',
			'type'	=> 'text/css'
		);
		echo link_tag($link);
		
	?>
	
</head>
<body>