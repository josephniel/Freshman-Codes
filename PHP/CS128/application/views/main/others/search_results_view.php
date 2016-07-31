<?php
	$previousPage = $currentPageNumber - 1;
	$remainingResults = $totalCount - ($previousPage * $retMax);
	
	$data = array(
				'id' => 'searchResults',
				'class' => 'row collapse'
			);
	$hidden = array(
				'current_page' => $currentPageNumber,
				'search_query' => $searchQuery
			);
	
	if($summary !== false){ 
	?>
	
	<div id='searchResultsHeader' class='clearfix'>
		<div class='large-12 columns'>
			<div class='row collapse'>
				
				<span style='font-size: 32px;'>
					<?php echo $searchQuery; ?>
				</span>
				<br>
				<span>
				<?php
					if($remainingResults > $retMax){
						echo (($currentPageNumber - 1) * $retMax + 1) . " to " . (($currentPageNumber - 1) * $retMax + $retMax) . " of " . $totalCount;
					} else{
						echo (($currentPageNumber - 1) * $retMax + 1) . " to " . (($currentPageNumber - 1) * $retMax + $remainingResults) . " of " . $totalCount;
					}
					if($totalCount == 1){
						echo " result found";
					} else{
						echo " results found";
					} 
				?>
				</span>
			</div>
		</div>
	</div>
	
	<div class='show-for-large-up'>
	
		<?php
			echo form_open(base_url('search_controller/updateUIDs'), $data, $hidden);
			
			for($i = 0 ; $i < count($summary); $i++) { 
			
				$entryNumber = (($previousPage * $retMax) + $i + 1);
			
				$data = array(
					'name'        	=> 'AccessionIDs[]',
					'id'          	=> $summary[$i]['gi'],
					'class' 		=> 'right small-margin-right small-margin-top no-margin-bottom',
					'value'       	=> $summary[$i]['gi']
				);

				if (isset($checked) && in_array($summary[$i]['gi'], $checked)) {
					$data['checked'] = 'checked';
				}
				?>
				
				<div class='large-12 columns'>
					<div class='row panel no-margin large-margin-bottom'>
					
						<div class='large-12 columns'>
							<div class='row collapse'>
							
								<div class='small-1 columns show-for-large-up'>
									<?php echo form_checkbox($data).br(); ?>
									<label for='<?php echo $summary[$i]['gi']; ?>' class='right inline small-margin-right no-margin-bottom no-padding-bottom'>
										<?php echo $entryNumber; ?>
									</label>
								</div>
								
								<div class='small-11 columns extra-small-padding-top'>
									<span id='<?php echo $summary[$i]['gi']; ?>' class='searchResultTitle' modal-link='detailsModal'>
										<?php echo $summary[$i]['title']; ?>
									</span>
								</div>
								
							</div>
						</div>
						
						<div class='large-12 columns'>
							<hr>
						</div>						
						
						<div class='large-12 columns'>
							<div class='row collapse'>
							
								<div class='large-5 small-6 large-offset-1 columns'>
									<?php echo '<b>Accession</b>: '.$summary[$i]['accessionId']; ?>
								</div>
								
								<div class='large-5 small-5 large-pull-1 small-offset-1 columns'>
									<?php echo '<b>GI</b>: '.$summary[$i]['gi']; ?>
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			<?php
			}
			?>
				<div class='large-12 columns'>
					<div class='row collapse'>
					
							<?php
								$data = array(
									'name' => 'submit',
									'id' => 'prevButton',
									'class' => 'button large-2 small-6 columns',
									'value' => 'Previous'
 								); 								
								if ($currentPageNumber <= 1) {
									$data['disabled'] = 'disabled';
								}
								echo form_submit($data);
							
								$data = array(
									'name' => 'submit',
									'id' => 'nextButton',
									'class' => 'button large-2 small-6 columns',
									'value' => 'Next'
 								); 								
								if ($remainingResults <= $retMax) {
									$data['disabled'] = 'disabled';
								}
								echo form_submit($data);
							?>
							
						<div class='show-for-large-up'>
							<?php
								$data = array(
									'name'		=> 'submit',
									'id'       	=> 'submitButton',
									'class' 	=> 'button large-5 small-8 large-offset-3 small-offset-2',
									'value'    	=> 'Add to Collections'
								);
								echo form_submit($data);
							?>
						</div>
					</div>
				</div>
		<?php echo form_close(); ?>
		
	</div>
	
	<div class='hide-for-large-up'>
	
		<?php
		
			$data = array(
				'id' => 'searchResults',
				'class' => 'row collapse'
				);
			$hidden = array(
				'current_page' => $currentPageNumber,
				'search_query' => $searchQuery
			);
		
			echo form_open(base_url('search_controller/updateUIDs'), $data, $hidden);
			
			for($i = 0 ; $i < count($summary); $i++) { 
			
				$entryNumber = (($previousPage * $retMax) + $i + 1);
			
				$data = array(
					'name'        	=> 'AccessionIDs[]',
					'id'          	=> $summary[$i]['gi'],
					'class' 		=> 'checkbox right',
					'value'       	=> $summary[$i]['gi']
				);

				if (isset($checked) && in_array($summary[$i]['gi'], $checked)) {
					$data['checked'] = 'checked';
				}
				?>
				
				<div class='large-12 columns'>
					<div class='row panel large-padding-top large-padding-bottom small-padding-left small-padding-right no-margin large-margin-bottom'>
					
						<div class='large-12 columns'>
							<div class='row collapse'>
								<div class='small-12 columns text-center'>
									<?php echo $entryNumber; ?>
								</div>
								<div class='small-12 columns'>
									<hr>
								</div>
								<div class='small-12 columns'>
									<span id='<?php echo $summary[$i]['gi']; ?>' class='searchResultTitle' modal-link='detailsModal'>
										<?php echo $summary[$i]['title']; ?>
									</span>
								</div>
							</div>
						</div>
						
						<div class='large-12 columns'>
							<hr>
						</div>						
						
						<div class='large-12 columns'>
							<div class='row collapse'>
								<div class='large-5 small-6 large-offset-1 columns'>
									<?php echo '<b>Accession</b>: '.$summary[$i]['accessionId']; ?>
								</div>
								<div class='large-5 small-5 large-pull-1 small-offset-1 columns'>
									<?php echo '<b>GI</b>: '.$summary[$i]['gi']; ?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			<?php
			}
			?>
				<div class='large-12 columns'>
					<div class='row collapse'>
						<?php
							$data = array(
								'name' => 'submit',
								'id' => 'prevButton',
								'class' => 'button small-6 columns',
								'value' => 'Previous'
 							); 								
							if ($currentPageNumber <= 1) {
								$data['disabled'] = 'disabled';
							}
							echo form_submit($data);
							
							$data = array(
								'name' => 'submit',
								'id' => 'nextButton',
								'class' => 'button small-6 columns',
								'value' => 'Next'
 							); 								
							if ($remainingResults <= $retMax) {
								$data['disabled'] = 'disabled';
							}
							echo form_submit($data);
						?>
					</div>
				</div>
		<?php echo form_close(); ?>
		
	</div>
		
	<?php } else { ?>
		
		<div class='no-search-result'>No results found for <b><?php echo $searchQuery; ?></b></div>
	
	<?php } ?>