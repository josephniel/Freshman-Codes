<div id='leftPanel' class='large-padding-top'>

	<div id='recentSearchesContainer' class='row panel' >
		
		<h5>Recent Searches</h5>
		<hr>
	
		<?php 	
		if($this->input->cookie('hist1')){ ?>

			<div id='recentSearches'>
				<ol class='no-margin-bottom'>
					<?php 
					if($this->input->cookie('count') >= 5){
						for($x = $this->input->cookie('count'); $x > ($this->input->cookie('count') - 5); $x--){ ?>
							<li class='medium-margin-bottom'>
								<a href="<?php echo base_url('searchResults/?searchQuery='.$this->input->cookie('hist'.$x).'&page=1') ?>" class="recentSearch">
									<?php echo $this->input->cookie('hist'.$x) ?>
								</a>
							</li>
					<?php 
						}
					} else{
						for($x = $this->input->cookie('count'); $x > 0; $x--){ ?>
							<li class='medium-margin-bottom'>
								<a href="<?php echo base_url('searchResults/?searchQuery='.$this->input->cookie('hist'.$x).'&page=1') ?>" class="recentSearch">
									<?php echo $this->input->cookie('hist'.$x) ?>
								</a>
							</li>
					<?php 
						}
					} ?>
				</ol>
			</div>
							
			<div class='clearfix'>
				<span id='recentSearchesLink' class='right' modal-link='recentSearchesModal'>See All Recent Searches</span>
			</div>
							
		<?php						
		} else{ ?>
		
			<p> There are no recent searches </p>
			
		<?php } ?>
		
	</div>
				
	<?php if((base_url('index.php')) !== current_url()){ ?>
	
		<div class='row clearfix'>
			<span id='searchSettings' class='large-margin-right' modal-link='searchSettingsModal'>Search Settings</span>
		</div>
		
	<?php } ?>
				
</div>