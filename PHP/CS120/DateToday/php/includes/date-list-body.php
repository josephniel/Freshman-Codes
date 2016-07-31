<?php
/*
Date Today
The Internet's Most Notorious Dating Site

Authors: 

Joseph Niel Tuazon
	Website: http://josephnieltuazon.tumblr.com
	Email: josephnieltuazon@yahoo.com
Ruahden Dang-awan
	Email: 
*/

	// Start Session to get preference
	session_start();
	$preference = $_SESSION['welcomeForm']['preference']; 
	
	// Load the XML file
	$xml = simplexml_load_file("xml_".$preference.".xml");

	foreach($xml as $dates){ 
		$valid = false;
		for($i = 0; $i < 4; $i++){
			if($dates->scheds->sched[$i]->attributes()->{'available'} == 1){
				$valid = true;
			}
		}
		if(!($valid)){
			$dates->attributes()->{'available'} = 0;
			$xml->asXml("xml_".$preference.".xml");
		}
	}
	
	if(count($_POST)>0){
		$_SESSION['dates'] = array();
		$_SESSION['dates']['date1'] = $_POST['date1'];
		$_SESSION['dates']['date2'] = $_POST['date2'];
		$_SESSION['dates']['date3'] = $_POST['date3'];
		$_SESSION['dates']['date4'] = $_POST['date4'];
		$_SESSION['dates']['date5'] = $_POST['date5'];
		header('Location: ./schedules');
		exit;
	}
	else{
		echo "<div data-alert class='alert-box'>Please book a date.<a href='#' class='close'>&times;</a></div>";
	}
	
?>
<div id='background'>
	<div id='page-title' class='row'>
		<h1><?php echo $siteName ?></h1>
		<h2><?php echo $siteSlogan ?></h2>
		<hr />
	</div>
		
	<div id='banner'>
		<ul data-orbit>
			<li><img src="<?php $path ?>images/slideshow/orbit-1.jpg" alt="slide 1" /></li>
			<li><img src="<?php $path ?>images/slideshow/orbit-2.jpg" alt="slide 2" /></li>
			<li><img src="<?php $path ?>images/slideshow/orbit-3.jpg" alt="slide 3" /></li>
			<li><img src="<?php $path ?>images/slideshow/orbit-4.jpg" alt="slide 4" /></li>
			<li><img src="<?php $path ?>images/slideshow/orbit-5.jpg" alt="slide 5" /></li>
		</ul>
	</div>
		
	<a name='available'></a>
	<div class='inner-date-list row'>
		<center><h1>Available Dates</h1></center>
		
		<hr />
		
		<?php $noDateAvailable = 1;
			foreach($xml as $dates){
				if($dates->attributes()->{"available"} == 1) $noDateAvailable = 0;
			}
		?>
		
		<div id='date-container'>
			<?php if($noDateAvailable == 0){ ?>
				<?php foreach($xml as $dates){?>
					<div class='small-6 medium-4 columns <?php if(strcmp($dates->attributes()->{"number"},"5") == 0){ echo "end"; } ?>'>
						<div class="box">
							<img id='main' src='<?php $path ?><?php echo $dates->images->image[0]; ?>' />
							<?php if(strcmp($dates->attributes()->{"number"},"1") == 0){ ?>
								<img id='ribbon' src='<?php $path ?>images/best-seller.png' />
							<?php } ?>	
							<span class='date-name'><?php echo $dates->name; ?></span>
							<div class='reveal' data-magellan-expedition>
								<div>
									<span><?php echo $dates->description->About; ?></span>
								</div>
								<div data-magellan-arrival='<?php echo $dates->attributes()->{"number"}; ?>'>
									<a class='button small' href='#<?php echo $dates->attributes()->{"number"}; ?>'>
										Details
									</a>
								</div>
							</div>
							<?php if($dates->attributes()->{"available"} == 0){ ?>
							<div class='box-disabled'>
								<div><span>Unavailable</span></div>
							</div>
							<?php } ?>
						</div>
					</div>
				<?php } 
				}
				else{ ?>
					<h1>It seems like everyone is busy having their dates already. <br /><br /> Sorry but there are no available dates as of now. We'll let you know if there would be any available dates. <br /><br /> Thank you. <br/> - Date Today Team </h1>
					<a href='../index.php' class='medium-4 columns'><span class='button expand'>Go Back</span></a>
			<?php } ?>
		</div>

		<hr />
		
	</div>

	<?php if($noDateAvailable == 0){ ?>
	
	<a name='details'></a>
	<div class='inner-date-list row'>
		
		<center><h1>Date Details</h1></center>
		<hr />

		<div class="date-details-container">
			<?php foreach($xml as $dates){ ?>
					<a name='<?php echo $dates->attributes()->{"number"}; ?>'></a>
					<div id='date-details'>
						<img src='<?php echo $dates->images->image[0]; ?>' />
						<div id='date-details-content'>
							<h2>Name: <?php echo $dates->name; ?></h2>
							<hr />
							<h2>About:</h2>
								<div style='margin:-10px 0 0 20px;'><h2><?php echo $dates->description->About; ?></h2></div>
							<h2>Rating: <?php echo $dates->rating; ?> approves</h2>
							<h2>Price: P <?php echo $dates->price; ?> per "date" </h2>
							
							<a id='date<?php echo $dates->attributes()->{"number"};?>' class='button small book'>Book</a>
							
							<div id='other-details'>
								<h2>Other Details</h2>
									<span>Age:</span> <?php echo $dates->description->Age; ?> <hr />
									<span>Favorite Food:</span> <br /> <?php echo $dates->description->Food; ?> <hr />
									<span>Favorite Constellation:</span> <br /> <?php echo $dates->description->Constellation; ?> <hr />
									<span>Favorite Quote:</span> <br /> <?php echo $dates->description->Quote; ?>
							</div>
						</div>
						<?php if($dates->attributes()->{"available"} == 0){ ?>
						<div class='box-disabled'>
							<div><span><h1>Unavailable</h1></span></div>
						</div>
						<?php } ?>
					</div>
			<?php } ?>
		</div>
	</div>
	
	<form id='dateForm' class='row' method='post' action='./dateList'>
		<button type='submit' class='button expand' id='dateFormSubmit'>Next</button>
	</form>
	
	<?php } ?>
	
</div>
