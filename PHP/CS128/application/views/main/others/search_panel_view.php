<div id='searchBarContainer' class='large-padding-top'>
	<?php 
		$data = array( 'class' => 'row collapse', 'data-abide' => '');
		echo form_open(base_url(), $data); ?>

		<div class='large-12 columns'>
			<div class='row collapse'>
			
				<div class='small-3 columns overflow-hidden'>
					<span class="prefix">GenBank Search</span>
				</div>
				
				<div class='small-9 columns'>
					<?php
						$data = array(
							'name'       	=> 'searchQuery',
							'id'          	=> 'searchBar',
							'class'			=> 'no-margin',
							'value'       	=> $this->session->userdata('searchQuery'),
							'placeholder' 	=> 'Input search query',
							'type' 			=> 'search',
							'required'		=> ''
						);
						echo form_input($data);
					?>
					<small class='error no-margin'>This search query is required.</small>
				</div>
				
			</div>
		</div>
					
		<div class='large-12 columns collapse small-margin-top'>
			<div class='row collapse'>
				<div class='large-3 small-4 columns large-margin-left'>
					<span id='advancedSearch' modal-link='advancedSearchModal'>Advanced Search</span>
				</div>
				<div class='large-4 large-offset-4 small-6 small-offset-1 columns'>
				<?php 
					$data = array(
						'name'      => 'submit',
						'id'        => 'searchSubmitButton',
						'class' 	=> 'large-3 columns button postfix no-margin',
						'value'   	=> 'Search'
					);
					echo form_submit($data);
				?>
				</div>
			</div>
		</div>
			
	<?php echo form_close(); ?>
	
	<hr class='no-margin-bottom'>
</div>