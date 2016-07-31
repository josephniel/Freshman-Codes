<div id='header'>
	<div class='row'>
	
		<div class='medium-2 small-12 columns clearfix'>
			<center>
				<img src='<?php echo base_url('assets/images/logo.png') ?>'>
			</center>
		</div>
		
		<div class=' medium-10 columns show-for-medium-up'>
			<h3>NCBI Implementation for Proteins</h3>
		</div>
		
	</div>
</div>

<div class='row large-padding-top large-padding-bottom large-margin-bottom'>
		
	<div class='show-for-large-up'>
		<div class='large-4 columns'>
			<?php $this->load->view('main/others/left_panel'); ?>
		</div>
	</div>
	
	<div class='large-8 columns'>
		<?php $this->load->view('main/others/search_panel_view'); ?>
		<?php if(base_url('index.php') !== current_url()) $this->load->view('main/others/search_results_view'); ?>
	</div>
		
</div>

<div id='footer'>
	<div class='row'>
	
		<div class='show-for-large-up'>
			<ul href='#' class='large-6 columns menu'>
				<li>
					<a href="<?php echo base_url()?>" <?php if((base_url() . 'index.php') === current_url()){ echo 'class="current"'; } ?>> Home </a>
				</li>
			</ul>
			
			<ul class="large-6 columns others">
				<li>
					<a id='faqLink' modal-link='faqModal'>FAQ</a>
				</li>
				<li> | </li>
				<li>
					<a id='aboutLink' modal-link='aboutModal'>About the Project</a>
				</li>
			</ul>
		</div>
		
		<div class='hide-for-large-up'>
			<ul class="large-12 columns menu">
				<li>
					<a href="<?php echo base_url()?>" <?php if((base_url() . 'index.php') === current_url()){ echo 'class="current"'; } ?>> Home </a>
				</li>
				<li> / </li>
				<li>
					<a id='faqLink' modal-link='faqModal'>FAQ</a>
				</li>
				<li> / </li>
				<li>
					<a id='aboutLink' modal-link='aboutModal'>About</a>
				</li>
			</ul>
		</div>
		
	</div>
</div>

<!-- MISCELLANEOUS -->

	<!-- MODALS --> 
	<?php $this->load->view('main/others/modal_container'); ?>

	<!-- COLLECTION BUTTON --> 
	<button id='collectionButton' class='show-for-large-up' modal-link='collectionsModal'>View Collections</button>
		
	<!-- LOADING SCREEN --> 
	<div id='loader'>
		<img src='<?php echo base_url('assets/images/page-loader.gif')?>' class='loader' />
	</div>