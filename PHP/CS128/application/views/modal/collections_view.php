<?php $summary = json_decode($this->input->cookie('summary'), true); ?>
		
	<div class='innerModal'>

		<?php
			
		$checkboxes_name = 'motherload[]';
		
		echo form_open(base_url('search_controller/collectionsDownload'), array('id' => 'collectionItems'));
			
		if(sizeof($summary) != 0){ ?>
		
			<small class='error' style='display: none;'>Select at least one.</small>
		
			<?php 
			for($x = 0; $x < sizeof($summary); $x++){ ?>
			
				<div class='row panel large-margin-bottom'>
				
					<div class='large-1 columns'>
						<?php
							$data = array(
								'name'     	=> $checkboxes_name,
								'value'    	=> $summary[$x]['gi'],
								'id'		=> 'c-'.$summary[$x]['gi'],
								'class'		=> 'collection-select',
								'style'		=> 'margin: 0'
							);
							echo form_checkbox($data);
						?>
						<label for='c-<?php echo $summary[$x]['gi'] ?>' class='no-margin small-margin-left'>
							<?php echo ($x + 1); ?>
						</label>
					</div>
					
					<label for='c-<?php echo $summary[$x]['gi'] ?>' class='large-6 columns'>
						<strong><?php echo $summary[$x]['title'] ?></strong>
					</label>
					<div class='large-3 columns no-padding-right'>
						<strong>Accession</strong>: <?php echo $summary[$x]['accessionId']; ?>
					</div>
					<div class='large-2 columns no-padding-right'>
						<strong>GI</strong>: <?php echo $summary[$x]['gi']; ?>
					</div>
				
				</div>
					
			<?php } ?>

			<a id='select-all' class='no-margin'>Select All</a>
			
		<?php } else{ ?>
			<h5 class='no-margin large-margin-bottom'>There's no collection to display.</h5>
		<?php } ?>
		
	</div>
	
	<div class="row modalFooter">
		
		<?php if(sizeof($summary) != 0){ ?>
		
			<div class="large-3 columns no-padding-left no-padding-right">
				<input type = "hidden" name = "format" value = "">
				<?php 
					$data = array(
								'class'		=> 'full-width',
								'content'	=> 'Remove Selected',
								'onClick'	=> "COLLECTION.validateForm('" .$checkboxes_name. "', 'delete')"
							);
					echo form_button($data);
				?>	
			</div>
			
			 <div class="large-3 columns no-padding-right">
				<?php 
					$data = array(
								'class'		=> 'full-width',
								'content'	=> 'BLASTP',
								'onClick'	=> "COLLECTION.validateForm('" .$checkboxes_name. "', 'blastp')"
							);
					echo form_button($data);
				?>	
			</div>
			
			<div class="large-3 columns no-padding-right">
				<?php 
					$data = array(
								'class'		=> 'full-width',
								'content'	=> 'Download GB',
								'onClick'	=> "COLLECTION.validateForm('" .$checkboxes_name. "', 'gb')"
							);
					echo form_button($data);
				?>	
			</div>

			<div class="large-3 columns no-padding-right">
				<?php
					$data = array(
								'class'		=> 'full-width',
								'content'	=> 'Download JSON',
								'onClick'	=> "COLLECTION.validateForm('" .$checkboxes_name. "', 'json')"
							);
					echo form_button($data);
				?>
			</div>
			
		<?php } else { ?>
			
			<button type='button' id='close-collection' class="large-4 large-offset-4 columns end">Start Adding</button>
			
		<?php } ?>

		<?php echo form_close(); ?>
			
	</div>