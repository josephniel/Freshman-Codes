<?php 
/*
Date Today
The Internet's Most Notorious Dating Site

Authors: 

Joseph Niel Tuazon
	Website: http://josephnieltuazon.tumblr.com
	Email: josephnieltuazon@yahoo.com
Ruahden Dang-Awan
	Email: 
*/
	$content = "";
	if($currentPage == "index"){
		$breadClass = "";
		$content = 
			"<li class='current'><a id='home-button' >Home</a></li>
			<li><a id='about-button'>About Date Today</a></li>
			<li><a id='why-button'>Why Date Today</a></li>
			<li><a id='credits-button'>The Creators</a></li>";
	}
	else if($currentPage == "list"){
		$breadClass = "data-magellan-expedition";
		$content = 
			"<li data-magellan-arrival='available'><a href='#available'>Available Dates</a></li>
			<li data-magellan-arrival='details'><a href='#details'>Date Details</a></li>";
	}
	$content .= "<li class='copyright unavailable'><a>Date Today &copy; 2014</a></li>";

?>
<div id='fixed-menu'>
	<div class='row'>
		<ul class="breadcrumbs" <?php echo $breadClass ?>>
			<?php echo $content ?>
		</ul>
	</div>
</div>
