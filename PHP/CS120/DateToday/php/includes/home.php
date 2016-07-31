<?php
/*
Date Today
The Internet's Most Notorious Dating Site

Authors: 

Joseph Niel Tuazon
	Website: http://josephnieltuazon.tumblr.com
	Email: josephnieltuazon@yahoo.com
Ruahden Dang-awan
	Email: ruahden1@yahoo.com
*/

?>
<div id='home'>

	<div id='welcome-screen'>
		<div id='inner-welcome-screen'>
			<div class='row' data-equalizer>
				<div class='medium-7 columns' id='page-name' data-equalizer-watch>
					<span>
						<h1><?php echo $siteName ?></h1>
						<h2><?php echo $siteSlogan ?></h2>
					</span>
				</div>
				<div id='sign-up-form' class='medium-5 columns' data-equalizer-watch>
					<?php include_once('welcome-form.php'); ?>
				</div>
			</div>
		</div>
	</div>

	<div id='others-screen'>
		<div id='about-screen'>
			<div style="display:table;width:900px;height:100%;margin:0 auto;">
			<div id='inner-about-screen'  class='row' style="display:table-cell;vertical-align:middle;margin-bottom:40px;">
				<center><h1>About Date Today</h1></center>
				<p>Date Today is a dating website. We offer dating to everyone. </p>
				<p>Date today is made by people who really know what
				dating is all about. We aim to help the helpless in handling love handles.</p>
				<p>We serve at the heart of dating. </p>
				<p>Date Today is a statistically reliable site to start dating.(Dang-awan RF., 2014) Date Today
				is a site that offers love to everyone. </p>
				
				<p> Date Today also specializes in people who had never had a relationship. We will teach you the right moves and motives. And we will
				ensure that your first date will never go wrong or end up in rejection. </p>
				
				<p>Whenever you feel like having a date, we're always here to help. </p>
			</div>
			</div>
		</div>
		<div id='why-screen'>
			<div style="display:table;width:900px;height:100%;margin:0 auto;">
			<div id='inner-why-screen' class='row' style="display:table-cell;vertical-align:middle;margin-bottom:40px;">
				<center><h1>Why choose Date today?</h1></center>
				<p>Because we care. We don't choose our customers. Our customers choose us. </p>
				<p>Date Today is open to single people, the broken hearted, the desperate, the taken, the obsessed and all other kinds of people.</p>
				<p>Unlike other websites, we don't burden you with the task of choosing where to date, what to do at your date, what to buy.. 
				because we do it all for you! All you have to do is, pick a person, pick a date and time, and then send us your money and everything is taken cared of. </p>
				<p> Trivia: Date today was voted the dating site of the year during 2008 and 2010. And we are currently the leading site in making that perfect match for you. </p>
				
				
				<h4> Choose Date Today, today! </h4>
			</div>
			</div>
		</div>
		<div id='creators-screen' style='color:white;'>
			<div style="display:table;width:900px;height:100%;margin:0 auto;">
			<div id='inner-creators-screen' class='row' style="display:table-cell;vertical-align:middle;margin-bottom:40px;">
				<center><h1 style="color: white;">The Creators</h1> </center>
				<br /><br />
				<h2 style="color: white;"> Joseph Niel "Chinito" Tuazon </h2>
				<p>Status: Single <br />
				Email: josephnieltuazon@yahoo.com <br />
				Tumblr: http://josephnieltuazon.tumblr.com <br />
				Likes: Girls <br />
				Identifying data: Singkit eyes
				</p>
				<br /><br />
				<h2 style="color: white;"> Ruahden "Ruah" Dang-awan </h2> 
				<p>Status: Single <br />
				Email: ruahden1@yahoo.com <br />
				Courses@dpsm: http://dpsm.cas.upm.edu.ph/courses/user/profile.php?id=2052 <br />
				Likes: Math <br />
				Identifying data: Mustache
				</p>
				</p>
				
			</div>
			</div>
		</div>
	</div>
</div>

<div id='login-modal'>
	<?php include_once('login.php') ?>
</div>
