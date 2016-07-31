<?php
		$data = array( 
				'id' 			=> 'advancedSearchForm',
				'class'			=> 'no-margin',
				'data-abide' 	=> ''
				);
		echo form_open(base_url('search_controller/handleAdvancedSearch'), $data);
	?>
	
	<div id='advancedSearchInnerModal' class='innerModal'>
	
		<div class='row'>
			<div id='mainInput' class='large-10 columns'>
				<?php
					$data = array(
						'name'       	=> 'searchQuery',
						'value'       	=> $this->session->userdata('searchQuery'),
						'placeholder' 	=> 'Input search query',
						'required'		=> ''
					);
					echo form_input($data);
				?>
				<small class="error" style='margin:0'>Search query is required.</small>
			</div>
		</div>
		
		<h4 class='no-margin large-margin-top large-margin-bottom medium-margin-left'>Additional Search Queries</h4>
		
		<div id='row0' class='row'>
			<div class='large-2 small-5 columns'>
				<select name='bool0' id='row0bool'></select>
			</div>
			<div class='large-3 small-7 columns'>
				<select name='category0' id='row0select' class='advancedSearchSelect'></select>
			</div>
			<div class='large-5 columns' id='row0input'>
				<input type='text' name='query0' placeholder='Input Search Query' required=''>
				<small class="error">This field is required.</small>
			</div>
			<div class='large-1 small-6 columns end'>
				<input type='button' value='+' id='mainAdd' class='button advancedSearchButton addEntry'>
			</div>
			<hr class='hide-for-large-up'>
		</div>
		
		<div id='additionalInputs'>
			
		</div>
	</div>
	
	<div class='row modalFooter'>
		<div class='large-4 large-offset-8 columns end'>
			<?php
				$data = array(
					'class' 	=> 'button full-width no-margin',
					'value'    	=> 'Search',
					'id'		=> 'advancedSearchSubmitButton'
					);
				echo form_submit($data);
			?>
		</div>
	</div>
	
	<input type='hidden' name='maxNumberOfQueries' id='maxNumberOfQueries' value='1'/>
	<input type='hidden' name='numberOfQueries' id='numberOfQueries' value='1'/>
	
	<?php echo form_close(); ?>
